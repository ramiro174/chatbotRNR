<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class ExampleConversation extends Conversation
{
    protected $firstname;

    protected $email;

    public function run()
    {
        $this->askName();
    }

    public function askName()
    {
        $this->ask('me gustaría conocer tu nombre o cómo deseas que te llame?', function(Answer $answer) {
            // Save result
            $this->firstname = $answer->getText();

            $this->say($this->firstname.' un gusto, para poder acompañarte necesito conocerte un poco más');
            $this->askGenero();
        });
    }

    public function askGenero()
    {
        $this->ask('por favor selecciona la opción con la qué te identifiques', function(Answer $answer) {
            // Save result
            $this->email = $answer->getText();

            $this->say('We will contact you at your email: '.$this->email);
            $this->say('Bye '.$this->firstname.'!');
        });
    }
}
