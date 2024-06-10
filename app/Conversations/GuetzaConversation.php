<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class GuetzaConversation extends Conversation
{
    protected String $firstname;
    protected String $email;
    protected String $edad;
    protected String $estado_republica;
    protected String $genero;
    protected String $orientacionNecesitas;
    protected String $QuieresSaberSituacionRiesgo;

    protected String $AlgunaVezHanEmpujadoGolpeadoAgreFisicamente;
    protected String $HasSentidoMiedoSobreTuSeguridad;
    protected String $HasTenidoLesionesFisicas;
    protected String $TuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas;

    public function run()
    {
        $this->askName();
    }

    public function askName(): void
    {
        $this->ask('me gustaría conocer tu nombre o cómo deseas que te llame?', function (Answer $answer) {
            // Save result
            $this->firstname = $answer->getText();

            //$this->say(');
            $this->askGenero();
        });
    }

    public function askGenero(): void
    {
        $question = Question::create($this->firstname . ' un gusto, para poder acompañarte necesito conocerte un poco más por favor selecciona la opción con la qué te identifiques?')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('askGeneroid')
            ->addButtons([
                Button::create('Mujer')->value('Mujer'),
                Button::create('Hombre')->value('Hombre'),
                Button::create('Otra identidad de genero')->value('Otra'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
            $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
            if (!in_array($selectedValue, ['Mujer', 'Hombre', 'Otra'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->genero = $selectedValue;
                $this->say($selectedText);
                $this->askEdad();
            }
        }, ['askGeneroid']);
    }

    public function askEdad()
    {

        $question_Edad = Question::create('¡Gracias!, para poder brindarte atención adecuada podrías indicarme tu edad?')
            ->fallback('Edad no valida')
            ->callbackId('askEdad');

        $this->ask($question_Edad, function (Answer $answer) {

            if (!is_numeric($answer->getText())) {
                $this->say("Introduce una edad numerica");
                $this->repeat();
            } else {
                $this->edad = $answer->getText();
                $this->askEstado();
            }


        }, ['askEdad']);
    }

    public function askEstado()
    {
        $this->ask('¿En que Estado de la República te encuentras en este momento?', function (Answer $answer) {
            // Save result
            $this->estado_republica = $answer->getText();

            $this->askOrientacionNecesitas();

        });
    }

    public function askOrientacionNecesitas(): void
    {
        $question = Question::create($this->firstname . ' ¿la orientación que necesitas es para ti o para alguna mujer que conoces?')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('askOrientacionNecesitasid')
            ->addButtons([
                Button::create('Para mi')->value('Para mi'),
                Button::create('Para una conocida')->value('Para una conocida'),

            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Para mi', 'Para una conocida'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->orientacionNecesitas = $selectedValue;
                $this->askQuieresSaberSituacionRiesgo();
            }
        }, ['askOrientacionNecesitasid']);
    }

    public function askQuieresSaberSituacionRiesgo(): void
    {
        $question = Question::create(' ¿Quieres saber que hacer en caso de necesitar algún servicio de emergencia?')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('askQuieresSaberSituacionRiesgoid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),

            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->QuieresSaberSituacionRiesgo = $selectedValue;
                if ($selectedValue == 'Si') {
                    $this->askIdentificamosServiciosAtencionMujeres();
                } else {
                    $this->askAquiTengoUnasOpcionesParaTi();
                }
            }
        }, ['askQuieresSaberSituacionRiesgoid']);
    }

    public function askIdentificamosServiciosAtencionMujeres(): void
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
    public function askAquiTengoUnasOpcionesParaTi(): void
    {
        $question_AquiTengoUnasOpcionesParaTi = Question::create('Aquí tengo unas opciones para ti, selecciona la que mejor se ajuste a lo que necesitas:')
            ->fallback('Edad no valida')
            ->callbackId('askAquiTengoUnasOpcionesParaTiid')
            ->addButtons([
            Button::create('Identificar las violencias')->value('IdenViolencias'),
            Button::create('Planes de acción y protección ante situaciones de violencia')->value('PlanesAccionProteccion'),
            Button::create('Información sobre derechos sexuales y reproductivos.')->value('InforDerechosSexRepro'),
            Button::create('Orientación psicológica')->value('OrienPsicologica'),
            Button::create('Me comunique con anterioridad y necesito atención. ')->value('MeComunicoAnterioridad'),
            Button::create('Información adicional')->value('InformacionAdicional'),
            Button::create('Derechos sexuales y reproductivos')->value('DerechosSexRepro'),
        ]);

        $this->ask($question_AquiTengoUnasOpcionesParaTi, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['IdenViolencias', 'PlanesAccionProteccion','InforDerechosSexRepro','OrienPsicologica','MeComunicoAnterioridad','InformacionAdicional','DerechosSexRepro'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->QuieresSaberSituacionRiesgo = $selectedValue;
                if ($selectedValue == 'IdenViolencias') {
                    $this->askQuieroSaberIdentificarViolencias();
                } else {
                }
            }


        }, ['askAquiTengoUnasOpcionesParaTiid']);



    }
    public function askQuieroSaberIdentificarViolencias(): void
    {
        $question_AquiTengoUnasOpcionesParaTi = Question::create('Aquí tengo unas opciones para ti, selecciona la que mejor se ajuste a lo que necesitas:')
            ->fallback('Edad no valida')
            ->callbackId('askAquiTengoUnasOpcionesParaTiid')
            ->addButtons([
            Button::create('Física')->value('Fisica'),
            Button::create('Psicológica')->value('Psicologica'),
            Button::create('Sexual')->value('Sexual'),
            Button::create('Patrimonial')->value('Patrimonial'),

        ]);

        $this->ask($question_AquiTengoUnasOpcionesParaTi, function (Answer $answer) {
            $selectedValue = $answer->getValue();

            if (!in_array($selectedValue, ['Fisica', 'Psicologica','Sexual','Patrimonial'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->QuieresSaberSituacionRiesgo = $selectedValue;
                if ($selectedValue == 'Fisica') {
                    $this->say("Es cualquier acto que causa daño no accidental, usando la fuerza física o algún tipo de arma u objeto que pueda provocarte o no lesiones ya sean internas, externas o ambas. En este tipo te violencia también entra la violencia acida la cual se usa para atacar a mujeres con el objetivo de causarles daños físicos graves y permanentes.");
                    $this->say("Algunos ejemplos: pellizcos; empujones; bofetadas; jalones de cabello; golpes en cualquier parte del cuerpo; mordidas, etc.");
                    $this->say("Aquí te compartimos algunas preguntas a través de las cuales puedes identificar si tu o alguien más que conoce s, está o ha estado en situación de violencia física, te invitamos a responderlas, recuerda que esta conversación es privada y nadie más conocerá las respuestas");

                } else {
                   $this->askAlgunaVezHanEmpujadoGolpeadoAgreFisicamente();
                }
            }


        }, ['askAquiTengoUnasOpcionesParaTiid']);



    }
    public function askAlgunaVezHanEmpujadoGolpeadoAgreFisicamente(): void
    {
        $question_AlgunaVezHanEmpujadoGolpeadoAgreFisicamente = Question::create('¿Alguna vez te han empujado, golpeado o agredido físicamente?')
            ->fallback('Edad no valida')
            ->callbackId('askAlgunaVezHanEmpujadoGolpeadoAgreFisicamenteid')
            ->addButtons([
            Button::create('Si')->value('Si'),
            Button::create('No')->value('No'),
        ]);

        $this->ask($question_AlgunaVezHanEmpujadoGolpeadoAgreFisicamente, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->AlgunaVezHanEmpujadoGolpeadoAgreFisicamente = $selectedValue;
                $this->askHasSentidoMiedoSobreTuSeguridad();
            }


        }, ['askAlgunaVezHanEmpujadoGolpeadoAgreFisicamenteid']);



    }
    public function askHasSentidoMiedoSobreTuSeguridad(): void
    {
        $question_HasSentidoMiedoSobreTuSeguridad = Question::create('¿Has sentido miedo sobre tu seguridad  física por parte de tu pareja, familiar o alguna persona cercana?')
            ->fallback('Edad no valida')
            ->callbackId('askHasSentidoMiedoSobreTuSeguridadid')
            ->addButtons([
            Button::create('Si')->value('Si'),
            Button::create('No')->value('No'),
        ]);

        $this->ask($question_HasSentidoMiedoSobreTuSeguridad, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->HasSentidoMiedoSobreTuSeguridad = $selectedValue;
                $this->askHasTenidoLesionesFisicas();
            }


        }, ['askHasSentidoMiedoSobreTuSeguridadid']);



    }
    public function askHasTenidoLesionesFisicas(): void
    {
        $question_askHasTenidoLesionesFisicas = Question::create('¿Has tenido lesiones físicas  o haber tenido que ir al médico por agresiones físicas de terceras personas?')
            ->fallback('Edad no valida')
            ->callbackId('askHasTenidoLesionesFisicasid')
            ->addButtons([
            Button::create('Si')->value('Si'),
            Button::create('No')->value('No'),
        ]);

        $this->ask($question_askHasTenidoLesionesFisicas, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->HasTenidoLesionesFisicas = $selectedValue;
                $this->askTuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas();
            }


        }, ['askHasTenidoLesionesFisicasid']);



    }
    public function askTuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas(): void
    {
        $question_TuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas = Question::create('¿Tú pareja, familiar o alguien cercano te ha obligado o engañado para que consumas  alguna sustancia o medicamento? ')
            ->fallback('Edad no valida')
            ->callbackId('askTuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas')
            ->addButtons([
            Button::create('Si')->value('Si'),
            Button::create('No')->value('No'),
        ]);

        $this->ask($question_TuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas = $selectedValue;
            }


        }, ['askTuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas']);



    }



    public function askQuieresSaberqueHacerHeridaLesion(): void
    {
        $question = Question::create('¿Quieres saber que hacer en caso de alguna herida o lesión?')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('askQuieresSaberqueHacerHeridaLesionid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),

            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->QuieresSaberSituacionRiesgo = $selectedValue;
                if ($selectedValue = 'Si') {
                    $this->askIdentificamosServiciosAtencionMujeres();
                } else {
                    $this->askEdad();
                }
            }
        }, ['askQuieresSaberqueHacerHeridaLesionid']);


    }


}
