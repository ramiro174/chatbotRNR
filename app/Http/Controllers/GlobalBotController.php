<?php

namespace App\Http\Controllers;

use App\Conversations\ExampleConversation;
use App\Conversations\GuetzaConversation;
use App\Http\Controllers\Bot\BotController;

class GlobalBotController extends BotController
{
    public function __invoke()
    {
        // You can access the botman object with this line
        $botman = $this->botman;

        $botman->hears('{message}', function($botman, $message) {

            $message = strtolower($message);

            if (in_array($message,['hola','ola','Hola','HOLA','Ola','hOla','HOla'])) {
                // Start a conversation

                $botman->startConversation(new GuetzaConversation());
            }

            else {
                $botman->reply("Escribe hola para comenzar");
            }
        });



        $botman->listen();
    }
}
