<?php

namespace App\Conversations;

use App\Models\Instituciones_Organizaciones;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class GuetzaConversation extends Conversation
{
    protected string $firstname;
    protected string $email;
    protected string $edad;
    protected string $estado_republica;
    protected string $genero;
    protected string $orientacionNecesitas;
    protected string $QuieresSaberSituacionRiesgo;
    protected string $AquiTengoOpcionesParaTi;
    protected string $AlgunaVezHanEmpujadoGolpeadoAgreFisicamente;
    protected string $HasSentidoMiedoSobreTuSeguridad;
    protected string $HasTenidoLesionesFisicas;
    protected string $TuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas;
    protected string $AlguienCercanoCriticaMenospreciaBurla;
    protected string $SientesAlguienTuVidaLimitaTusDesiciones;
    protected string $TeHanExcluidoDeliberadamenteDeActividades;
    protected string $SientesMiedoAnsiedadConstante;
//
    protected string $AlguienPresionadoParticiparActividadesSexuales;
    protected string $HasAccedidoRealizarActivadesSexuales;
    protected string $AlguienUtilizadoDrogasIncapacitarte;
    protected string $HasTenidoActividadesSexualesSinConsentimiento;
//
    protected string $HasExperimentadoPresionFirmarContraVoluntad;
    protected string $AlguienDestruidoIntencionalmenteBienesMateriales;
    protected string $TeHanImpedidoTrabajarOEstudiarLimitar;
    protected string $AlgunaPersonaCercanaUtilizadoBienesSinConsentimiento;
//
    protected string $HasExperimentadoPresionAsumirDeudasCompromisos;
    protected string $AlguienCercanoATiControlaTusIngresos;
    protected string $TeHanNegadoRecursosEconomicos;
    protected string $TeHanImpedidoTrabajarOEstudiarLimitarFinanciera;
//
    protected string $TeSientesPresionadaActuarPerderContactoHijos;
    protected string $TuParejaExparejaImpedidoComuniquesHijasHijos;
    protected string $HasNotadoTuParejaUtilizaHijasHijos;
    protected string $TeSientesExcluidaDecisionesImportantesHijasHijos;
//
    protected string $HasRecibidoAmenazasATravezMensajesRedesCorreo;
    protected string $AlguienHaDifundidoInformacionFalsaLinea;
    protected string $HasExperimentadoRoboIdentidadLineaSuplantacion;
    protected string $TeHanPresionadoEnviarFotosIntimasInformacionPersonal;

//
    protected string $EnEventoViolenciaSexualHuboExposicionRiesgo;
    protected string $SucedioInmediato;
    protected string $TengoMasInformacionSepasHAcerDespuesEvento;


    protected string $AquiTemuestroPlanesAccionFisica;
    protected string $SiyaIdentificasteSituacionPeligro;

    protected string $DebesSaberTienesDerechoSobreDerechoSexuales;

//Orientación psicológica
    protected string $TePuedoAcompañarAlgunasPreguntasIdentificarProcesoPsicoterapeutico;

// Me comuniqué con anterioridad y necesito atención.
    protected string $AnteriormenteTeBrindeInformacionRequerias;
    protected string $CompartemeSugerenciasPropuestas;
    protected string $HeSeleccionadAlgunasAtencionesPuedesRecibirAtravesOrganizaciones;
    protected string $SiTeInteresaConocerSobreProgramasSocialesTramitesConsultasUtilidad;

    //Información adicional
    protected string $QuieresSaberQueConsiste;
    protected string $LaViolenciaPresentaDiferentesAmbitos;
    protected string $TanProntoComoSeaSeguroHacerlo;



    //terminar
    protected string $AntesQueTeVayasMeGustariaConversacionResultoUtil;
    protected string $CompartemeTusSugerenciasPropuestas;
    protected string $RecomendariasGuetzaPersonasConoces;
    protected string $ConsiderasInformacionBrindadaPuedesIntegrarDiaADia;

    protected int $tiempoRespuesta = 2;

    public static function ListarOrganizaciones(Collection $listaInsOrg): string
    {


        $lista = $listaInsOrg->map(function ($ins) {
            return "<b>".  $ins->Institucion_Organizacion."</b>" .
                ", " .
                $ins->Estado .
                ", " .
                $ins->Municipio ."</br>" .
                "Dias de Atencion: " .
                $ins->Dias_de_atencion .
                ", Horario: " .
                $ins->Horario .
                ", Servicio: " .
                $ins->Caracteristica .
                ",  Telefono: " .
                $ins->Telefono ."</br>".
                "Correo: " .
                $ins->Email .
                ", Pagina Web:  <a  style='color:purple' href=\"$ins->Pagina_web\">" .
                $ins->Pagina_web ."</a>" .
                ", Facebook :  <a  style='color:purple'  href=\"$ins->Facebook\">" .
                $ins->Facebook ."</a>" .
                ", Instagram  <a  style='color:purple'  href=\"$ins->Instagram\">" .
                $ins->Instagram ."</a>" .
                ",  Twitter: <a  style='color:purple'  href=\"$ins->Twitter\">" .
                $ins->Twitter."</a>" ;
        });
    return  Arr::join($lista->toArray(),' </br></br>');

    }


    public function run()
    {
       $this->askName();
        //$this->askIdentificamosServiciosAtencionMujeres();
       // $this->askSucedioInmediato();
      // $this->askAquiTengoUnasOpcionesParaTi();
        //$this->askTerminar();
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
                Button::create('Anterior')->value('Anterior'),

            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No','Anterior'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->say('<div class="response-right">'.   $selectedValue.'</div>');
                $this->QuieresSaberSituacionRiesgo = $selectedValue;
                if ($selectedValue == 'Si') {
                    $this->bot->typesAndWaits(8);
                    $this->askIdentificamosServiciosAtencionMujeres();
                } elseif($selectedValue=='No') {
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askAquiTengoUnasOpcionesParaTi();
                }else{
                    $this->askOrientacionNecesitas();
                }
            }
        }, ['askQuieresSaberSituacionRiesgoid']);
    }
    public function askIdentificamosServiciosAtencionMujeres(): void
    {

        $edad= $this->edad?$this->edad:0;
        $estado= $this->estado_republica?$this->estado_republica:"";

            $instituciones=  self::ListarOrganizaciones(Instituciones_Organizaciones::edadMenorMujer($edad)
                ->estadoRepublica($estado)
                ->orWhere(function ($q) use ($edad) {
                    return $q->edadMenorHombre($edad);
                })

                ->get());

        $this->say("Identificamos los siguientes servicios de atención a las mujeres en tu entidad.");
        $this->say($instituciones);
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->say("MUJERES:En muchas ocasiones, es necesario salir de  casa ante la violencia  que se vive en ella, si fuera el caso, aquí puedes encontrar algunas  acciones que es importante tomar en cuenta POSTAL  Si tienes hijas e hijos, es importante que también consideres estos aspectos POSTAL");

        $this->askAntesQueTeVayasMeGustariaConversacionResultoUtil();


    }
    public function askAquiTengoUnasOpcionesParaTi(): void
    {
        $question_AquiTengoUnasOpcionesParaTi = Question::create('Aquí tengo unas opciones para ti, selecciona la que mejor se ajuste a lo que necesitas:')
            ->fallback('Edad no valida')
            ->callbackId('askAquiTengoUnasOpcionesParaTiid')
            ->addButtons([
            Button::create('Identificar las violencias')->value('Identificar las violencias'),
            Button::create('Planes de acción y protección ante situaciones de violencia')->value('Planes de acción y protección ante situaciones de violencia'),
            Button::create('Información sobre derechos sexuales y reproductivos')->value('Información sobre derechos sexuales y reproductivos'),
            Button::create('Orientación psicológica')->value('Orientación psicológica'),
            Button::create('Me comuniqué con anterioridad y necesito atención')->value('Me comuniqué con anterioridad y necesito atención'),
            Button::create('Información adicional')->value('Información adicional'),
            Button::create('Derechos sexuales y reproductivos')->value('Derechos sexuales y reproductivos'),
            Button::create('Anterior')->value('Anterior'),
        ]);

        $this->ask($question_AquiTengoUnasOpcionesParaTi, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            $selectedText = $answer->getText();

            if (!in_array($selectedValue, ['Identificar las violencias', 'Planes de acción y protección ante situaciones de violencia','Información sobre derechos sexuales y reproductivos','Orientación psicológica','Me comuniqué con anterioridad y necesito atención','Información adicional','Derechos sexuales y reproductivos','Anterior'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->AquiTengoOpcionesParaTi = $selectedValue;
                $this->say('<div class="response-right">'.  $selectedText.'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if ($selectedValue == 'Identificar las violencias') {
                    $this->askQuieroSaberIdentificarViolencias();
                }
                elseif($selectedValue == 'Planes de acción y protección ante situaciones de violencia') {
                    $this->askPlanesDeAccionProteccionSituacionViolencia();
                }
                elseif($selectedValue == 'Información sobre derechos sexuales y reproductivos') {
                    $this->askDebesSaberTienesDerechoSobreDerechoSexuales();
                }
                elseif($selectedValue == 'Orientación psicológica') {
                    $this->askTePuedoAcompañarAlgunasPreguntasIdentificarProcesoPsicoterapeutico();
                }
                elseif($selectedValue == 'Me comuniqué con anterioridad y necesito atención') {
                    $this->askAnteriormenteTeBrindeInformacionRequerias();
                }
                elseif($selectedValue == 'Información adicional') {
                    $this->askAlgunasOpcionesInformacionAdicional();
                }
                elseif($selectedValue == 'Derechos sexuales y reproductivos') {
                    //$this->();
                }
                elseif($selectedValue == 'Anterior') {
                    $this->askQuieresSaberSituacionRiesgo();
                }
            }


        }, ['askAquiTengoUnasOpcionesParaTiid']);



    }
    //Quiero saber cómo identificar las violencias
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
            Button::create('Vicaria')->value('Vicaria'),
            Button::create('Digital')->value('Digital'),
            Button::create('¿Solo mi pareja puede ejercer violencia?')->value('¿Solo mi pareja puede ejercer violencia?'),
            Button::create('Anterior')->value('Anterior'),
        ]);

        $this->ask($question_AquiTengoUnasOpcionesParaTi, function (Answer $answer) {
            $selectedValue = $answer->getValue();

            $this->say('<div class="response-right"> '.  $answer->getText().'</div>');

            if (!in_array($selectedValue, ['Anterior','Fisica', 'Psicologica','Sexual','Patrimonial','Económica','Vicaria','Digital','¿Solo mi pareja puede ejercer violencia?'])) {
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
                    $this->say("Es cualquier acto u omisión que afecta tu supervivencia, se manifiesta en: la transformación, sustracción, destrucción, retención o extracción de objetos, documentos personales, bienes y valores, derechos patrimoniales o recursos económicos destinados a satisfacer tus necesidades, puede abarcar los daños a los bienes comunes o propios.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Algunos ejemplos: que dañen a tus mascotas, te rompan tus pertenencias, sustraigan tus papeles  e identificaciones, restricción en tus bienes y valores, que escondan tu correspondencia, vendan o regalen tus cosas sin tu consentimiento, etc.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Aquí te compartimos algunas preguntas a través de las cuales puedes identificar si tu o alguien más que conoces, está o ha estado en situación de violencia patrimonial, te invitamos a responderlas, recuerda que esta conversación es privada y nadie más conocerá las respuestas");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askHasExperimentadoPresionFirmarContraVoluntad();

                }
                elseif($selectedValue == 'Económica') {
                    $this->say("Es toda acción u omisión de la persona agresora que afecte la supervivencia económica. Se manifiesta a través delimitaciones encaminadas a controlar el ingreso de sus percepciones económicas, así como la percepción de un salario menor por igual trabajo, dentro de un mismo centro laboral.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Algunos ejemplos: negar recursos financieros, control de ingresos, limitación de autonomía financiera, perdida intencional de bienes o recursos, restringir el derecho al trabajo, etc.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Aquí te compartimos algunas preguntas a través de las cuales puedes identificar si tu o alguien más que conoces, está o ha estado en situación de violencia económica, te invitamos a responderlas, recuerda que esta conversación es privada y nadie más conocerá las respuestas");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askHasExperimentadoPresionAsumirDeudasCompromisos();

                }
                elseif($selectedValue == 'Económica') {
                    $this->say("Es toda acción u omisión de la persona agresora que afecte la supervivencia económica. Se manifiesta a través delimitaciones encaminadas a controlar el ingreso de sus percepciones económicas, así como la percepción de un salario menor por igual trabajo, dentro de un mismo centro laboral.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Algunos ejemplos: negar recursos financieros, control de ingresos, limitación de autonomía financiera, perdida intencional de bienes o recursos, restringir el derecho al trabajo, etc.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Aquí te compartimos algunas preguntas a través de las cuales puedes identificar si tu o alguien más que conoces, está o ha estado en situación de violencia económica, te invitamos a responderlas, recuerda que esta conversación es privada y nadie más conocerá las respuestas");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askHasExperimentadoPresionAsumirDeudasCompromisos();

                }
                elseif($selectedValue == 'Vicaria') {
                    $this->say("Tiene como objetivo dañar a la mujer a través de sus seres queridos y especialmente de sus hijas e hijos. El padre ejerce una violencia extrema contra sus criaturas, llegando incluso a causarles la muerte.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Algunos ejemplos: respecto a hijas e hijos, amenazas, insultos, humillaciones, interrupción de tratamientos médicos, entre otras acciones, con el objetivo de causar un daño permanente y un dolor extremo a la mujer.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Aquí te compartimos algunas preguntas a través de las cuales puedes identificar si tu o alguien más que conoces, está o ha estado en situación de violencia vicaria, te invitamos a responderlas, recuerda que esta conversación es privada y nadie más conocerá las respuestas");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTeSientesPresionadaActuarPerderContactoHijasHijos();

                }
                elseif($selectedValue == 'Digital') {

                    $this->say("Es la violencia que se comete a través de medios digitales como redes sociales, correo electrónico o aplicaciones de mensajería móvil, causando daños a la dignidad, la integridad y/o la seguridad.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Algunos ejemplos: Actos de acoso, hostigamiento, amenazas, insultos, vulneración de datos e información privada, mensajes de odio, difusión de contenido sexual sin consentimiento.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Puede darse de varias formas; cualquier acto donde una persona grabe videos o audios, tome fotografías edite o disimule material sexual íntimo de otra persona mediante engaños. Este material también pudo haberse creado de manera consensuada, sin embargo, la exposición, distribución, difusión, exhibición, transmisión, comercialización, oferta, intercambio o compartir a través de cualquier medio virtual sin consentimiento de la mujer, también se considera violencia digital.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Aquí te compartimos algunas preguntas a través de las cuales puedes identificar si tu o alguien más que conoces, está o ha estado en situación de violencia digital, te invitamos a responderlas, recuerda que esta conversación es privada y nadie más conocerá las respuestas");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askHasRecibidoAmenazasATravezMensajesRedesCorreo();



                }
                elseif($selectedValue == '¿Solo mi pareja puede ejercer violencia?') {
                    $this->say("se cometen más de 10 feminicidios al día y de acuerdo a la ENCUESTA NACIONAL SOBRE LA DINÁMICA DE LAS RELACIONES EN LOS HOGARES (ENDIREH), 7 de cada 10 mujeres mayores de 15 años han experimentado alguna situación de violencia de género en su vida.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askPlanesDeAccionProteccionSituacionViolencia();

                }
                elseif($selectedValue == 'Anterior') {
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askAquiTengoUnasOpcionesParaTi();

                }
            }


        }, ['askAquiTengoUnasOpcionesParaTiid']);



    }
    //física
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
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askMensajeDespedida();
                }

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
                    $this->bot->typesAndWaits(10);
                    $this->askIdentificamosServiciosAtencionMujeres();
                } else {
                    $this->askEdad();
                }
            }
        }, ['askQuieresSaberqueHacerHeridaLesionid']);


    }

    //Psicologica
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

    //sexual
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

    //patrimonial
    public function askHasExperimentadoPresionFirmarContraVoluntad(): void
    {
        $question = Question::create('¿Has experimentado presión para firmar documentos financieros o legales en contra de tu voluntad o sin comprender completamente las implicaciones?')
            ->fallback('Edad no valida')
            ->callbackId('askHasExperimentadoPresionFirmarContraVoluntadid')
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

                $this->HasExperimentadoPresionFirmarContraVoluntad = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askAlguienDestruidoIntencionalmenteBienesMateriales();
            }
        }, ['askHasExperimentadoPresionFirmarContraVoluntadid']);
    }
    public function askAlguienDestruidoIntencionalmenteBienesMateriales(): void
    {
        $question = Question::create('¿Alguien ha destruido intencionalmente tus bienes materiales o propiedades como forma de control o castigo?')
            ->fallback('Edad no valida')
            ->callbackId('askAlguienDestruidoIntencionalmenteBienesMaterialesid')
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

                $this->AlguienDestruidoIntencionalmenteBienesMateriales = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTeHanImpedidoTrabajarOEstudiarLimitar();
            }
        }, ['askAlguienDestruidoIntencionalmenteBienesMaterialesid']);
    }
    public function askTeHanImpedidoTrabajarOEstudiarLimitar(): void
    {
        $question = Question::create('¿Te han impedido trabajar o estudiar como forma de limitar tu independencia financiera?')
            ->fallback('Edad no valida')
            ->callbackId('askTeHanImpedidoTrabajarOEstudiarLimitarid')
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
                $this->TeHanImpedidoTrabajarOEstudiarLimitar = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askAlgunaPersonaCercanaUtilizadoBienesSinConsentimiento();
            }
        }, ['askTeHanImpedidoTrabajarOEstudiarLimitarid']);
    }
    public function askAlgunaPersonaCercanaUtilizadoBienesSinConsentimiento(): void
    {
        $question = Question::create('¿Alguna persona cercana a ti ha utilizado tus bienes o propiedades sin tu consentimiento o de manera abusiva?')
            ->fallback('Edad no valida')
            ->callbackId('askAlgunaPersonaCercanaUtilizadoBienesSinConsentimientoid')
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
                $this->AlgunaPersonaCercanaUtilizadoBienesSinConsentimiento = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->enproceso();
            }
        }, ['askAlgunaPersonaCercanaUtilizadoBienesSinConsentimientoid']);
    }

    //Económica
    public function askHasExperimentadoPresionAsumirDeudasCompromisos(): void
    {
        $question = Question::create('¿Has experimentado presión para asumir deudas o compromisos financieros que no deseabas asumir?')
            ->fallback('Edad no valida')
            ->callbackId('askHasExperimentadoPresionAsumirDeudasCompromisosid')
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

                $this->HasExperimentadoPresionAsumirDeudasCompromisos = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askAlguienCercanoATiControlaTusIngresos();
            }
        }, ['askHasExperimentadoPresionAsumirDeudasCompromisosid']);
    }
    public function askAlguienCercanoATiControlaTusIngresos(): void
    {
        $question = Question::create('¿Alguien cercano a ti controla tus ingresos económicos, impidiéndote tomar decisiones sobre el dinero que ganas o administrar tus recursos?')
            ->fallback('Edad no valida')
            ->callbackId('askHalguienCercanoATiControlaTusIngresosid')
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

                $this->AlguienCercanoATiControlaTusIngresos = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTeHanNegadoRecursosEconomicos();
            }
        }, ['askHalguienCercanoATiControlaTusIngresosid']);
    }
    public function askTeHanNegadoRecursosEconomicos(): void
    {
        $question = Question::create('¿Te han negado recursos económicos para cubrir tus necesidades básicas, como alimento, vivienda o atención médica?')
            ->fallback('Edad no valida')
            ->callbackId('askTeHanNegadoRecursosEconomicosid')
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

                $this->TeHanNegadoRecursosEconomicos = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTeHanImpedidoTrabajarOEstudiarLimitarFinanciera();
            }
        }, ['askTeHanNegadoRecursosEconomicosid']);
    }
    public function askTeHanImpedidoTrabajarOEstudiarLimitarFinanciera(): void
    {
        $question = Question::create('¿Te han impedido trabajar o estudiar como forma de limitar tu independencia financiera?')
            ->fallback('Edad no valida')
            ->callbackId('askTeHanImpedidoTrabajarOEstudiarLimitarFinancieraid')
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

                $this->TeHanImpedidoTrabajarOEstudiarLimitarFinanciera = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->enproceso();
            }
        }, ['askTeHanImpedidoTrabajarOEstudiarLimitarFinancieraid']);
    }

    //Vicaria
    public function askTeSientesPresionadaActuarPerderContactoHijasHijos(): void
    {
        $question = Question::create('¿Te sientes presionada a actuar de cierta manera por miedo a perder contacto con tus hijos o hijas?')
            ->fallback('Edad no valida')
            ->callbackId('askTeSientesPresionadaActuarPerderContactoHijosid')
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

                $this->TeSientesPresionadaActuarPerderContactoHijos = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTuParejaExparejaImpedidoComuniquesHijasHijos();
            }
        }, ['askTeSientesPresionadaActuarPerderContactoHijosid']);
    }
    public function askTuParejaExparejaImpedidoComuniquesHijasHijos(): void
    {
        $question = Question::create('¿Tu pareja o expareja ha impedido que te comuniques con tus hijas e hijos?')
            ->fallback('Edad no valida')
            ->callbackId('askTuParejaExparejaImpedidoComuniquesHijasHijosid')
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

                $this->TuParejaExparejaImpedidoComuniquesHijasHijos = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askHasNotadoTuParejaUtilizaHijasHijos();
            }
        }, ['askTeSientesPresionadaActuarPerderContactoHijosid']);
    }
    public function askHasNotadoTuParejaUtilizaHijasHijos(): void
    {
        $question = Question::create('¿Has notado que tu pareja utiliza a los hijos e hijas para chantajearte emocionalmente?')
            ->fallback('Edad no valida')
            ->callbackId('askHasNotadoTuParejaUtilizaHijasHijosid')
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

                $this->HasNotadoTuParejaUtilizaHijasHijos = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTeSientesExcluidaDecisionesImportantesHijasHijos();
            }
        }, ['askHasNotadoTuParejaUtilizaHijasHijosid']);
    }
    public function askTeSientesExcluidaDecisionesImportantesHijasHijos(): void
    {
        $question = Question::create('¿Te sientes excluida de decisiones importantes relacionadas con tus hijos o hijas?')
            ->fallback('Edad no valida')
            ->callbackId('TeSientesExcluidaDecisionesImportantesHijasHijosid')
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

                $this->TeSientesExcluidaDecisionesImportantesHijasHijos = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->enproceso();
            }
        }, ['TeSientesExcluidaDecisionesImportantesHijasHijosid']);
    }

    //Digital
    public function askHasRecibidoAmenazasATravezMensajesRedesCorreo(): void
    {
        $question = Question::create('¿Has recibido amenazas, insultos o acoso a través de mensajes de texto, redes sociales o correo electrónico?')
            ->fallback('Edad no valida')
            ->callbackId('askHasRecibidoAmenazasATravezMensajesRedesCorreoid')
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

                $this->HasRecibidoAmenazasATravezMensajesRedesCorreo = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askAlguienHaDifundidoInformacionFalsaLinea();
            }
        }, ['askHasRecibidoAmenazasATravezMensajesRedesCorreoid']);
    }
    public function askAlguienHaDifundidoInformacionFalsaLinea(): void
    {
        $question = Question::create('¿Alguien ha difundido información falsa o dañina sobre ti en línea?')
            ->fallback('Edad no valida')
            ->callbackId('askAlguienHaDifundidoInformacionFalsaLineaid')
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

                $this->AlguienHaDifundidoInformacionFalsaLinea = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askHasExperimentadoRoboIdentidadLineaSuplantacion();
            }
        }, ['askAlguienHaDifundidoInformacionFalsaLineaid']);
    }
    public function askHasExperimentadoRoboIdentidadLineaSuplantacion(): void
    {
        $question = Question::create('¿Has experimentado el robo de identidad en línea o la suplantación de tu identidad en redes sociales?')
            ->fallback('Edad no valida')
            ->callbackId('askHasExperimentadoRoboIdentidadLineaSuplantacionid')
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

                $this->HasExperimentadoRoboIdentidadLineaSuplantacion = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTeHanPresionadoEnviarFotosIntimasInformacionPersonal();
            }
        }, ['askHasExperimentadoRoboIdentidadLineaSuplantacionid']);
    }
    public function askTeHanPresionadoEnviarFotosIntimasInformacionPersonal(): void
    {
        $question = Question::create('¿Te han presionado para enviar fotos íntimas o información personal en línea?')
            ->fallback('Edad no valida')
            ->callbackId('askTeHanPresionadoEnviarFotosIntimasInformacionPersonalid')
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

                $this->TeHanPresionadoEnviarFotosIntimasInformacionPersonal = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->enproceso();
            }
        }, ['askTeHanPresionadoEnviarFotosIntimasInformacionPersonalid']);
    }



    //Planes de acción y protección ante situaciones de violencia
    public function askPlanesDeAccionProteccionSituacionViolencia(): void
    {
        $question_askPlanesDeAccionProteccionSituacionViolencia = Question::create('Planes de acción y protección ante situaciones de violencia')
            ->fallback('Edad no valida')
            ->callbackId('askPlanesDeAccionProteccionSituacionViolenciaid')
            ->addButtons([
                Button::create('Sexual')->value('Sexual'),
                Button::create('Física')->value('Física'),
                Button::create('Psicológica')->value('Psicológica'),
                Button::create('Si te preguntas ¿Qué puedo hacer si vivo con una persona violenta?')->value('Si te preguntas ¿Qué puedo hacer si vivo con una persona violenta? '),
                Button::create('Anterior')->value('Anterior'),


            ]);

        $this->ask($question_askPlanesDeAccionProteccionSituacionViolencia, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Sexual', 'Física','Psicológica','Anterior','Si te preguntas ¿Qué puedo hacer si vivo con una persona violenta?'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } elseif($selectedValue=='Sexual') {
                $this->askEnEventoViolenciaSexualHuboExposicionRiesgo();
            } elseif($selectedValue=='Física'){
                $this->askAquiTemuestroPlanesAccionFisica();
            } elseif($selectedValue=='Psicológica'){
                $this->say('Tus contactos pueden llamarte, acudir a tu casa o al lugar donde te encuentres para cerciorarse de que estés bien, así como frenar la situación de violencia y en el momento oportuno, poder salir del lugar con cualquier excusa, evitando que la situación de peligro se agrave');

            } elseif($selectedValue=='Si te preguntas ¿Qué puedo hacer si vivo con una persona violenta?'){
                $this->say('Comentarlo con alguna persona de tu absoluta confianza, acudir a alguna Institución especializada para recibir atención, romper con la relación, implementar un plan de seguridad para disminuir cualquier situación de riesgo. Es muy importante saber que el plan de seguridad es personal, si bien, hay estrategias generales que puedes seguir, cada caso es diferente, por lo que si sientes que estas en una relación violenta, es necesario que una profesional te acompañe a realizar tu propio plan');

            } elseif($selectedValue=='Anterior'){
                $this->askAquiTengoUnasOpcionesParaTi();
            }


        }, ['askPlanesDeAccionProteccionSituacionViolenciaid']);



    }
    //sexual
    public function askEnEventoViolenciaSexualHuboExposicionRiesgo(): void
    {
        $question = Question::create('¿En el evento de violencia sexual hubo una exposición de riesgo? Es decir, hubo contacto con fluidos transmisibles como sangre, semen, líquido preseminal, lubricación vaginal, leche materna, u otros.')
            ->fallback('Edad no valida')
            ->callbackId('askEnEventoViolenciaSexualHuboExposicionRiesgoid')
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

                $this->EnEventoViolenciaSexualHuboExposicionRiesgo = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='Si'){
                        $this->askSucedioInmediato();
                }else{

                }

            }
        }, ['askEnEventoViolenciaSexualHuboExposicionRiesgoid']);
    }
    public function askSucedioInmediato(): void
    {
        $question = Question::create('¿Sucedió en lo inmediato?')
            ->fallback('Edad no valida')
            ->callbackId('askSucedioInmediatoid')
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

                $this->SucedioInmediato = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='Si'){
                    $this->say("Debes saber que tienes derecho a la Profilaxis Post Exposición (PPE) "."<br> <ul>"."
                                <li> La PPE es la administración de medicamentos antirretrovirales para disminuir los riesgos de infección por VIH y otras ITS.</li> 
                                <li> Este procedimiento debe realizarse preferentemente dentro de las primaras 48 y hasta las 72 horas después de la exposición de riegos y durante los siguientes 28 días de forma ininterrumpida.</li> 
                                <li>Los medicamentos antirretrovirales se utilizan para evitar la multiplicación del virus, es muy importante aclarar que la administración de estos medicamentos puede tener algunos efectos secundarios entre los que se encuentra; náusea, vómito, diarrea, fiebre, erupción cutánea y dolor muscular, por lo que en caso de presentar alguno de los síntomas descritos debes acudir con la o el médico.
                                En caso de que decidas recibir la PPE, esta puede ser proporcionada por instituciones de salud, tales como los CAPASITS (Centros Ambulatorios para la Prevención y Atención en SIDA e Infecciones de Transmisión Sexual) y en los Servicios de Atención Integral Hospitalaria. (Hay en todas las Entidades de la República).
                                </li></ul>");
                    $this->askTengoMasInformacionSepasHAcerDespuesEvento();

                }else{
               //hoja 15
                }



            }
        }, ['askSucedioInmediatoid']);
    }
    public function askTengoMasInformacionSepasHAcerDespuesEvento():void
    {
        $question = Question::create('Tengo más información para que sepas que hacer después de un evento de violencia sexual')
            ->fallback('Edad no valida')
            ->callbackId('askTengoMasInformacionSepasHAcerDespuesEventoid')
            ->addButtons([
                Button::create("Aqui tengo algunos numeros de servicios de atencion en tu entidad")->value('Aqui tengo algunos numeros de servicios de atencion en tu entidad'),
                Button::create("Anticoncepción de emergencia")->value('Anticoncepción de emergencia'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Aqui tengo algunos numeros de servicios de atencion en tu entidad', 'Anticoncepción de emergencia'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->TengoMasInformacionSepasHAcerDespuesEvento = $selectedValue;
                $this->say('<div class="response-right">' . $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='Aqui tengo algunos numeros de servicios de atencion en tu entidad'){
                    $this->askLineasAtencionEspecializadaDerechosSexualesFiltro();
                }elseif($selectedValue=='Anticoncepción de emergencia'){
                    $this->say("Es la administración de hormonas (contenidas en las píldoras anticonceptivas a mayores dosis) en las primeras 72 hrs. del evento de riesgo. Las cuales pueden evitar el embarazo a través de detener la liberación de los óvulos o la fecundación. Este método NO debe usarse como planificación familiar y es muy importante saber que NO previene infecciones de transmisión sexual ni VIH.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTieneDerechoPuedesolicitarGuardarEvidencia();
                }


            }
        }, ['askTengoMasInformacionSepasHAcerDespuesEventoid']);
    }
    public function askLineasAtencionEspecializadaDerechosSexualesFiltro(): void
    {

        $this->say("Líneas de atención especializada en derechos sexuales y reproductivos por filtro");
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askTieneDerechoPuedesolicitarGuardarEvidencia();


    }
    public function askTieneDerechoPuedesolicitarGuardarEvidencia(): void
    {

        $this->say("<ul>
                    <li>1.Tienes derecho a recibir atención integral gratuita y especializada, así como a recibir orientación sobre procesos jurídicos y atención a tu salud.</li>
                    <li>2. Puedes solicitar acompañamiento cuando lo desees. Existen instituciones públicas y de sociedad civil que te  pueden otorgar atención de manera inmediata y gratuita.</li>
                    <li>3. Guarda evidencias de lo sucedido, sin que ello te ponga en riesgo. (puedes guardar ropa, fotos u otros objetos).</li>
                </ul>");


    }
    //Fisica
    public function askAquiTemuestroPlanesAccionFisica():void
    {
        $question = Question::create('Aquí te muestro planes de acción y protección ante situaciones de violencia fisica')
            ->fallback('Edad no valida')
            ->callbackId('askAquiTemuestroPlanesAccionFisicaid')
            ->addButtons([
                Button::create("Antes de un evento de violencia")->value('Antes de un evento de violencia'),
                Button::create("Ante violencia física y la persona agresora está armada")->value('Ante violencia física y la persona agresora está armada'),
                Button::create("Para protegerte fuera de la casa, escuela o lugar de trabajo, considera los siguientes puntos")->value('Para protegerte fuera de la casa, escuela o lugar de trabajo, considera los siguientes puntos'),
                Button::create("Lo que puedes hacer si llegan a discutir y la situación se pone peligrosa")->value('Lo que puedes hacer si llegan a discutir y la situación se pone peligrosa'),
                Button::create("Qué hacer si la persona agresora intenta secuestrarme")->value('Qué hacer si la persona agresora intenta secuestrarme'),
                Button::create("Existen otras estrategias que podemos crear conjuntamente y compartir")->value('Existen otras estrategias que podemos crear conjuntamente y compartir'),
                Button::create("Si la persona agresora ha dejado la casa")->value('Si la persona agresora ha dejado la casa'),
                Button::create("Estrategias para implementar con niñas y niños dentro de casa ante situaciones de violencia")->value('Estrategias para implementar con niñas y niños dentro de casa ante situaciones de violencia'),
                Button::create("¿Qué hacer si una mujer, niña o adolescente está desaparecida?")->value('¿Qué hacer si una mujer, niña o adolescente está desaparecida?'),

            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, [
                'Antes de un evento de violencia',
                'Ante violencia física y la persona agresora está armada',
                'Para protegerte fuera de la casa, escuela o lugar de trabajo, considera los siguientes puntos',
                'Lo que puedes hacer si llegan a discutir y la situación se pone peligrosa',
                'Qué hacer si la persona agresora intenta secuestrarme',
                'Existen otras estrategias que podemos crear conjuntamente y compartir',
                'Si la persona agresora ha dejado la casa',
                'Estrategias para implementar con niñas y niños dentro de casa ante situaciones de violencia',
                '¿Qué hacer si una mujer, niña o adolescente está desaparecida?'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            }
            $this->AquiTemuestroPlanesAccionFisica = $selectedValue;
            $this->say('<div class="response-right">' . $answer->getText().'</div>');
            $this->bot->typesAndWaits($this->tiempoRespuesta);

            if($selectedValue == 'Antes de un evento de violencia'){
                $this->askSiyaIdentificasteSituacionPeligro();
            }elseif($selectedValue == 'Ante violencia física y la persona agresora está armada'){
                $this->say('Recuerda que un arma puede ser punzo cortante (cuchillos, navajas, etc.) o de fuego. Ten constante comunicación con tus contactos y/o redes de apoyo, quienes pueden llamarte y mantenerse en línea contigo mientras acuden a tu casa para frenar la situación de violencia y en el momento oportuno, poder salir del lugar y recibir la atención médica en caso de que lo necesites. ');
            }elseif($selectedValue == 'Para protegerte fuera de la casa, escuela o lugar de trabajo, considera los siguientes puntos'){
                $this->say('Cambia regularmente las rutas de tu trayecto. Haz compras en lugares diferentes. Mantén los números telefónicos de emergencia contigo todo el tiempo. Comparte tu ubicación con los contactos que elegiste en la APP de Sendero Violeta, ¡descargala! o con cualquier otra persona de tu confianza. Evita utilizar tu celular si vas caminando o manejando. Antes de salir o entrar a algún lugar mira a tu alrededor y observa si no está la persona agresora o hay algo extraño en el entorno.');

            }elseif($selectedValue == 'Lo que puedes hacer si llegan a discutir y la situación se pone peligrosa'){
                $this->say('Haz lo posible por moverte hacia un lugar cerca de la puerta o por donde puedas salir sin peligro
                            No entres a los baños o la cocina (a menos que allí haya una salida). Aléjate de lugares donde haya objetos pesados o con los que pueden lastimarte (esculturas, cuchillos, tijeras, etc.). 
                            Ve a alguna habitación donde haya un teléfono (llama al 911 o alguna red de apoyo) o una ventana grande donde puedas salir sin lastimarte. 
                            Recuerda que tú eres la única persona que puede decidir cuál es el mejor momento para dejar la casa. Sin ponerte en mayor peligro, espera la oportunidad hasta que puedas salir. 
                            Si la situación se vuelve peligrosa y te das cuenta de que no hay cómo salir inmediatamente, hazle caso a la persona agresora en ese momento, hasta que se tranquilice. Debes protegerte hasta que esté fuera de peligro.
                            Si te han golpeado, busca ayuda médica y en la medida de lo posible, trata de tomarte fotos de las heridas, es importante para tener evidencias. ');
            }
            elseif($selectedValue == 'Qué hacer si la persona agresora intenta secuestrarme'){
                $this->say('No desestimes tus presentimientos, ni minimices las situaciones de riesgo ¡No estás sola¡ Si han salido y de pronto te das cuenta de que toma una dirección distinta, percibes algo extraño, no te dice a donde van o lo que responde no te hace sentir segura puedes compartir tu ubicación con algún contacto o redes de apoyo. También pueden llamarte en ese momento como si te estuviera saludando para que puedas decirle por donde vas. Después de unos 15 min puede volverte a llamar con algún pretexto para que se cerciore de que estas bien. Si no contestas es importante que tus contactos notifiquen a las autoridades correspondientes. ');

            }
            elseif($selectedValue == 'Existen otras estrategias que podemos crear conjuntamente y compartir'){
                $this->say('Te compartimos líneas de Atención especializada (diferenciando psicología feminista (los CEAR) de atención psicológica).');

            }
            elseif($selectedValue == 'Si la persona agresora ha dejado la casa'){
                $this->say('Se sugiere cambiar cerraduras nuevas en las puertas, porque recuerda que él todavía puede tener una copia de las llaves.  Ponle seguros a las ventanas por si él intenta abrir o forzarlas. Comparte con alguna vecina o vecino de tu confianza a grandes rasgos tu situación para que te pueda informar si la persona agresora se presenta o lo ven rondando cerca.   Informa a la escuela o al centro de cuidado de tus hijas/os quién tiene permiso para recogerlas/os. Si tienes una orden de protección entrégale una copia al personal de la escuela.  Si no cuentas con una orden de protección puedes tramitarla. Cambia el número de teléfono fijo o celular y no llames a la persona agresora desde ellos. ');
            }
            elseif($selectedValue == 'Estrategias para implementar con niñas y niños dentro de casa ante situaciones de violencia'){
                $this->say('Tu seguridad y bienestar, así como la de tus hijas e hijos es lo más importante
                    <br>
                    <ul>
                    <li>1. Identifica cuáles son los lugares más seguros. 
                    Detecten el lugar más seguro dentro de casa donde no haya objetos punzo cortantes o pesados. Dependiendo de su edad, busquen conjuntamente lugares seguros para “esconderse” y permanecer en silencio hasta que tú le vayas a buscar.
                    </li>
                    <li>
                    2. Identifica quienes son las personas de confianza.
                    Plática con tus hijas e hijos sobre las personas a quienes pueden llamar si hay un evento violento o la persona vecina con quien puedes acudir si el ambiente en casa se pone tenso. 
                    </li>
                    <li>
                    3. Mantener distancia en un lugar seguro ante un evento violento. 
                    Enséñales a tus hijas e hijos a no intervenir ni interponerse si hay un evento violento, a alejarse y mantenerse en el lugar seguro que han identificado. 
                    </li>
                    <li>
                    4. Pedir ayuda. Si su edad lo permite, enséñales a llamar al 911, mandar mensaje celular a un familiar o a salir sin que se pongan en riesgo para buscar ayuda con las y los vecinos. 
                    </li>
                    <li>
                    5. Desarrolla un Plan de seguridad. 
                    Hay muchas formas de hacerlo, una de ellas es utilizar el juego “qué haría si…” contáctanos y podemos orientarte sobre cómo hacerlo.
                    </li>
                    </ul>');
            }

            elseif($selectedValue == '¿Qué hacer si una mujer, niña o adolescente está desaparecida?'){
                $this->say('<ul>
                            <li>1. Recabar información sobre la niña o la mujer desaparecida (datos generales, descripción física, fotos recientes, datos laborales o escolares, si existían antecedentes de violencias).
                            Informar a las autoridades: 
                            </li>
                            <li>
                            2. Puedes acudir a un Ministerio Público, recuerda que NO pueden pedirte esperar 72 horas para iniciar la investigación, deben realizarla de inmediato. Te harán una entrevista para que puedas compartir los datos e información que recabaste. 
                            Si el Ministerio Público al que acudiste no es una Fiscalía Especializada deberán iniciar la carpeta de investigación y remitirla a la Fiscalía Especializada del Estado.
                            De igual forma puedes acudir de forma presencial ante la autoridad más cercana a tu domicilio, tiene la obligación de atenderte. 
                            Vía telefónica
                            </li>
                            <li>
                            3. También puedes realizar un reporte de desaparición vía telefónica a la comisión Nacional de Búsqueda al 5513099024/ 8000287783, al correo  cnbreportadesaparecidos.segob.mx.
                            Ten contigo la información sobre la niña o la mujer desaparecida (datos generales, descripción física, fotos recientes, datos laborales o escolares, si existían antecedentes de violencias).
                            Recuerda: las autoridades deben atenderte de forma empática e inmediata.
                            Siembre deben otorgarte un trato digno y no desestimar tu denuncia o reporte con comentarios discriminatorio o machistas.
                            Las autoridades tienen la obligación de recabar la información y canalizarte de forma inmediata con las instancias especializadas.
                            </li>
                            </ul>');
             $this->askTeMuestroMasAccionesViolenciaFisica();
            }

        }, ['askAquiTemuestroPlanesAccionFisicaid']);
    }
    public function askTeMuestroMasAccionesViolenciaFisica():void
    {
        $question = Question::create('Te muestro mas opciones de acciones de Violencia Fisica')
            ->fallback('Edad no valida')
            ->callbackId('askTeMuestroMasAccionesViolenciaFisicaid')
            ->addButtons([
                Button::create("Alerta Amber y Protocolo")->value('Alerta Amber y Protocolo'),
                Button::create("Has uso de tu denuncia en la CNDH")->value('Has uso de tu denuncia en la CNDH'),

            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Prepara con tiempo','Identifica personas conocidas, amigas o familiares que puedan apoyarte','Identificamos los siguientes servicios de atención a las mujeres en tu entidad','Identificamos los siguientes servicios de atención a las mujeres en tu entidad'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            }
            $this->TeMuestroMasAccionesViolenciaFisica = $selectedValue;
            $this->say('<div class="response-right">' . $answer->getText().'</div>');
            $this->bot->typesAndWaits($this->tiempoRespuesta);

            if($selectedValue == 'Alerta Amber y Protocolo') {
                $this->say('Tienes derecho a solicitar la Alerta Amber, en caso de niñas y adolescentes al 8000085400 y el Protocolo alba en caso de mujeres desaparecidas. (Ambas alertas las puedes solicitar al momento de realizar la denuncia o reporte). También puedes apoyarte de Organizaciones de la Sociedad Civil y difundir en redes sociales la ficha de búsqueda.  <a href="https://www.idheas.org.mx/ ">https://www.idheas.org.mx/ </a>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

            }
            if($selectedValue == 'Has uso de tu denuncia en la CNDH') {
                $this->say('<ul><li> 1. También puedes presentarle en línea https://atencionciuadana.com CNDH 55 5681 8125  /   55 5490 7400 </li> <li> 2. Realiza tu reporte La fiscalía Especializada y Comisiones de Búsqueda deben expedir una ficha de búsqueda que contenga: nombre completo; fotografía; descripción física, última fecha y lugar en dónde fue vista; último contacto que se tuvo con ella (precisando el evento) y vestimenta que llevaba puesta el día de su desaparición.  Si así lo deseas, puedes participar de forma activa en la búsqueda y puedes solicitar a las autoridades; los videos de vigilancia; acceso a investigación de perfiles de redes sociales; geolocalización de cualquier dispositivo; comunicación inmediata con hospitales, terminales de autobuses, aeropuertos y otros espacios; documentos de antecedentes de violencias.  </li></ul>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

            }



        }, ['askTeMuestroMasAccionesViolenciaFisicaid']);
    }
    public function askSiyaIdentificasteSituacionPeligro():void
    {
        $question = Question::create('Si ya identificaste que estás en una situación de peligro, temes por tu vida y la de tus hijas e hijos o sientes que estas en extremo riesgo llama a la policía')
            ->fallback('Edad no valida')
            ->callbackId('askSiyaIdentificasteSituacionPeligroid')
            ->addButtons([
                Button::create("Prepara con tiempo")->value('Prepara con tiempo'),
                Button::create("Identifica personas conocidas, amigas o familiares que puedan apoyarte")->value('Identifica personas conocidas, amigas o familiares que puedan apoyarte'),
                Button::create("Identificamos los siguientes servicios de atención a las mujeres en tu entidad")->value('Identificamos los siguientes servicios de atención a las mujeres en tu entidad')
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Prepara con tiempo','Identifica personas conocidas, amigas o familiares que puedan apoyarte','Identificamos los siguientes servicios de atención a las mujeres en tu entidad','Identificamos los siguientes servicios de atención a las mujeres en tu entidad'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            }
            $this->SiyaIdentificasteSituacionPeligro = $selectedValue;
            $this->say('<div class="response-right">' . $answer->getText().'</div>');
            $this->bot->typesAndWaits($this->tiempoRespuesta);

            if($selectedValue == 'Prepara con tiempo'){
                $this->say('Maleta/mochila de emergencia: con ropa, documentos importase y cosas tuyas, y si tienes hijas/os también de ellos, si es posible ten un celular alterno con crédito. Déjalos con alguien de confianza, como una vecina, un familiar, una amistad. No olvides llevar medicamentos si están en algún tratamiento.  
                            Habla sobre tu plan de seguridad con tus hijas/os: Deben tener una señal que solamente ustedes conozcan que signifique que deben salir de la casa rápidamente, llamar a la policía o pedir apoyo con alguna vecina/o');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->say('Postal Wendy');

            }elseif($selectedValue == 'Identifica personas conocidas, amigas o familiares que puedan apoyarte'){
                $this->say('<b>Redes de apoyo:</b> elige personas conocidas, amigas o familiares que puedan apoyarte, y contáctalas para que estén pendientes de la situación y puedan apoyarte, puedes acordar previamente con ellas claves con emojis para que sepan que significa y llamar a la policía de ser necesario. Memoriza o haz una lista con los números de teléfono de tus amistades, familiares, personas del trabajo o de alguna organización o servicio local en donde te puedan ayudar.  Puedes ir a casa de alguna amistad o familiar, preferible a un lugar donde la persona agresora no se atreva a ir a buscarte o a la casa de alguien que él no conozca. Si no cuenta son una red de apoyo puedes comunicarte con nosotras.');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

            }elseif($selectedValue == 'Identificamos los siguientes servicios de atención a las mujeres en tu entidad'){
                $this->say('Líneas de emergencia (filtrando por…');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
            }


        }, ['askSiyaIdentificasteSituacionPeligroid']);
    }

    //Información sobre derechos sexuales y reproductivos

    public function askDebesSaberTienesDerechoSobreDerechoSexuales():void
    {
        $question = Question::create('Debes saber que tienes derecho a:')
            ->fallback('Edad no valida')
            ->callbackId('askDebesSaberTienesDerechoSobreDerechoSexualesid')
            ->addButtons([
                Button::create("Menstruación digna")->value('Menstruación digna'),
                Button::create("Plenipausia")->value('Plenipausia'),
                Button::create("Acceder a servicios de salud y atención médica")->value('Acceder a servicios de salud y atención médica'),
                Button::create("Métodos Anticonceptivos")->value('Métodos Anticonceptivos'),


            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ["Menstruación digna", "Plenipausia", "Acceder a servicios de salud y atención médica", "Métodos Anticonceptivos"])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            }
            $this->DebesSaberTienesDerechoSobreDerechoSexuales = $selectedValue;
            $this->say('<div class="response-right">' . $answer->getText().'</div>');
            $this->bot->typesAndWaits($this->tiempoRespuesta);

            if($selectedValue == 'Menstruación digna') {
                $this->say('Garantizar el acceso y abasto de los insumos contribuye a revertir la desigualdad histórica en la que viven niñas, adolescentes y mujeres. Hablar de la menstruación es un derecho y permite resignificarla y vivirla sin tabúes, además facilita identificar las discriminaciones y desigualdades que impactan en la vida de las mujeres.  Nombrar la menstruación sirve para el reconocimiento de la cuerpa, para saber que la sangre anuncia cambios.');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
            }
            elseif($selectedValue == 'Plenipausia') {
                $this->say('Se refiere a la plenitud que la mujer alcanza en la menopausia cuando rompe con los mitos de esta etapa.
                            . Identifica que las mujeres somos cíclicas.
                            . Culturalmente se asocia a la pérdida o a lo negativo, pero desde la medicina de la tierra presupone una conexión con la CREATIVIDAD y la SABIDURIA  de la cuerpa. 
                            . Es la oportunidad de dedicarse completamente a una misma');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
            }
            elseif($selectedValue == 'Acceder a servicios de salud y atención médica') {
                $this->say('Todas las mujeres tienen derecho a acceder a servicios de salud y atención médica, y quienes decidan ser madres, a tener una maternidad segura y libre de todo riesgo durante el proceso reproductivo, es decir desde la intención reproductiva, la concepción, gestación, parto y puerperio. El gozo y el placer también ¡es un derecho!');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
            }
            elseif($selectedValue == 'Métodos Anticonceptivos') {
                $this->say('<ul>
                            <li>Para prevenir un embarazo, empieza a usar un método anticonceptivo, como alguno de los siguientes:
                            </li>
                            <li>Un condón interno femenino o uno externo masculino.
                            </li>
                            <li>Un método hormonal, como las pastillas, inyecciones o implantes anticonceptivos. De haber tenido un aborto el mismo día que te hagas el aborto. Evitarás un embarazo si empiezas a usar un método hormonal durante los primeros 7 días después del aborto. Pero si esperas más de 7 días para empezar a usarlo, debes usar un condón durante la primera semana, ya que los métodos hormonales toman tiempo para empezar a funcionar y protegerte. 
                            </li>
                            <li>	
                            Te pueden colocar un DIU, en caso de aborto tan pronto como confirmen que el aborto fue exitoso y que no hay infección. Usa condones hasta que te coloquen el DIU.
                            </li>
                            <li>
                            Existen métodos permanentes para que las personas que tienen la certeza de que nunca más quieren tener otro embarazo. La operación llamada “ligadura de trompas” en la que se cortan los tubos que llevan los óvulos al útero, lo que previene el embarazo. También hay una operación llamada “vasectomía” en la que se cortan los tubos que llevan el esperma desde los testículos al pene.  Esto impide que el esperma salga del pene durante la eyaculación, lo que previene el embarazo. 
                            </li>
                            </ul>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                $this->say('Te compartimos una APP con toda esta información <b> <a href="https://play.google.com/store/apps/details?id=org.hesperian.Family_Planning">link de la APP</a><b>');


            }




        }, ['askDebesSaberTienesDerechoSobreDerechoSexualesid']);
    }



    //Orientación psicológica
    public function askTePuedoAcompañarAlgunasPreguntasIdentificarProcesoPsicoterapeutico():void
    {
        $question = Question::create('Te puedo acompañar con algunas preguntas que te permitan identificar temas de interés en tu proceso psicoterapéutico.')
            ->fallback('Edad no valida')
            ->callbackId('askTePuedoAcompañarAlgunasPreguntasIdentificarProcesoPsicoterapeuticoid')
            ->addButtons([

            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, [])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            }
            $this->TePuedoAcompañarAlgunasPreguntasIdentificarProcesoPsicoterapeutico = $selectedValue;
            $this->say('<div class="response-right">' . $answer->getText().'</div>');
            $this->bot->typesAndWaits($this->tiempoRespuesta);

            if($selectedValue == '') {

            }





        }, ['askDebesSaberTienesDerechoSobreDerechoSexualesid']);
    }



// Me comuniqué con anterioridad y necesito atención.
    public function askAnteriormenteTeBrindeInformacionRequerias(): void
    {
        $question = Question::create('Anteriormente ¿te brinde la información que requerías?')
            ->fallback('Edad no valida')
            ->callbackId('AnteriormenteTeBrindeInformacionRequeriasid')
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

                $this->AnteriormenteTeBrindeInformacionRequerias = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='Si'){
                $this->askHeSeleccionadAlgunasAtencionesPuedesRecibirAtravesOrganizacionesFormanParteRNROtros();
                }else{
                 $this->askCompartemeTusSugerenciasPropuestas();

                }


            }
        }, ['AnteriormenteTeBrindeInformacionRequeriasid']);
    }
    public function askHeSeleccionadAlgunasAtencionesPuedesRecibirAtravesOrganizacionesFormanParteRNROtros(): void
    {
        $question = Question::create('He seleccionado algunas atenciones que puedes recibir a través de organizaciones que forman parte de la Red Nacional de Refugios y de otras organizaciones que podrían apoyarte. Selecciona en el siguiente menú la que corresponde a la atención que estas buscando.')
            ->fallback('Edad no valida')
            ->callbackId('askHeSeleccionadAlgunasAtencionesPuedesRecibirAtravesOrganizacionesFormanParteRNROtrosid')
            ->addButtons([
                Button::create('Atención psicológica')->value('Atención psicológica'),
                Button::create('Orientación Social')->value('Orientación Social'),
                Button::create('Orientación y acompañamiento para el ejercicio y acceso a tus derechos sexuales y reproductivos')->value('Orientación y acompañamiento para el ejercicio y acceso a tus derechos sexuales y reproductivos'),
                Button::create('Autogestión económica y economía feminista')->value('Autogestión económica y economía feminista'),
                Button::create('Orientación jurídica')->value('Orientación jurídica'),
            ]);



        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Atención psicológica', 'Orientación Social', 'Orientación y acompañamiento para el ejercicio y acceso a tus derechos sexuales y reproductivos', 'Autogestión económica y economía feminista', 'Orientación jurídica'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->HeSeleccionadAlgunasAtencionesPuedesRecibirAtravesOrganizaciones = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='Atención psicológica'){
                    $this->askLíneasAtenciónPsicologiaFeministaOrganizacionesNoFormanParteRNR();

                }elseif($selectedValue=='Orientación Social'){
                   $this->AlAcercarteCentrosAtencionPuedesRecibirOrientacionRealizarTramites();
                }elseif($selectedValue=='Orientación y acompañamiento para el ejercicio y acceso a tus derechos sexuales y reproductivos'){
                        $this->askLineasAtencionCEAREjercicioDerSex();
                }elseif($selectedValue=='Autogestión económica y economía feminista'){
                    $this->askLineasAtencionCEAREjercicioDerSex();
                }elseif($selectedValue=='Orientación jurídica'){
                    $this->askAlgunaOpcionesOrientacionJuridica();
                }


            }
        }, ['askHeSeleccionadAlgunasAtencionesPuedesRecibirAtravesOrganizacionesFormanParteRNROtrosid']);
    }
    public function askLíneasAtenciónPsicologiaFeministaOrganizacionesNoFormanParteRNR()
    {
        $this->ask('Líneas de atención  psicología feminista y en caso de organizaciones que no forman parte de la RNR psicológica', function (Answer $answer) {
            $this->bot->typesAndWaits($this->tiempoRespuesta);


        });
    }
    public function AlAcercarteCentrosAtencionPuedesRecibirOrientacionRealizarTramites():void{
        $this->say('Al acercarte a Centros de Atención puedes recibir orientación para realizar trámites, para obtener documentos, crear CV o plan de vida.');
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->SiTeInteresaConocerSobreProgramasSocialesTramitesConsultasUtilidad();
    }
    public function SiTeInteresaConocerSobreProgramasSocialesTramitesConsultasUtilidad(): void
    {
        $question = Question::create('Si te interesa conocer mas sobre programas sociales, tramites o consultas que te pueden ser de utilidad, selecciona:')
            ->fallback('Edad no valida')
            ->callbackId('SiTeInteresaConocerSobreProgramasSocialesTramitesConsultasUtilidadid')
            ->addButtons([
                Button::create('Programas')->value('Programas'),
                Button::create('Tramites y consultas')->value('Tramites y consultas'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Programas', 'Tramites y consultas'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->SiTeInteresaConocerSobreProgramasSocialesTramitesConsultasUtilidad = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='Programas'){
                    $this->askprogramas();
                }elseif($selectedValue=='Tramites y consultas'){
                    $this->askTramitesCconsultas();

                }


            }
        }, ['AnteriormenteTeBrindeInformacionRequeriasid']);
    }
    public function askprogramas(): void
    {
        $this->say('<ul>
                        <li>Apoyo Económico</li>
                        <li>Cultivo</li>
                        <li>Educación</li>
                        <li>Pensión</li>
                        <li>Vivienda</li>
                    </ul>');
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askSeFiltraBaseProgramasTramitesConsultas();
    }
    public function askTramitesCconsultas(): void
    {
        $this->say('<ul>
                        <li>Educación</li>
                        <li>Empleo</li>
                        <li>Finanzas Personales</li>
                        <li>Identificación</li>
                        <li>Jurídico</li>
                        <li>Seguro Social</li>
                    </ul>');
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askSeFiltraBaseProgramasTramitesConsultas();
    }
    public function askSeFiltraBaseProgramasTramitesConsultas(): void
    {
        $this->say('Se filtra la base de programas tramites y consultas');
    }
    public function askLineasAtencionCEAREjercicioDerSex():void{
        $this->say('Líneas de atención CEAR y ejercicio Der. Sex. (DIF en bd descripción)');
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->AlAcercarteCentrosAtencionPuedesRecibirOrientacionRealizarTramites();
    }
    public function askAlgunaOpcionesOrientacionJuridica(): void
    {
        $question = Question::create('a continuación algunos  opciones de Orientación Jurídica')
            ->fallback('Edad no valida')
            ->callbackId('askAlgunaOpcionesOrientacionJuridicaid')
            ->addButtons([
                Button::create('Solicitar una Orden de protección')->value('Solicitar una Orden de protección'),
                Button::create('Poner una denuncia por violencia')->value('Poner una denuncia por violencia'),
                Button::create('Números telefónicos para orientación')->value('Números telefónicos para orientación'),

            ]);


        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Solicitar una Orden de protección', 'Poner una denuncia por violencia', 'Números telefónicos para orientación'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->AlgunaOpcionesOrientacionJuridica = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='Solicitar una Orden de protección'){
                    $this->enproceso();
                } elseif($selectedValue=='Poner una denuncia por violencia'){
                    $this->askAlgunasOpcionesPonerDenunciaPorViolencia();

                } elseif($selectedValue=='Números telefónicos para orientación'){
                    $this->say('Líneas de atención  legal');

                }


            }
        }, ['AnteriormenteTeBrindeInformacionRequeriasid']);
    }
    public function askAlgunasOpcionesPonerDenunciaPorViolencia(): void
    {
        $question = Question::create('a continuación algunos  opciones de poner denuncia por violencia')
            ->fallback('Edad no valida')
            ->callbackId('askAlgunasOpcionesPonerDenunciaPorViolenciaid')
            ->addButtons([
                Button::create('¿Qué es una denuncia?')->value('¿Qué es una denuncia?'),
                Button::create('Tipos de denuncia')->value('Tipos de denuncia'),
                Button::create('¿Dónde denunciar?')->value('Números telefónicos para orientación'),
                Button::create('Requisitos para hacer una denuncia')->value('Requisitos para hacer una denuncia')
            ]);



        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['¿Qué es una denuncia?','Tipos de denuncia','¿Dónde denunciar?','Requisitos para hacer una denuncia'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->AlgunasOpcionesPonerDenunciaPorViolencia = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='¿Qué es una denuncia?'){
                    $this->say('informar al ministerio público o a la policía de hechos que constituyen un posible delito.');

                } elseif($selectedValue=='Tipos de denuncia'){
                    $this->say('<ul>
                                <li>1. Querella: reportados por la mujer afectada (Violencias). </li>
                            <li>2. Oficio: no es necesaria la presencia de la víctima (violación, feminicidio).</li>
                            <li>3. Tentativa: no se llega a la consumación, pero se pone en peligro el bien jurídico.</li>
                            </ul>');

                } elseif($selectedValue=='¿Dónde denunciar?'){
                    $this->say('<ul>
                                    <li>1. FGR</li>
                                    <li>2. FGJ</li>
                                    <li>3. Línea: denuncia.org </li>
                                </ul>');


                } elseif($selectedValue=='Requisitos para hacer una denuncia'){

                    $this->say('
                    <ul>
                    <li>1. Nombre completo (identificación).</li>
                    <li>2. Domicilio.</li>
                    <li>3. Nombre de quien cometió el delito.</li>
                    <li><ul>4. Narración de los hechos (se sugiere llevar una bitácora descriptiva de los hechos- no es un formato legal).
                        <li>4.1. Fecha y hora de los hechos.</li>
                        <li>4.2. Lugar de los hechos.</li>
                        <li>4.3. Personas que intervinieron en los hechos.</li>
                        <li>4.4. Identificación de dichas personas.</li>
                        <li>4.5. Comentar si el delito no es un hecho aislado – nombrar los Antecedentes.</li>
                    </ul>
                    </li>
                    <li>5. Sugerencias: Solicitar el número de carpeta, verificar datos personales correctos, verificar que la narración de los hechos sea correcta, solicitar una copia.</li>
                    <li>6. Conocer mis derechos humanos.
                        <ul>
                        <li>-Derecho a un trato digno.</li>
                        <li>-No revictimización.</li>
                        <li>-Orientación jurídica y defensa.</li>
                        <li>-Acompañamiento médico y psicológico.</li>
                        <li>-Refugio.</li>
                        <li>-Interprete.</li>
                        <li>-Acceso a información procesal.</li>
                        <li>-Reparación del daño.</li>
                        <li>-Medidas de protección.</li>
                        <li>-Órdenes de protección.</li>
                        <li>-Ajustes o medidas especiales.</li>
                        </ul>
                    </li>
                    </ul>
                    ');


                }


            }
        }, ['AnteriormenteTeBrindeInformacionRequeriasid']);
    }




