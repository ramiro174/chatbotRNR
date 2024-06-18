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
    protected String $AquiTengoOpcionesParaTi;
    protected String $AlgunaVezHanEmpujadoGolpeadoAgreFisicamente;
    protected String $HasSentidoMiedoSobreTuSeguridad;
    protected String $HasTenidoLesionesFisicas;
    protected String $TuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas;
    protected String $AlguienCercanoCriticaMenospreciaBurla;
    protected String $SientesAlguienTuVidaLimitaTusDesiciones;
    protected String $TeHanExcluidoDeliberadamenteDeActividades;
    protected String $SientesMiedoAnsiedadConstante;

    protected String $AlguienPresionadoParticiparActividadesSexuales;
    protected String $HasAccedidoRealizarActivadesSexuales;
    protected String $AlguienUtilizadoDrogasIncapacitarte;
    protected String $HasTenidoActividadesSexualesSinConsentimiento ;



    protected int $tiempoRespuesta=2;

    public function run()
    {
        $this->askName();
    }
    public function askName(): void
    {
        $this->ask('¿Me gustaría conocer tu nombre o cómo deseas que te llame?', function (Answer $answer) {
            // Save result
            $this->firstname = $answer->getText();
            $this->bot->typesAndWaits($this->tiempoRespuesta);
            //$this->say(');
            $this->askGenero();
        });
    }

    public function askGenero(): void
    {
        $question = Question::create($this->firstname . ' un gusto, para poder acompañarte necesito conocerte un poco más por favor selecciona la opción con la qué te identifiques')
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
                $this->say('<div class="response-right">'.   $selectedText.'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->genero = $selectedValue;
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
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askEstado();
            }


        }, ['askEdad']);
    }
    public function askEstado()
    {
        $this->ask('¿En que Estado de la República te encuentras en este momento?', function (Answer $answer) {
            // Save result
            $this->estado_republica = $answer->getText();
            $this->bot->typesAndWaits($this->tiempoRespuesta);
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
                $this->say('<div class="response-right">'.   $selectedValue.'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
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
                $this->say('<div class="response-right">'.   $selectedValue.'</div>');
                $this->QuieresSaberSituacionRiesgo = $selectedValue;
                if ($selectedValue == 'Si') {
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askIdentificamosServiciosAtencionMujeres();
                } else {
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
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
            Button::create('Identificar las violencias')->value('Identificar las violencias'),
            Button::create('Planes de acción y protección ante situaciones de violencia')->value('PlanesAccionProteccion'),
            Button::create('Información sobre derechos sexuales y reproductivos.')->value('InforDerechosSexRepro'),
            Button::create('Orientación psicológica')->value('OrienPsicologica'),
            Button::create('Me comunique con anterioridad y necesito atención. ')->value('MeComunicoAnterioridad'),
            Button::create('Información adicional')->value('InformacionAdicional'),
            Button::create('Derechos sexuales y reproductivos')->value('DerechosSexRepro'),
        ]);

        $this->ask($question_AquiTengoUnasOpcionesParaTi, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            $selectedText = $answer->getText();

            if (!in_array($selectedValue, ['Identificar las violencias', 'PlanesAccionProteccion','InforDerechosSexRepro','OrienPsicologica','MeComunicoAnterioridad','InformacionAdicional','DerechosSexRepro'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->AquiTengoOpcionesParaTi = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if ($selectedValue == 'Identificar las violencias') {

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
            Button::create('Económica')->value('Económica'),
            Button::create('Digital')->value('Digital'),
            Button::create('¿Solo mi pareja puede ejercer violencia?')->value('¿Solo mi pareja puede ejercer violencia?'),
        ]);

        $this->ask($question_AquiTengoUnasOpcionesParaTi, function (Answer $answer) {
            $selectedValue = $answer->getValue();

            $this->say('<div class="response-right">'.  $answer->getText().'</div>');

            if (!in_array($selectedValue, ['Fisica', 'Psicologica','Sexual','Patrimonial'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->QuieresSaberSituacionRiesgo = $selectedValue;
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if ($selectedValue == 'Fisica') {
                    $this->say("Es cualquier acto que causa daño no accidental, usando la fuerza física o algún tipo de arma u objeto que pueda provocarte o no lesiones ya sean internas, externas o ambas. En este tipo te violencia también entra la violencia acida la cual se usa para atacar a mujeres con el objetivo de causarles daños físicos graves y permanentes.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Algunos ejemplos: pellizcos; empujones; bofetadas; jalones de cabello; golpes en cualquier parte del cuerpo; mordidas, etc.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Aquí te compartimos algunas preguntas a través de las cuales puedes identificar si tu o alguien más que conoce s, está o ha estado en situación de violencia física, te invitamos a responderlas, recuerda que esta conversación es privada y nadie más conocerá las respuestas");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askAlgunaVezHanEmpujadoGolpeadoAgreFisicamente();
                }
                elseif($selectedValue == 'Psicologica') {
                    $this->say("Es cualquier acto u omisión que dañe tu estabilidad psicológica, que puede consistir en: negligencia, abandono, descuido reiterado, celotipia, insultos, humillaciones, devaluación, marginación, indiferencia, infidelidad, comparaciones destructivas, rechazo, restricción a la autodeterminación y amenazas, las cuales te pueden generar consecuencias, secuelas o efectos, tales como depresión, aislamiento, devaluación de la autoestima e incluso ideación o intentos de suicidio.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Otros ejemplos: criticarte cómo te vistes o hablas; revisar tu celular o redes sociales; minimizar tus opiniones; ridiculizarte, dejarte de hablar, exigirte le digas a dónde vas o con quien estas; etc.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Aquí te compartimos algunas preguntas a través de las cuales puedes identificar si tu o alguien más que conoce s, está o ha estado en situación de violencia psicología, te invitamos a responderlas, recuerda que esta conversación es privada y nadie más conocerá las respuestas");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askAlguienCercanoCriticaMenospreciaBurla();
                }
                elseif($selectedValue == 'Sexual') {
                    $this->say("Es cualquier acto que te degrada o daña tu cuerpo y/o tu sexualidad y que por tanto atenta contra tu libertad, dignidad e integridad física. Es una expresión de abuso de poder al denigrarte y concebirte como objeto.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Algunos ejemplos: presionarte a tener relaciones sexuales; chantajearte para tener relaciones sexuales, obligarte a ver material pornográfico o realizar alguna práctica sexual que te desagrada, tocamientos sobre la ropa o debajo de ella sin tu autorización; etc.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Aquí te compartimos algunas preguntas a través de las cuales puedes identificar si tu o alguien más que conoces, está o ha estado en situación de violencia sexual, te invitamos a responderlas, recuerda que esta conversación es privada y nadie más conocerá las respuestas");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askAlguienPresionadoParticiparActividadesSexuales();

                }
                elseif($selectedValue == 'Patrimonial') {

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
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->AlgunaVezHanEmpujadoGolpeadoAgreFisicamente = $selectedValue;
                $this->bot->typesAndWaits($this->tiempoRespuesta);
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
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
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
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
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
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $Respuestaspreguntas=[$this->AlgunaVezHanEmpujadoGolpeadoAgreFisicamente,$this->HasSentidoMiedoSobreTuSeguridad,$this->HasTenidoLesionesFisicas,$this->TuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas];
                $this->say('Existen lugares especializados de protección en los que puedes recibir atención integral de forma gratuita, segura y confidencial. Recuerda que las violencias son un delito y puedes denunciarlo. Te invitamos a conocer planes de acción. ');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if(in_array('Si',$Respuestaspreguntas)){
                        $this->askPlanesDeAccionProteccionSituacionViolencia();

                }else{
                    $this->say('Hasta ahora en ninguna de nuestras preguntas he identificado violencia, recuerda que la violencia abarca una amplia gama de formas. Te invito a explorar preguntas sobre otros tipos de violencia, y a seguir informándote sobre este tema crucial para promover un entorno seguro y saludable para todas las personas.');
                }

            }


        }, ['askTuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas']);



    }
    public function askPlanesDeAccionProteccionSituacionViolencia(): void
    {
        $question_askPlanesDeAccionProteccionSituacionViolencia = Question::create('Planes de acción y protección ante situaciones de violencia')
            ->fallback('Edad no valida')
            ->callbackId('askPlanesDeAccionProteccionSituacionViolenciaid')
            ->addButtons([
                Button::create('Sexual')->value('Sexual'),
                Button::create('Física')->value('Fisica'),
                Button::create('Psicológica')->value('Psicologica'),

            ]);

        $this->ask($question_askPlanesDeAccionProteccionSituacionViolencia, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Sexual', 'Fisica','Psicologica'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

            }


        }, ['askPlanesDeAccionProteccionSituacionViolenciaid']);



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

    public function askAlguienCercanoCriticaMenospreciaBurla(): void
    {
        $question_AlguienCercanoCriticaMenospreciaBurla = Question::create('¿Alguien cercano te critica, te menosprecia o se burla de ti, teniendo impacto en tu autoestima?')
            ->fallback('Edad no valida')
            ->callbackId('askAlguienCercanoCriticaMenospreciaBurlaid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),
            ]);
        $this->ask($question_AlguienCercanoCriticaMenospreciaBurla, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->AlguienCercanoCriticaMenospreciaBurla = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askSientesAlguienTuVidaLimitaTusDesiciones();
            }


        }, ['askAlguienCercanoCriticaMenospreciaBurlaid']);



    }
    public function askSientesAlguienTuVidaLimitaTusDesiciones(): void
    {
        $question_askSientesAlguienTuVidaLimitaTusDesiciones = Question::create('¿Sientes que alguien en tu vida limita tus decisiones y acciones?')
            ->fallback('Edad no valida')
            ->callbackId('askSientesAlguienTuVidaLimitaTusDesicionesid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),
            ]);
        $this->ask($question_askSientesAlguienTuVidaLimitaTusDesiciones, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->SientesAlguienTuVidaLimitaTusDesiciones = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTeHanExcluidoDeliberadamenteDeActividades();
            }


        }, ['askSientesAlguienTuVidaLimitaTusDesicionesid']);



    }
    public function askTeHanExcluidoDeliberadamenteDeActividades(): void
    {
        $question_askTeHanExcluidoDeliberadamenteDeActividades = Question::create('¿Te han excluido deliberadamente de actividades o decisiones importantes como castigo?')
            ->fallback('Edad no valida')
            ->callbackId('askTeHanExcluidoDeliberadamenteDeActividadesid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),
            ]);
        $this->ask($question_askTeHanExcluidoDeliberadamenteDeActividades, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->TeHanExcluidoDeliberadamenteDeActividades = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askSientesMiedoAnsiedadConstante();
            }


        }, ['askTeHanExcluidoDeliberadamenteDeActividadesid']);



    }
    public function askSientesMiedoAnsiedadConstante(): void
    {
        $question_askSientesMiedoAnsiedadConstante = Question::create('¿Sientes miedo o ansiedad constante alrededor de una persona en particular debido a su comportamiento hacia ti?')
            ->fallback('Edad no valida')
            ->callbackId('askSientesMiedoAnsiedadConstanteid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),
            ]);
        $this->ask($question_askSientesMiedoAnsiedadConstante, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->SientesMiedoAnsiedadConstante = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $Respuestaspreguntas=[$this->AlguienCercanoCriticaMenospreciaBurla, $this->SientesAlguienTuVidaLimitaTusDesiciones, $this->TeHanExcluidoDeliberadamenteDeActividades, $this->SientesMiedoAnsiedadConstante];
                $this->say('Existen lugares especializados de protección en los que puedes recibir atención integral de forma gratuita, segura y confidencial. Recuerda que las violencias son un delito y puedes denunciarlo. Te invitamos a conocer planes de acción. ');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if(in_array('Si',$Respuestaspreguntas)){
                    $this->askPlanesDeAccionProteccionSituacionViolencia();

                }else{
                    $this->say('Hasta ahora en ninguna de nuestras preguntas he identificado violencia, recuerda que la violencia abarca una amplia gama de formas. Te invito a explorar preguntas sobre otros tipos de violencia, y a seguir informándote sobre este tema crucial para promover un entorno seguro y saludable para todas las personas.');
                }


            }


        }, ['askSientesMiedoAnsiedadConstanteid']);



    }


    public function askAlguienPresionadoParticiparActividadesSexuales(): void
    {
        $question_askAlguienPresionadoParticiparActividadesSexuales = Question::create('¿Alguien te ha presionado para participar en actividades sexuales en contra de tu voluntad?')
            ->fallback('Edad no valida')
            ->callbackId('$askAlguienPresionadoParticiparActividadesSexualesid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),
            ]);
        $this->ask($question_askAlguienPresionadoParticiparActividadesSexuales, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->AlguienPresionadoParticiparActividadesSexuales = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askHasAccedidoRealizarActivadesSexuales();
            }


        }, ['$askAlguienPresionadoParticiparActividadesSexualesid']);



    }
    public function askHasAccedidoRealizarActivadesSexuales(): void
    {
        $question_askHasAccedidoRealizarActivadesSexuales = Question::create('¿Alguien te ha presionado para participar en actividades sexuales en contra de tu voluntad?')
            ->fallback('Edad no valida')
            ->callbackId('askHasAccedidoRealizarActivadesSexualesid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),
            ]);
        $this->ask($question_askHasAccedidoRealizarActivadesSexuales, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->HasAccedidoRealizarActivadesSexuales = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askAlguienUtilizadoDrogasIncapacitarte();
            }


        }, ['askHasAccedidoRealizarActivadesSexualesid']);



    }
    public function askAlguienUtilizadoDrogasIncapacitarte(): void
    {
        $question_askAlguienUtilizadoDrogasIncapacitarte = Question::create('¿Alguien ha utilizado drogas o alcohol para incapacitarte con el fin de cometer actos sexuales en tu contra? ')
            ->fallback('Edad no valida')
            ->callbackId('askAlguienUtilizadoDrogasIncapacitarteid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),
            ]);
        $this->ask($question_askAlguienUtilizadoDrogasIncapacitarte, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->AlguienUtilizadoDrogasIncapacitarte = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askHasTenidoActividadesSexualesSinConsentimiento();
            }


        }, ['askAlguienUtilizadoDrogasIncapacitarteid']);



    }
    public function askHasTenidoActividadesSexualesSinConsentimiento(): void
    {
        $question_askHasTenidoActividadesSexualesSinConsentimiento = Question::create('¿Has  tenido actividades sexuales sin tu consentimiento?')
            ->fallback('Edad no valida')
            ->callbackId('askSientesMiedoAnsiedadConstanteid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),
            ]);
        $this->ask($question_askHasTenidoActividadesSexualesSinConsentimiento, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->HasTenidoActividadesSexualesSinConsentimiento  = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $Respuestaspreguntas=[$this->AlguienPresionadoParticiparActividadesSexuales, $this->HasAccedidoRealizarActivadesSexuales, $this->AlguienUtilizadoDrogasIncapacitarte, $this->HasTenidoActividadesSexualesSinConsentimiento ];
                $this->say('Existen lugares especializados de protección en los que puedes recibir atención integral de forma gratuita, segura y confidencial. Recuerda que las violencias son un delito y puedes denunciarlo. Te invitamos a conocer planes de acción. ');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if(in_array('Si',$Respuestaspreguntas)){
                    $this->askPlanesDeAccionProteccionSituacionViolencia();

                }else{
                    $this->say('Hasta ahora en ninguna de nuestras preguntas he identificado violencia, recuerda que la violencia abarca una amplia gama de formas. Te invito a explorar preguntas sobre otros tipos de violencia, y a seguir informándote sobre este tema crucial para promover un entorno seguro y saludable para todas las personas.');
                }


            }


        }, ['askSientesMiedoAnsiedadConstanteid']);



    }


}
