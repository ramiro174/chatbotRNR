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
    protected $orientacionNecesitas;
    protected $QuieresSaberSituacionRiesgo;


    public function run()
    {
        $this->askName();
    }
    public function askName():void
    {
        $this->ask('me gustaría conocer tu nombre o cómo deseas que te llame?', function(Answer $answer) {
            // Save result
            $this->firstname = $answer->getText();

            //$this->say(');
            $this->askGenero();
        });
    }
    public function askGenero() :void
    {
        $question = Question::create($this->firstname .' un gusto, para poder acompañarte necesito conocerte un poco más por favor selecciona la opción con la qué te identifiques?')
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

        $question_Edad = Question::create('¡Gracias!, para poder brindarte atención adecuada podrías indicarme tu edad?')
            ->fallback('Edad no valida')
            ->callbackId('askEdad');

        $this->ask($question_Edad, function(Answer $answer) {

            if(!is_numeric( $answer->getText())){
                $this->say("Introduce una edad numerica");
                $this->repeat();
            }else{
                $this->edad = $answer->getText();
                $this->askEstado();
            }



        },['askEdad']);
    }
    public function askEstado()
    {
        $this->ask('¿En que Estado de la República te encuentras en este momento?', function(Answer $answer) {
            // Save result
            $this->estado_republica = $answer->getText();

            $this->askOrientacionNecesitas();

        });
    }
    public function askOrientacionNecesitas() :void
    {
        $question = Question::create($this->firstname .' ¿la orientación que necesitas es para ti o para alguna mujer que conoces?')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('askOrientacionNecesitasid')
            ->addButtons([
                Button::create('Para mi')->value('Para mi'),
                Button::create('Para una conocida')->value('Para una conocida'),

            ]);
        $this->ask($question, function(Answer $answer) {
            $selectedValue = $answer->getValue();
            if(!in_array($selectedValue,['Para mi','Para una conocida'])){
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            }else{
                $this->orientacionNecesitas=$selectedValue;


               $this->askQuieresSaberSituacionRiesgo();
            }
        },['askOrientacionNecesitasid']);
    }
    public function askQuieresSaberSituacionRiesgo() :void
    {
        $question = Question::create($this->firstname .' ¿Quieres saber que hacer en caso de necesitar algún servicio de emergencia?')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('askQuieresSaberSituacionRiesgoid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),

            ]);
        $this->ask($question, function(Answer $answer) {
            $selectedValue = $answer->getValue();
            if(!in_array($selectedValue,['Si','No'])){
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            }else{
                $this->QuieresSaberSituacionRiesgo=$selectedValue;
                if($selectedValue='Si'){
                    $this->askIdentificamosServiciosAtencionMujeres();
                }else{
                    $this->askEdad();
                }
            }
        },['askQuieresSaberSituacionRiesgoid']);
    }

    public function askIdentificamosServiciosAtencionMujeres() :void
    {

        $this->say("Identificamos los siguientes servicios de atención a las mujeres en tu entidad.");
        $this->say("Líneas de emergencia (filtrando por:
                    -mujeres menores de 17 años, 
                    -mujeres
                    -hombres
                    -otras identidades
                    -estado)");
        $this->say("MUJERES:En muchas ocasiones, es necesario salir de  casa ante la violencia  que se vive en ella, si fuera el caso, aquí puedes encontrar algunas  acciones que es importante tomar en cuenta POSTAL  Si tienes hijas e hijos, es importante que también consideres estos aspectos POSTAL");


    }
    public function askQuieresSaberqueHacerHeridaLesion() :void
    {
        $question = Question::create('¿Quieres saber que hacer en caso de alguna herida o lesión?')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('askQuieresSaberqueHacerHeridaLesionid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),

            ]);
        $this->ask($question, function(Answer $answer) {
            $selectedValue = $answer->getValue();
            if(!in_array($selectedValue,['Si','No'])){
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            }else{
                $this->QuieresSaberSituacionRiesgo=$selectedValue;
                if($selectedValue='Si'){
                    $this->askIdentificamosServiciosAtencionMujeres();
                }else{
                    $this->askEdad();
                }
            }
        },['askQuieresSaberqueHacerHeridaLesionid']);


    }




}
