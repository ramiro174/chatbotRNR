<?php

namespace App\Http\Controllers;

use App\Conversations\ExampleConversation;
use App\Conversations\GuetzaConversation;
use App\Http\Controllers\Bot\BotController;
use BotMan\BotMan\BotMan;
use Illuminate\Support\Str;

class GlobalBotController extends BotController
{
    public function __invoke()
    {
        // You can access the botman object with this line
        $botman = $this->botman;

        $botman->hears('{message}', function(BotMan $botman, $message) {



            $message =  trim(strtolower($message));

            if (in_array($message,['hola','ola','Hola','HOLA','Ola','hOla','HOla'])) {
                // Start a conversation with a fresh chat_id
                $chatId = (string) Str::uuid();
                $botman->startConversation(new GuetzaConversation($chatId));
            }

            else {
                $botman->reply("Escribe hola para comenzar");
            }
        });



        $botman->listen();
    }
}
