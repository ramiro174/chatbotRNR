<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class GuetzaConversation extends Conversation
{
    protected $firstname;
    protected $email;
    protected $edad;
    protected $estado_republica;
    protected $genero;

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
        $question = Question::create('por favor selecciona la opción con la qué te identifiques?')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('askGeneroid')
            ->addButtons([
                Button::create('Mujer')->value('Mujer'),
                Button::create('Hombre')->value('Hombre'),
                Button::create('Otra identidad de genero')->value('Otra'),
            ]);


        $this->ask($question, function(Answer $answer) {
                $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
                $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
                if(!in_array($selectedValue,['Mujer','Hombre','Otra'])){
                    $this->say("Haz click en un opcion valida");
                    $this->repeat();
                }else{
                    $this->genero=$selectedValue;
                    $this->say($selectedText);
                    $this->askEdad();
                }
        },['askGeneroid']);

    }
    public function askEdad()
    {
        $this->ask('¡Gracias!, para poder brindarte atención adecuada podrías indicarme tu edad?', function(Answer $answer) {
            // Save result
            $this->edad = $answer->getText();

            $this->askEstado();

        });
    }
    public function askEstado()
    {
        $this->ask('¿En que Estado de la República te encuentras en este momento?', function(Answer $answer) {
            // Save result
            $this->estado_republica = $answer->getText();

            $this->say($this->firstname.' gracias!!');

        });
    }


}
