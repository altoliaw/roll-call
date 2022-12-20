<?php
namespace App\Services\LineBot\EventHandler;

interface EventHandlerProto {
    public function fn_handle() : array;
}