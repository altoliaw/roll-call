<?php

namespace App\Services\LineBot;

use App\Services\LineBot\EventHandler\MessageHandler\TextMessageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\Exception\InvalidEventRequestException;
use LINE\LINEBot\Exception\InvalidSignatureException;

class LineService
{
    protected $o_bot;
    protected $o_req;
    protected $o_signature;
    protected $o_textmsg;

    public function __construct(
        Request $o_req,
        array $oa_config
    ) {

        $this->o_req = $o_req;
        $o_httpclient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($oa_config['line_channel_access_token']);
        $this->o_bot = new \LINE\LINEBot($o_httpclient,
            ['channelSecret' => $oa_config['line_channel_secret']]);
        Log::debug("Create a bot instance");

        $this->o_signature = null;
        $this->o_signature = $this->o_req->header(HTTPHeader::LINE_SIGNATURE);
    }

    public function __destruct()
    {
    }

    public function fn_handler()
    {
        $o_events = null;

        try {
            $o_events = $this->o_bot->parseEventRequest(
                $this->o_req->getContent(), $this->o_signature);
        } catch (InvalidSignatureException $e) {
            Log::alert('Invalid signature');
            throw $e;
        } catch (InvalidEventRequestException $e) {
            Log::alert('Invalid event request');
            throw $e;
        }
        return $this->fn_parse_event($o_events);
    }

    private function fn_parse_event($o_events)
    {
        $oa_2DText = [];
        foreach ($o_events as $o_event) {
            $o_handler = null;
            switch (true) {
                case ($o_event instanceof TextMessage):
                    $o_handler = new TextMessageHandler($o_event);
                    break;
                default:
            }

            if (!is_null($o_handler)) {
                $oa_2DText[] = $o_handler->fn_handle();
            }
        }
        return $oa_2DText;
    }

    public function fn_exe_event($oa_2DText)
    {
        foreach ($oa_2DText as $oa_Text) {
            $this->o_bot->{$oa_Text['behavior']}($oa_Text['replytok'], $oa_Text['content']);
        }
    }
}
