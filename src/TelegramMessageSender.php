<?php

namespace KkSmiles\Firewatch;
use DefStudio\Telegraph\Models\TelegraphChat;
use Throwable;

class TelegramMessageSender
{
    /**
     * Send error message to telegram.
     *
     * @param \Throwable $e
     * @return boolean
     *
     */
    public static function sendMessage(Throwable $e) 
    {
        $chat = TelegraphChat::find(config('firewatch.telegram_chat_id'));
        $chat->message('Hello world')->send();
    }
}