//Información adicional
    public function askAlgunasOpcionesInformacionAdicional(): void
    {
        $question = Question::create('a continuación algunos  opciones  información adicional')
            ->fallback('Edad no valida')
            ->callbackId('askAlgunasOpcionesPonerDenunciaPorViolenciaid')
            ->addButtons([
                Button::create('Ciclo de la violencia')->value('Ciclo de la violencia'),
                Button::create('Modalidad')->value('Modalidad'),
                Button::create('¿En qué momento necesito hacer una denuncia?')->value('¿En qué momento necesito hacer una denuncia?'),
                Button::create('Y tú ¿Vives violencia?')->value('Y tú ¿Vives violencia?'),
                Button::create('Amor propio')->value('Amor propio')]);

        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Ciclo de la violencia', 'Modalidad', '¿En qué momento necesito hacer una denuncia?', 'Y tú ¿Vives violencia?', 'Amor propio'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->AlgunasOpcionesPonerDenunciaPorViolencia = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='Ciclo de la violencia'){
                    $this->say('Conocer las fases de la violencia te permitirá identificar patrones de comportamiento  y tomar medidas preventivas.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askQuieresSaberQueConsiste();
                }elseif($selectedValue=='Modalidad'){
                    $this->askLaViolenciaPresentaDiferentesAmbitos();

                }elseif($selectedValue=='¿En qué momento necesito hacer una denuncia?'){
                    $this->askTanProntoComoSeaSeguroHacerlo();
                }


            }
        }, ['AnteriormenteTeBrindeInformacionRequeriasid']);
    }

    public function askQuieresSaberQueConsiste(): void
    {
        $question = Question::create('¿Quieres saber en qué consisten?')
            ->fallback('Edad no valida')
            ->callbackId('QuieresSaberQueConsisteid')
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

                $this->QuieresSaberQueConsiste = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='Si'){
                    $this->say('<ul>
                                <li>
                                <b>FASE 1</b></br>
                                Empieza con burlas sobre lo que hablas y haces, hay gritos y amenazas bajo la excusa de que haces las cosas mal.
                                Esta fase es llamada Acumulación de tensión.
                                </li>
                                <li>
                                <b>FASE 2</b></br>
                                Sin importar si has hechos cosas para evitar el enojo de la otra persona llega el momento de la agresión.
                                Fase conocida como Explosión violenta.
                                </li>
                                <li>
                                <b>FASE 3</b></br>
                                Después de la violencia la persona agresora pide perdón, promete que no va a volver a actuar así, piensas que la relación ha cambiado y vuelves a confiar, pero vuelve a la Fase 1 y así repetidamente.
                                La fase se conoce como la Luna de Miel.
                                </li>
                                </ul>');
                }else{
                   $this->Terminar();
                }



            }
        }, ['QuieresSaberQueConsisteid']);
    }
    public function askLaViolenciaPresentaDiferentesAmbitos(): void
    {
        $question = Question::create('La violencia se presenta en diferentes ámbitos selecciona aquel del que quieras conocer más.')
            ->fallback('Edad no valida')
            ->callbackId('QuieresSaberQueConsisteid')
            ->addButtons([
                Button::create('Familiar')->value('Familiar'),
                Button::create('Laboral o docente')->value('Laboral o docente'),
                Button::create('Institucional')->value('Institucional'),
                Button::create('Feminicida')->value('Feminicida'),
                Button::create('Alerta de violencia de género contra las mujeres')->value('Alerta de violencia de género contra las mujeres'),

            ]);

        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Familiar', 'Laboral o docente', 'Institucional', 'Feminicida', 'Alerta de violencia de género contra las mujeres'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->LaViolenciaPresentaDiferentesAmbitos = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='Familiar'){
                    $this->say('La violencia familiar es el acto abusivo de poder u omisión intencional, dirigido a dominar, someter, controlar o agredir de manera física, verbal, psicológica, patrimonial, económica y sexual a las mujeres, dentro o fuera del domicilio familiar, cuya persona agresora tenga o haya tenido relación de parentesco por consanguinidad o afinidad, de matrimonio, concubinato o mantenga o  hayan mantenido una relación de hecho.');
                }elseif($selectedValue=='Laboral o docente'){
                    $this->say('Se ejerce por las personas que tienen un vínculo laboral, docente o análogo con la víctima, independientemente de la relación jerárquica, consistente en un acto o una omisión en abuso de poder que daña la autoestima, salud, integridad, libertad y seguridad de la víctima, e impide su desarrollo y atenta contra la igualdad.
                                Puede consistir en un solo evento dañino o en una serie de eventos cuya suma produce el daño. También incluye el acoso o el hostigamiento sexual.
                                La violencia laboral se constituye por la negativa ilegal a contratar a la víctima o a respetar su permanencia o condiciones generales de trabajo; la descalificación del trabajo realizado, las amenazas, la intimidación, las humillaciones, la explotación, el impedimento a las mujeres de llevar a cabo el período de lactancia previsto en la ley y todo tipo de discriminación por condición de género.
                                La violencia docente se constituye por aquellas conductas que dañen la autoestima de las alumnas con actos de discriminación por su sexo, edad, condición social, académica, limitaciones o características físicas, que les infligen maestras o maestros.
                                El hostigamiento sexual es el ejercicio del poder, en una relación de subordinación real de la víctima frente a la persona agresora en los ámbitos laboral o escolar. Se expresa en conductas verbales, física o ambas, relacionadas con la sexualidad de connotación lasciva.
                                El acoso sexual es una forma de violencia en la que, si bien no existe la subordinación, hay un ejercicio abusivo de poder que conlleva a un estado de indefensión y de riesgo para la víctima, independientemente de que se realice en uno o varios eventos. 
                                ');
                }elseif($selectedValue=='Institucional'){
                        $this->say('Son los actos u omisiones de las y los servidores públicos de cualquier orden de gobierno que discriminen o tengan como fin dilatar, obstaculizar o impedir el goce y ejercicio de los derechos humanos de las mujeres así como su acceso  al disfrute de políticas públicas destinadas a prevenir, atender, investigar, sancionar y erradicar los diferentes tipos de violencia. ');
                }
            elseif($selectedValue=='Feminicida') {
                    $this->say('La violencia feminicida es la forma extrema de violencia de género contra las mujeres, producto de la violación de sus derechos humanos, en los ámbitos público y privado, conformada por el conjunto de conductas misóginas que pueden conllevar impunidad social y del Estado y puede culminar en homicidio y otras formas de muerte violenta de mujeres');
            }
            elseif($selectedValue=='Alerta de violencia de género contra las mujeres') {
                $this->say('La alerta de violencia de género es el conjunto de acciones gubernamentales de emergencia para enfrentar y erradicar la violencia feminicida en un territorio determinado, ya sea ejercida por individuos o por la propia comunidad.');
                }


            }
        }, ['QuieresSaberQueConsisteid']);
    }
    public function askTanProntoComoSeaSeguroHacerlo(): void
    {
        $question = Question::create('Tan pronto como sea seguro hacerlo.')
            ->fallback('Edad no valida')
            ->callbackId('TanProntoComoSeaSeguroHacerloid')
            ->addButtons([
                Button::create('¿Necesitas algún servicio de emergencia en este momento?')->value('¿Necesitas algún servicio de emergencia en este momento?'),
                Button::create('Identifica los tipos de violencia')->value('Identifica los tipos de violencia'),
            ]);

        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['¿Necesitas algún servicio de emergencia en este momento?', 'Identifica los tipos de violencia'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->TanProntoComoSeaSeguroHacerlo = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='¿Necesitas algún servicio de emergencia en este momento?'){
                    $this->say('Solo los si de este menú');
                }elseif($selectedValue=='Identifica los tipos de violencia') {
                    $this->askQuieroSaberIdentificarViolencias();
                }


            }
        }, ['QuieresSaberQueConsisteid']);
    }





