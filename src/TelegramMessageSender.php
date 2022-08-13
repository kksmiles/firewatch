<?php

namespace KkSmiles\Firewatch;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Support\Facades\Config;
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
    public static function sendMessage(Throwable $e, int $occurence_count)
    {
        $keyboard = Keyboard::make()
            ->row([
                Button::make('👀 View')->url('https://apiv2.thatepanhub.org/logs'),
                Button::make('✅ Resolve')->action('resolve')
            ])->row([
                Button::make('💤 Snooze')->action('snooze')
            ]);

        $message = '';

        if($occurence_count === 1) {
            $message .= "A new error occured: ";
        }

        else {
            $message .= "An error occured {$occurence_count} times: ";
        }

        $message .= "\"" . $e->getMessage() . "\"" . "\n\n";

        $message .= "<strong>Project: </strong>";
        $message .= Config::get('app.name') . "\n";

        $message .= "<strong>File: </strong>";
        $message .= $e->getFile() . ":{$e->getLine()}" . "\n";

        $message .= "<strong>Stage: </strong>";
        $message .= Config::get('app.env');
        $message .= "\n\n";

        $message .= "<strong>Occurence count: </strong> {$occurence_count} \n";
        $message .= "<Strong>Affected users: </strong> 0";

        $chat = TelegraphChat::find(1);
        $chat->html($message)->keyboard($keyboard)->send();
    }
}
