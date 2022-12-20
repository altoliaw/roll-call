<?php

namespace App\Services\LineBot\EventHandler\MessageHandler;

use App\Services\LineBot\EventHandler\EventHandlerProto;
use LINE\LINEBot\Event\MessageEvent\TextMessage;

/**
 * A text message handler
 */
class TextMessageHandler implements EventHandlerProto
{
    protected $o_bot;
    protected $o_logger;
    protected $o_req;
    protected $o_textmsg;

    /**
     * The contruction
     * @param TextMessage $o_textmsg
     * @return null
     */
    public function __construct(TextMessage $o_textmsg)
    {
        $this->o_textmsg = $o_textmsg;
    }

    public function fn_handle(): array
    {
        $oa_Text = [];
        $s_line_uid = $this->o_textmsg->getUserId();
        $s_text = $this->o_textmsg->getText();
        $s_command = preg_replace('/(\S+)\s(\S+)/', '$1', $s_text);
        $s_uid = preg_replace('/(\S+)\s(\S+)/', '$2', $s_text);

        $s_reply_tok = $this->o_textmsg->getReplyToken();

        switch ($s_command) {
            case "註冊":
            case "register":
                $oa_Text = ['demand' => 'register', 'behavior' => 'replyText', 'replytok' => $s_reply_tok, 'lineuid' => $s_line_uid, 'uid' => $s_uid, 'content' => "註冊成功"];
                break;
            case "點名":
            case "rollcall":
                $oa_Text = ['demand' => 'rollcall', 'behavior' => 'replyText', 'replytok' => $s_reply_tok, 'lineuid' => $s_line_uid, 'uid' => $s_uid, 'content' => "點名成功"];
                break;
            default:
                $oa_Text = ['demand' => 'error', 'behavior' => 'replyText', 'replytok' => $s_reply_tok, 'lineuid' => $s_line_uid, 'uid' => $s_uid, 'content' => "請確認輸入"];
        }
        return $oa_Text;
    }
}