//Derechos sexuales y reproductivos
    public function enproceso(): void
    {

        $this->say("aqui voy!!!! :)");
    }




    //Terminar
    public function askAntesQueTeVayasMeGustariaConversacionResultoUtil(): void
    {
        $question = Question::create('Antes de que te vayas me gustaría saber: ¿nuestra conversación te resulto útil?')
            ->fallback('Edad no valida')
            ->callbackId('AntesQueTeVayasMeGustariaConversacionResultoUtilid')
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
                $this->AntesQueTeVayasMeGustariaConversacionResultoUtil = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='Si'){
                        $this->askRecomendariasGuetzaPersonasConoces();
                }else{
                    $this->CompartemeTusSugerenciasPropuestas();
                }



            }
        }, ['AntesQueTeVayasMeGustariaConversacionResultoUtilid']);
    }
    public function askRecomendariasGuetzaPersonasConoces(): void
    {
        $question = Question::create('¿Recomendarías Guetza a las personas que conoces? ')
            ->fallback('Edad no valida')
            ->callbackId('RecomendariasGuetzaPersonasConocesid')
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
                $this->RecomendariasGuetzaPersonasConoces = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);


                    $this->askConsiderasInformacionBrindadaPuedesIntegrarDiaADia();

            }
        }, ['RecomendariasGuetzaPersonasConocesid']);
    }
    public function askConsiderasInformacionBrindadaPuedesIntegrarDiaADia(): void
    {
        $question = Question::create('¿Consideras que la información brindada la puedes integrar a tu día a día? ')
            ->fallback('Edad no valida')
            ->callbackId('ConsiderasInformacionBrindadaPuedesIntegrarDiaADiaid')
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
                $this->ConsiderasInformacionBrindadaPuedesIntegrarDiaADia = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askMensajeDespedida();


            }
        }, ['ConsiderasInformacionBrindadaPuedesIntegrarDiaADiaid']);
    }


    public function askCompartemeTusSugerenciasPropuestas()
    {

        $question = Question::create('Compárteme tus sugerencias o propuestas')
            ->fallback('Edad no valida')
            ->callbackId('askCompartemeTusSugerenciasPropuestasid');

        $this->ask($question, function (Answer $answer) {

            if (!($answer->getText())) {
                $this->say("Al parecer no  escribiste nada puedes compartir tus sugerencias o propuestas");
                $this->repeat();
            } else {
                $this->CompartemeTusSugerenciasPropuestas = $answer->getText();
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askMensajeDespedida();
            }


        }, ['askCompartemeTusSugerenciasPropuestasid']);
    }


    public function askMensajeDespedida(): void
    {
        $this->say("Muchas gracias por compartirnos tus opiniones, recuerda que aquí estaré cuando lo necesites.");
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->say('Si deseas saber más sobre la organización nacional de la que formo parte te dejo aquí el link de nuestro sitio web donde podrás encontrar todo lo que hacemos y cada uno de los servicios que brindamos, los cuales son totalmente gratuitos.
                </br>
                     </br>
                <a  style="color:purple"  href="https://rednacionalderefugios.org.mx/">https://rednacionalderefugios.org.mx/</a>
                </br>
                </br>
                Te invito a seguir a la Red Nacional de Refugios en todas nuestras redes sociales.
                </br>
                
                <div class="social-bar">
                    <a href="https://rednacionalderefugios.org.mx/" class="icon facebook" target="_blank"><span class="fa fa-facebook-f"></span></a>
                    <a href="https://twitter.com/RNRoficial" class="icon twitter" target="_blank"><span class="fa fa-twitter"></span></a>
                    <a href="https://www.youtube.com/channel/UCIqcnApw7a7UpmTToVViGZQ/videos" class="icon youtube" target="_blank"><span class="fa fa-youtube"></span></a>
                    <a href="https://www.instagram.com/redrefugiosmx/" class="icon instagram" target="_blank"><span class="fa fa-instagram"></span></a>
                </div>
                
        ');




    }

}
