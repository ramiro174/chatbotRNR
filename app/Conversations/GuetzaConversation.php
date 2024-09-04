<?php

namespace App\Conversations;

use App\Models\Instituciones_Organizaciones;
use App\Models\Programas_Sociales_Tramites;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class GuetzaConversation extends Conversation
{
    protected string $nombre;
    protected string $email;
    protected int $edad=0;
    protected string $estado_republica='';
    protected string $SiEstasAcompanadoMujerEllaTuEncuentranRiesgo;

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
    //patrimonial
    protected string $HasExperimentadoPresionFirmarContraVoluntad;
    protected string $AlguienDestruidoIntencionalmenteBienesMateriales;
    protected string $TeHanImpedidoTrabajarOEstudiarLimitar;
    protected string $AlgunaPersonaCercanaUtilizadoBienesSinConsentimiento;
//
    //economica
    protected string $HasExperimentadoPresionAsumirDeudasCompromisos;
    protected string $AlguienCercanoATiControlaTusIngresos;
    protected string $TeHanNegadoRecursosEconomicos;
    protected string $TeHanImpedidoTrabajarOEstudiarLimitarFinanciera;
// vicaria
    protected string $TeSientesPresionadaActuarPerderContactoHijos;
    protected string $TuParejaExparejaImpedidoComuniquesHijasHijos;
    protected string $HasNotadoTuParejaUtilizaHijasHijos;
    protected string $TeSientesExcluidaDecisionesImportantesHijasHijos;
//
    protected string $TeGustariaResponderAlgunasPreguntasViolenciaDigital;
    protected string $HasRecibidoAmenazasATravezMensajesRedesCorreo;
    protected string $AlguienHaDifundidoInformacionFalsaLinea;
    protected string $HasExperimentadoRoboIdentidadLineaSuplantacion;
    protected string $TeHanPresionadoEnviarFotosIntimasInformacionPersonal;

//


    protected string $PlanesDeAccionProteccionSituacionViolencia;
    //sexual
    protected string $EnEventoViolenciaSexualHuboExposicionRiesgo;
    protected string $SucedioInmediato;
    protected string $TengoMasInformacionSepasHAcerDespuesEvento;
    //fisica
    protected string $AquiTemuestroPlanesAccionFisica;
    protected string $SiyaIdentificasteSituacionPeligro;
    protected string $TeMuestroMasAccionesViolenciaFisica;


    protected string $DebesSaberTienesDerechoSobreDerechoSexuales;
    protected string $TiposdeAborto;
    protected string $MasInformacionAbortoDilatacion;
    protected string $ServiciosInterrupcionEmbarazo;


//Orientación psicológica
    protected string $TePuedoAcompanarAlgunasPreguntasIdentificarProcesoPsicoterapeutico;
    //Empoderamiento
    protected string $SientesFaltaConfianzaMisma;
    protected string $TecuestaExpresarOpinionesDeseos;
    protected string $ParaTomarDecisionesSiempreBuscasOpinion;
    protected string $TeEsFacilIdentificarProblematicas;
    protected string $HasIdentificadoAcompananFrecuentemente;

    //Autocuidado
    protected string $RealizasActividadesActivarMente;
    protected string $PonesLimitesSabesDecirNo;
    protected string $ExpresasEnfadoTristeza;
    protected string $PermitesDisfrutarSalirAmistades;
    protected string $HacesPequenasDescansosDia;

    //En tus Relaciones
    protected string $HasIdentificadoTienenControlTi;
    protected string $TefaltaApoyoEmocinalNecesario;
    protected string $EscuchasCriticasConstantes;
    protected string $HasIdentificoUtilizadoTacticasManipuladoras;
    protected string $HasIdentificoAlgunasRelacionesAnsiedad;

    //Igualdad de oportunidades y el reconocimiento del valor individual
    protected string $LasTareasFinanzasResponsabilidadesEstanDistribuidas;
    protected string $TusOpinionesDeseosNecesidadesTomadoCuenta;
    protected string $SeAplicanDifereneEstandaresComportamiento;
    protected string $NoPuedoExpresarmeFormaLibre;


// Me comuniqué con anterioridad y necesito atención.
    protected string $AnteriormenteTeBrindeInformacionRequerias;
    protected string $CompartemeSugerenciasPropuestas;
    protected string $HeSeleccionadAlgunasAtencionesPuedesRecibirAtravesOrganizaciones;
    protected string $SiTeInteresaConocerSobreProgramasSocialesTramitesConsultasUtilidad;
    protected string $Programa;
    protected string $Tramite;

    //Información adicional
    protected string $AlgunasOpcionesPonerDenunciaPorViolencia;
    protected string $QuieresSaberQueConsiste;
    protected string $LaViolenciaPresentaDiferentesAmbitos;
    protected string $TanProntoComoSeaSeguroHacerlo;
    protected string $AlgunasOpcionesInformacionAdicional;

    protected string $AlgunaOpcionesOrientacionJuridica;
    protected string $QuieresSaberSolicitarOrdenProteccion;


    //Test
    protected int $ResultadoTest=0;
    protected string $CuandoDirigeTeLlamaApodoDesagrdeTest;
    protected string $TeDiceQueEstasConAlguienMasTest;
    protected string $TeHaInterrumpidoEnSituacionesLaboralesTest;
    protected string $TeDicenTieneOtrasParejasTest;
    protected string $TodoTiempoQuiereSaberDondeEstasTest;
    protected string $TeCriticaBurlaCUerpoErroresTest;
    protected string $TeHaPedidoCambiesFormaVestirTest;
    protected string $CuandoEstasConEsaPersonaTensionTest;
    protected string $HaRevisadoCelularLlamadasMensajesTest;
    protected string $ParaDecidirLoHaranCuandoSalenTest;
    protected string $HaInterferidoRelacionesConversacionesInternetTest;
    protected string $CuandoHablanTesientesMalHablaSexoTest;
    protected string $HaHechoUsoDineroTusAhorrosTest;
    protected string $SientesConstantementeEstaControlandoTest;
    protected string $TeHaLimitadoControladoGastosCubrirTest;
    protected string $HasEscondidoDestruidoTusDocumentosTest;
    protected string $SiHasCedidoDeseosSexualesTest;
    protected string $SiTienenRelacionesSexualesTeImpideUsoMetodoAntiTest;
    protected string $TeHaObligadoVerPornografiaTest;
    protected string $HaDifundidoInformacionImagenesEnviadoTest;
    protected string $TeHaPrecionadoObligadoConsumirDrogaTest;
    protected string $SiTomaAlcoholConsumeAlgunTipoDrogaTest;
    protected string $TienesRendirleCuentasTodoTest;
    protected string $ACausaProblemasTienesPerdidaApetitoTest;
    protected string $CuandoSeEnojaDiscutenTest;
    protected string $TeHaGolpeadoAlgunaParteCuerpoTest;
    protected string $TeHaObligadoPresionadoEnviarImagenesIntimasTest;
    protected string $TehaCausadoLesionesAmeritenRecibirAtencionMedicaTest;
    protected string $TeHaAmenazadoConMatarteCuandoQuieresTerminarTest;
    protected string $TeHaExigidoDemuestresDondeEstaTuGeoTest;
    protected string $DespuesDisculpasMuestraCArinoAtencionTest;
    protected string $SeHaEnfadadoPorNoTenerUnaRespuestaInmediantaTest;





        //Amor Propio
    protected string $PuedesIrMedicoSolaAunqueSeaEnfermaGrave;
    protected string $CreesNoTienesMuchoSentirteOrgullosa;
    protected string $SiTienesPasarFinSemanaSola;
    protected string $GeneralmenteDasMasValorOpinaTuPareja;
    protected string $CuandoTienesTomarDecisionImportanteNoHacerlo;

    //Derechos sexuales y reproductivos
    protected string $DerechosSexualesReproductivos;
    protected string $PlacerSexual;

    //terminar
    protected string $AntesQueTeVayasMeGustariaConversacionResultoUtil;
    protected string $CompartemeTusSugerenciasPropuestas;
    protected string $RecomendariasGuetzaPersonasConoces;
    protected string $ConsiderasInformacionBrindadaPuedesIntegrarDiaADia;

    protected int $tiempoRespuesta = 2;

    public static function ListarOrganizaciones(Collection $listaInsOrg): string
    {

        $lista = $listaInsOrg->map(function ($ins) {
            $servicio= trim($ins->Caracteristica)==''?'': "<b style= 'color:purple;font-size:12px'> Servicio: </b>" . $ins->Caracteristica ;
            $telefono= trim($ins->Telefono)==''?'':"<b style= 'color:purple;font-size:12px'> Telefono: </b>" . $ins->Telefono;
            $correo= trim($ins->Email)==''?'':"<b style= 'color:purple;font-size:12px'> Correo: </b> " . $ins->Email;
            $PagWeb= trim($ins->Pagina_web)==''?'':"<b style= 'color:purple;font-size:12px'> Pagina Web:</b>  <a   href=\"$ins->Pagina_web\">" .  $ins->Pagina_web ."</a>";
            $Facebook= trim($ins->Facebook)==''?'':"<b style= 'color:purple;font-size:12px'> Facebook:</b>  <a    href=\"$ins->Facebook\">" . $ins->Facebook ."</a>"  ;
            $Instagram= trim($ins->Instagram)==''?'':"<b style= 'color:purple;font-size:12px'> Instagram</b>  <a    href=\"$ins->Instagram\">" . $ins->Instagram ."</a>" ;
            $twiter= trim($ins->Twitter)==''?'': "<b style= 'color:purple;font-size:12px'> Twitter:</b> <a    href=\"$ins->Twitter\">" . $ins->Twitter."</a>";

          return "<b style='font-size:14px'>".  $ins->Institucion_Organizacion."</b>" .
                ", " .
                $ins->Estado .
                ", " .
                $ins->Municipio ."</br>" .

                "Dias de Atencion: " .
                $ins->Dias_de_atencion .
                ", Horario: " .
                $ins->Horario .
                $servicio.
                $telefono.
                "</br>".
                $correo.
                $PagWeb.
                $Facebook.
                $Instagram.
                $twiter
                ;
        });
    return  Arr::join($lista->toArray(),' </br></br>');

    }
    public static function ListarProgramasTramites(Collection $listaInsOrg): string
    {


        $lista = $listaInsOrg->map(function ($ins) {
            return "<b>".  $ins->Nombre."</b>" .
                ", Dirigido a: " . $ins->Dirigida_A ."</br>" .
                "Link:  <a  style='color:purple' href=\"$ins->Link\">".$ins->Nombre."</a>";

        });
    return  Arr::join($lista->toArray(),' </br></br>');

    }

    public function run()
    {
       $this->askName();
      // $this->askCuandoDirigeTeLlamaApodoDesagradeTest();

       // $this->askIdentificamosServiciosAtencionMujeresFiltro();
       // $this->askSucedioInmediato();
      // $this->askAquiTengoUnasOpcionesParaTi();
        //$this->askaskTepuedoApoyarConAlgoMas();
    }
    public function askName(): void
    {
        $this->ask('Me gustaría conocer tu nombre o cómo deseas que te llame', function (Answer $answer) {
            // Save result
            $this->nombre = $answer->getText();
            $this->bot->typesAndWaits($this->tiempoRespuesta);
            $this->askGenero();
        });
    }

    public function askGenero(): void
    {
        $question = Question::create($this->nombre . ' un gusto, para poder acompañarte necesito conocerte un poco más por favor selecciona la opción con la qué te identifiques')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('askGeneroid')
            ->addButtons([
                Button::create('Mujer')->value('Mujer'),
                Button::create('Hombre')->value('Hombre'),
                Button::create('Otra identidad de genero')->value('Otra identidad de genero'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'

            $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
            if (!in_array($selectedValue, ['Mujer', 'Hombre', 'Otra identidad de genero'])) {
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
            if(in_array($this->genero, ['Hombre','Otra identidad de genero'])) {
                $this->askSiEstasAcompanadoMujerEllaTuEncuentranRiesgo();

            }else{
                $this->askOrientacionNecesitas();
            }



        });
    }
    public function askSiEstasAcompanadoMujerEllaTuEncuentranRiesgo(): void
    {
        $question = Question::create($this->nombre . ' Si estas acompañando a una mujer y ella o tú se encuentran en riesgo, tengo opciones de líneas de emergencia en tu localidad o a nivel federal.')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('SiEstasAcompanadoMujerEllaTuEncuentranRiesgoid')
            ->addButtons([
                Button::create('Emergencia')->value('Emergencia'),
                Button::create('Necesito apoyo')->value('Necesito apoyo'),
                Button::create('Información adicional')->value('Información adicional'),
                Button::create('Anterior')->value('Anterior'),
                Button::create('Terminar')->value('Terminar'),

            ]);


        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Emergencia', 'Necesito apoyo', 'Información adicional', 'Anterior', 'Terminar'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->SiEstasAcompanadoMujerEllaTuEncuentranRiesgo = $selectedValue;
                $this->say('<div class="response-right">'.   $selectedValue.'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='Emergencia') {
               $this->askLineasEmergenciaFiltro();
                }
                else if($selectedValue=='Necesito apoyo'){
                $this->askLineasApoyoOtrasIdentidadesFiltro();
                }
                else if($selectedValue=='Información adicional'){
          ///estaba aqui
                    $this->askAlgunasOpcionesInformacionAdicional();
                }
                else if($selectedValue=='Anterior'){
                    $this->askQuieresSaberSituacionRiesgo();
                }
                else if($selectedValue=='Terminar'){
                 $this->askAntesQueTeVayasMeGustariaConversacionResultoUtil();
                }



//


            }
        }, ['SiEstasAcompanadoMujerEllaTuEncuentranRiesgoid']);
    }
    public function askLineasEmergenciaFiltro(): void
    {
        $estado= $this->estado_republica?:"";
        $instituciones=  self::ListarOrganizaciones(Instituciones_Organizaciones::estadoRepublica($estado)->ClasificacionEmergencia()->get());
        $this->say("<b>Líneas de emergencia</b>   </br></br>".   $instituciones);
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askTepuedoApoyarConAlgoMas();

    }
    public function askLineasApoyoOtrasIdentidadesFiltro(): void
    {
        $estado= $this->estado_republica?:"";
        $this->say('Muchas gracias por contactarnos, te compartimos que como organización, es fundamental que nos especialicemos, nosotras trabajamos con mujeres, niñas y niños en situación de violencia.
        </br>
        Te proporcionare números cercanos a tu localidad donde puedas recibir atención especializada.');

        $genero=  $this->genero;
        $instituciones=  self::ListarOrganizaciones(Instituciones_Organizaciones::estadoRepublica($estado)
            ->ClasificacionNo([
                "Emergencia",
                "Atención especializada (Referencia a Refugio y Orientación ante situaciones de violencia por ejemplo CEAR)"
            ])
            ->Identidad($genero)
            ->get()
        );
        $this->say("<b>Líneas de Apoyo</b></br></br>".   $instituciones);
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askAntesQueTeVayasMeGustariaConversacionResultoUtil();

    }


    public function askOrientacionNecesitas(): void
    {
        $question = Question::create($this->nombre . ' ¿la orientación que necesitas es para ti o para alguna mujer que conoces?')
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
        $question = Question::create('¿Quieres saber que hacer ante una situación de violencia?')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('askQuieresSaberSituacionRiesgo__id')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No'),
                Button::create('Anterior')->value('Anterior'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No','Anterior'])) {
                $this->say("Haz click en un opción valida");
                $this->repeat();
            } else {
                $this->say('<div class="response-right">'.   $selectedValue.'</div>');
                $this->QuieresSaberSituacionRiesgo = $selectedValue;
                if ($selectedValue == 'Si') {
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    if($this->edad<=17){
                        $this->say( $this->nombre.' me interesa mucho tu seguridad y bienestar. Por eso, sugiero puedas buscar compañía de una persona adulta de confianza. Hay ocasiones en las que es importante tener a alguien mayor que pueda apoyarte si lo necesitas.');
                    }
                    $this->askSeleccionaUnaOpcionSaberSituacionViolencia();

                } elseif($selectedValue=='No') {
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    if($this->edad<=17){
                    $this->say( $this->nombre.' me interesa mucho tu seguridad y bienestar. Por eso, sugiero puedas buscar compañía de una persona adulta de confianza. Hay ocasiones en las que es importante tener a alguien mayor que pueda apoyarte si lo necesitas.');
                    }
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askAquiTengoUnasOpcionesParaTi();


                }else{
                    $this->askOrientacionNecesitas();
                }
            }
        }, ['askQuieresSaberSituacionRiesgo__id']);
    }

    public function askSeleccionaUnaOpcionSaberSituacionViolencia(): void
    {
        $question = Question::create('Selecciona una opción para saber que hacer ante situaciones de violencia')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('QuieresSabernecesitarServicioEmergenciaid')
            ->addButtons([
                Button::create('En caso de agresión')->value('En caso de agresión'),
                Button::create('Si vivo o convivo con una persona agresiva')->value('Si vivo o convivo con una persona agresiva'),
                Button::create('Cómo preparar un plan de seguridad')->value('Cómo preparar un plan de seguridad'),
                Button::create('Que debo considerar si vivo en una zona rural')->value('Que debo considerar si vivo en una zona rural'),
                Button::create('¿Quieres conocer las instancias cercanas a ti donde puedes pedir ayuda?')->value('¿Quieres conocer las instancias cercanas a ti donde puedes pedir ayuda?'),
                Button::create('Anterior')->value('Anterior'),

            ]);

        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['En caso de agresión', 'Si vivo o convivo con una persona agresiva', 'Cómo preparar un plan de seguridad', 'Que debo considerar si vivo en una zona rural', '¿Quieres conocer las instancias cercanas a ti donde puedes pedir ayuda?', 'Anterior'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->say('<div class="response-right">'.   $selectedValue.'</div>');
                $this->QuieresSabernecesitarServicioEmergencia = $selectedValue;
                if ($selectedValue == 'En caso de agresión') {
                    $this->bot->typesAndWaits(2);
                    $this->say('Si tienes lesiones, acude rápidamente a un Servicio de Urgencias. Procura ir acompañada de una persona de tu confianza. Si sientes peligro o amenaza, llama al 911.');
                        $this->askQuieroExplorarMas();
                } elseif($selectedValue=='Si vivo o convivo con una persona agresiva') {
                    $this->bot->typesAndWaits(3);
                    $this->say('Si estás en un lugar público y necesitas ayuda, una estrategia efectiva es gritar "¡fuego!". La gente suele reaccionar más rápido a este tipo de alarma. Además, es recomendable tener un teléfono guardado con pila en un lugar conocido solo por ti para emergencias. Es importante que te aprendas los números a los que llamar si necesitas ayuda, asegúrate de saber dónde está el teléfono público más cercano, por si tienes que salir rápido de casa sin tu celular.');
                    $this->bot->typesAndWaits(3);
                    $this->say('Informa a tus amistades o vecinas/os de confianza sobre lo que está pasando en tu casa, trabajo o escuela. Es buena idea tener un plan con ellos para que sepan cómo ayudarte en caso de emergencia, como llamar a la policía o cómo llegar a la puerta de tu casa, aula, o tu lugar de trabajo. Puedes crear una señal con alguien de confianza en el lugar donde ocurre la situación de violencia, como encender y apagar luces o colgar algo en la puerta o ventana para indicar que necesitas ayuda. Prepara una mochila con tus medicamentos, dos mudas de ropa, dinero en efectivo si es posible, con pila extra para tu celular y objetos de primera necesidad.');
                    $this->bot->typesAndWaits(3);
                    $this->say('Envía copias escaneadas de tus documentos importantes a tu correo, y si tienes hija/os, también de sus documentos como actas de nacimiento, identificaciones, pasaportes, documentos migratorios y seguro social,  etc. Si no tienes correo electrónico, te recomiendo abrir uno y mantener la contraseña privada. Elimina mensajes en WhatsApp o mensajes de texto si el agresor tiene acceso a tu teléfono o redes sociales. Si puedes, llama de vez en cuando a la línea de la Red Nacional de Refugios para hablar sobre tus opciones y charlar con alguien que entienda tu situación, incluso si no estás lista para irte.');
                    $this->askQuieroExplorarMas();
                } elseif($selectedValue=='Cómo preparar un plan de seguridad') {
                    $this->bot->typesAndWaits(2);
                    $this->askPlanesDeAccionProteccionSituacionViolencia();
                }
                elseif($selectedValue=='Que debo considerar si vivo en una zona rural') {
                    $this->bot->typesAndWaits(2);
                    $this->say('Vivir en una zona rural puede incrementar el riesgo, sin embargo hay algunas estrategias efectivas como:
                                Buscar en la comunidad alguna persona o líder comunitaria/o con quien puedas acudir, le compartas la situación que vives y sea la primera persona a la que busques si te sientes en riesgo, puede darte refugio o trasportarte a algún lugar seguro.');
                    $this->bot->typesAndWaits(2);
                    $this->say('Si tienes que salir de casa, considera también salir de la comunidad aun cuando tengas una orden de protección, identifica ubicaciones seguras incluso aunque sean alejadas pero accesibles, es decir, tener rutas alternativas para salir.');
                    $this->bot->typesAndWaits(2);
                    $this->say('Identifica los lugares cercanos donde te pueden apoyar, así como números de emergencia, y cuales son los lugares o zonas donde hay recepción para que puedas realizar una llamada, si bien el acceso a internet puede ser complicado, el tener teléfono móvil con saldo es crucial para hacer una llamada de emergencia.');
                    $this->bot->typesAndWaits(2);
                    $this->say('Prepara una mochila con ropa, documentos, dinero si te es posible, medicinas y otros objetos de primera necesidad, ubícala en el lugar donde sea más rápido y cómodo acceder a ella en caso de emergencia. Contactar a cooperativas o grupos de mujeres en el área para unirse a ellos y así obtener apoyo emocional y recursos compartidos. En la medida de lo posible, coordina con vecinas y aliadas cercanas la creación de señales discretas para indicar que necesitas ayuda. Tener una bicicleta como medio de transporte puede también ser de gran ayuda.');
                    $this->askQuieroExplorarMas();
                }
                elseif($selectedValue=='¿Quieres conocer las instancias cercanas a ti donde puedes pedir ayuda?') {
                    $this->bot->typesAndWaits(2);
                    $this->askQuieresSabernecesitarServicioEmergencia();
                }
                elseif($selectedValue=='Anterior') {
                    $this->bot->typesAndWaits(2);
                    $this->askQuieresSaberSituacionRiesgo();
                }

            }
        }, ['QuieresSabernecesitarServicioEmergenciaid']);
    }




    public function askQuieresSabernecesitarServicioEmergencia(): void
    {
        $question = Question::create('Selecciona una opción')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('QuieresSabernecesitarServicioEmergenciaid')
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
                $this->QuieresSabernecesitarServicioEmergencia = $selectedValue;
                if ($selectedValue == 'Si') {
                    $this->bot->typesAndWaits(2);
                   $this->askIdentificamosServiciosAtencionMujeresFiltro();
                } elseif($selectedValue=='No') {
                    $this->bot->typesAndWaits(2);
                    $this->askQuieresSaberCasoHeridaLesion();

                }
                else{
                    $this->bot->typesAndWaits(2);
                    $this->askQuieresSaberSituacionRiesgo();
                }
            }
        }, ['QuieresSabernecesitarServicioEmergenciaid']);
    }
    public function askQuieresSaberCasoHeridaLesion(): void
    {
        $question = Question::create('¿Quieres saber que hacer en caso de alguna herida o lesión?')
            ->fallback('no seleccionate una opción valida')
            ->callbackId('QuieresSaberCasoHeridaLesionid')
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
                $this->QuieresSaberCasoHeridaLesion = $selectedValue;
                if ($selectedValue == 'Si') {
                    $this->say('¿Necesitas contactar con servicios de emergencia, como la policía, los bomberos y los servicios médicos?');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askIdentificamosServiciosAtencionMujeresFiltro();
                } elseif($selectedValue=='No') {
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    if($this->edad<=17){
                        $this->say( $this->nombre.' me interesa mucho tu seguridad y bienestar. Por eso, sugiero puedas buscar compañía de una persona adulta de confianza. Hay ocasiones en las que es importante tener a alguien mayor que pueda apoyarte si lo necesitas.');
                    }
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askAquiTengoUnasOpcionesParaTi();
                }
                else{
                    $this->askQuieresSabernecesitarServicioEmergencia();
                }
            }
        }, ['QuieresSaberCasoHeridaLesionid']);
    }




    public function askIdentificamosServiciosAtencionMujeresFiltro(): void
    {

        $edad= $this->edad?$this->edad:0;
        $estado= $this->estado_republica?$this->estado_republica:"";

        if($this->genero=='Mujer'){

            $instituciones=  self::ListarOrganizaciones(Instituciones_Organizaciones::edadMenorMujer($edad)
                ->ClasificacionEmergencia()
                ->estadoRepublica($estado)
                ->get());
        }else{

            $instituciones=  self::ListarOrganizaciones(Instituciones_Organizaciones::edadMenorHombre($edad)
                ->ClasificacionEmergencia()
                ->estadoRepublica($estado)
                ->get());
        }
        $this->say("Identificamos los siguientes servicios de atención a las mujeres en tu entidad.");
        $this->say($instituciones);
        $this->bot->typesAndWaits($this->tiempoRespuesta);

        if($this->edad<=17){
            $this->say("Gracias por acercarte a nosotras, se que tienes muchas capacidades pero en ocasiones las situaciones pueden ser más complicadas de lo que imaginamos, por ello es importante que identifiques a una persona adulta que pueda apoyarte cuando la situación de violencia se presente, así como tener un plan de seguridad, aquí puedes encontrar algunas acciones que son importantes tomes en cuenta");
            $this->say('<img src="/imageneschatbot/postal4.jpeg" style="width:100%"/>');

        }else{
            $this->say("En muchas ocasiones, es necesario salir de  casa ante la violencia  que se vive en ella, si fuera el caso, aquí puedes encontrar algunas  acciones que es importante tomar en cuenta");
            $this->say('<img src="/imageneschatbot/postal4.jpeg" style="width:100%"/>');
        }



        $this->askQuieroExplorarMas();


    }
   ///Principal
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
            Button::create('Acceder a mis derechos sexuales y reproductivos')->value('Acceder a mis derechos sexuales y reproductivos'),
            Button::create('Anterior')->value('Anterior'),
        ]);

        $this->ask($question_AquiTengoUnasOpcionesParaTi, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            $selectedText = $answer->getText();

            if (!in_array($selectedValue, ['Identificar las violencias', 'Planes de acción y protección ante situaciones de violencia','Información sobre derechos sexuales y reproductivos','Orientación psicológica','Me comuniqué con anterioridad y necesito atención','Información adicional','Acceder a mis derechos sexuales y reproductivos','Anterior'])) {
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
                    $this->askTePuedoAcompanarAlgunasPreguntasIdentificarProcesoPsicoterapeutico();
                }
                elseif($selectedValue == 'Me comuniqué con anterioridad y necesito atención') {
                    $this->askAnteriormenteTeBrindeInformacionRequerias();
                }
                elseif($selectedValue == 'Información adicional') {
                    $this->askAlgunasOpcionesInformacionAdicional();
                }
                elseif($selectedValue == 'Acceder a mis derechos sexuales y reproductivos') {

                    $this->askDerechosSexualesReproductivos();
                }
                elseif($selectedValue == 'Anterior') {
                    $this->askQuieresSaberSituacionRiesgo();
                }
            }


        }, ['askAquiTengoUnasOpcionesParaTiid']);



    }
    ///Principal
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
                    $this->say("Aquí te compartimos algunas preguntas a través de las cuales puedes identificar si tu o alguien más que conoces, está o ha estado en situación de violencia psicología, te invitamos a responderlas, recuerda que esta conversación es privada y nadie más conocerá las respuestas");
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
                    $this->say("<b>La violencia sexual digital</b>. Puede darse de varias formas; cualquier acto donde una persona grabe videos o audios, tome fotografías edite o disimule material sexual íntimo de otra persona mediante engaños. Este material también pudo haberse creado de manera consensuada, sin embargo, la exposición, distribución, difusión, exhibición, transmisión, comercialización, oferta, intercambio o compartir a través de cualquier medio virtual sin consentimiento de la mujer, también se considera violencia digital.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                   $this->askTeGustariaResponderAlgunasPreguntasViolenciaDigital();
                }
                elseif($selectedValue == '¿Solo mi pareja puede ejercer violencia?') {
                    $this->say("No, lamentablemente lo puede hacer también algún familiar, amistad, profesor, sacerdote, policía, desconocido, etc.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Pero es importante que sepas que la única persona responsable de esa violencia es quien la ejerce, que tu tienes derecho a vivir libre de cualquier tipo de violencia, y si estás en una relación violenta sea cual sea, tienes el derecho a recibir acompañamiento especializado y gratuito, no debe ser algo que tengas que enfrentar sola, tienes el poder de decidir cómo deseas relacionarte y en la Red Nacional de Refugios podemos acompañarte, puedes pedir una orientación presencial, por teléfono o virtual y juntas buscar opciones.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say("Aquí nuestros números: 55.56.74.96.95 o si estas en el interior de la republica llama al 800.822.44.60 ¡También nos puedes contactar por redes sociales, es muy fácil, solo busca Red Nacional de Refugios e identifica la casita con el mapa de México y escríbenos!");
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
                    $this->askIdentificamosServiciosAtencionMujeresFiltro();
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

                if(in_array('Si',$Respuestaspreguntas)){
                    $this->askPlanesDeAccionProteccionSituacionViolencia();
                }else{
                    $this->say('Hasta ahora en ninguna de nuestras preguntas he identificado violencia, recuerda que la violencia abarca una amplia gama de formas. Te invito a explorar preguntas sobre otros tipos de violencia, y a seguir informándote sobre este tema crucial para promover un entorno seguro y saludable para todas las personas.');
                    $this->askTepuedoApoyarConAlgoMas();

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
        $question_askHasAccedidoRealizarActivadesSexuales = Question::create('¿Has accedido a realizar actividades sexuales por miedo a consecuencias negativas o por amenazas contra tus familiares  o a tu persona?')
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
               $respuestas=[$this->HasExperimentadoPresionFirmarContraVoluntad, $this->AlguienDestruidoIntencionalmenteBienesMateriales, $this->TeHanImpedidoTrabajarOEstudiarLimitar, $this->AlgunaPersonaCercanaUtilizadoBienesSinConsentimiento];
               if(in_array('Si', $respuestas)){
                   $this->asklineasAtencioLegalOrintacionFiltro();
                   $this->askTepuedoApoyarConAlgoMas();
               }
               else{
                   $this->say('Hasta ahora en ninguna de nuestras preguntas he identificado violencia, recuerda que la violencia abarca una amplia gama de formas. Te invito a explorar preguntas sobre otros tipos de violencia, y a seguir informándote sobre este tema crucial para promover un entorno seguro y saludable para todas las personas.');
                   $this->askTepuedoApoyarConAlgoMas();
               }




            }
        }, ['askAlgunaPersonaCercanaUtilizadoBienesSinConsentimientoid']);
    }
    public function asklineasAtencioLegalOrintacionFiltro(){
        $estado=$this->estado_republica;
        $Programas=  self::ListarOrganizaciones(
            Instituciones_Organizaciones::estadoRepublica($estado)
                ->Identidad("Mujer")
                ->Legal()
                ->get()
        );
        $this->say("<b>Líneas de Atención Legal</b></br></br>".   $Programas);
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askTePuedoAcompanarAlgunasPreguntasIdentificarProcesoPsicoterapeutico();


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
                $respuestas=[$this->HasExperimentadoPresionAsumirDeudasCompromisos, $this->AlguienCercanoATiControlaTusIngresos, $this->TeHanNegadoRecursosEconomicos, $this->TeHanImpedidoTrabajarOEstudiarLimitarFinanciera];
                if(in_array('Si', $respuestas)){
                    $this->asklineasAtencioLegalOrintacionFiltro();
                    $this->askTepuedoApoyarConAlgoMas();
                }
                else{
                    $this->say('Hasta ahora en ninguna de nuestras preguntas he identificado violencia, recuerda que la violencia abarca una amplia gama de formas. Te invito a explorar preguntas sobre otros tipos de violencia, y a seguir informándote sobre este tema crucial para promover un entorno seguro y saludable para todas las personas.');
                    $this->askTepuedoApoyarConAlgoMas();
                }



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
                $respuestas=[$this->TeSientesPresionadaActuarPerderContactoHijos, $this->TuParejaExparejaImpedidoComuniquesHijasHijos, $this->HasNotadoTuParejaUtilizaHijasHijos, $this->TeSientesExcluidaDecisionesImportantesHijasHijos];
                if(in_array('Si', $respuestas)){
                    $this->asklineasAtencioLegalOrintacionFiltro();
                    $this->askTepuedoApoyarConAlgoMas();
                }
                else{
                    $this->say('Hasta ahora en ninguna de nuestras preguntas he identificado violencia, recuerda que la violencia abarca una amplia gama de formas. Te invito a explorar preguntas sobre otros tipos de violencia, y a seguir informándote sobre este tema crucial para promover un entorno seguro y saludable para todas las personas.');
                    $this->askTepuedoApoyarConAlgoMas();
                }




            }
        }, ['TeSientesExcluidaDecisionesImportantesHijasHijosid']);
    }

    //Digital
    public function askTeGustariaResponderAlgunasPreguntasViolenciaDigital(): void
    {
        $question = Question::create('¿Te gustaría responder algunas preguntas que te permitan identificar si estas o has estado en situación de violencia digital? Si/No')
            ->fallback('Edad no valida')
            ->callbackId('askTeGustariaResponderAlgunasPreguntasViolenciaDigitalid')
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

                $this->TeGustariaResponderAlgunasPreguntasViolenciaDigital = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
               if($selectedValue=='Si'){
                   $this->askHasRecibidoAmenazasATravezMensajesRedesCorreo();
               }else{
                  $this->askatencionesDigitalesFiltro();
               }

            }
        }, ['askTeGustariaResponderAlgunasPreguntasViolenciaDigitalid']);
    }
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

                $respuestaDigital=[$this->HasRecibidoAmenazasATravezMensajesRedesCorreo,
                $this->AlguienHaDifundidoInformacionFalsaLinea,
                $this->HasExperimentadoRoboIdentidadLineaSuplantacion,
                $this->TeHanPresionadoEnviarFotosIntimasInformacionPersonal];

                if(in_array('Si',$respuestaDigital)){
                    $this->askatencionesDigitalesFiltro();
                }else{
                    $this->say("Hasta ahora en ninguna de nuestras preguntas he identificado violencia, recuerda que la violencia abarca una amplia gama de formas. Te invito a explorar preguntas sobre otros tipos de violencia, y a seguir informándote sobre este tema crucial para promover un entorno seguro y saludable para todas las personas.");
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTepuedoApoyarConAlgoMas();
                }



            }
        }, ['askTeHanPresionadoEnviarFotosIntimasInformacionPersonalid']);
    }
    public function askatencionesDigitalesFiltro(): void
    {
        $estado= $this->estado_republica?:"";
        $instituciones=  self::ListarOrganizaciones(
            Instituciones_Organizaciones::estadoRepublica($estado)
                ->Identidad("Mujer")
                ->Digital()
                ->get()
           );
        $this->say("<b>Líneas de atención especializada</b></br></br>".   $instituciones);
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askTepuedoApoyarConAlgoMas();


    }

    //Planes de acción y protección ante situaciones de violencia
    public function askPlanesDeAccionProteccionSituacionViolencia(): void
    {
        $question_askPlanesDeAccionProteccionSituacionViolencia = Question::create('Los planes de acción son una manera de disminuir el riesgo que existe dentro de una relación violenta. Estos deben reestructurarse las veces que sean necesarios de acuerdo a las nuevas circunstancias de la relación, de tal forma que se incorporen nuevas acciones estratégicas')
            ->fallback('Edad no valida')
            ->callbackId('askPlanesDeAccionProteccionSituacionViolenciaid')
            ->addButtons([
                Button::create('Sexual')->value('Sexual'),
                Button::create('Física')->value('Física'),
                Button::create('Psicológica')->value('Psicológica'),
                Button::create('Si te preguntas ¿Qué puedo hacer si vivo con una persona violenta?')->value('Si te preguntas ¿Qué puedo hacer si vivo con una persona violenta?'),
                Button::create('Anterior')->value('Anterior'),
            ]);

        $this->ask($question_askPlanesDeAccionProteccionSituacionViolencia, function (Answer $answer) {
            $selectedValue = $answer->getValue();

            $this->PlanesDeAccionProteccionSituacionViolencia = $selectedValue;
            $this->say('<div class="response-right">'.  $answer->getText().'</div>');
            $this->bot->typesAndWaits($this->tiempoRespuesta);


            if (!in_array($selectedValue, ['Sexual', 'Física','Psicológica','Anterior','Si te preguntas ¿Qué puedo hacer si vivo con una persona violenta?'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } elseif($selectedValue=='Sexual') {
                $this->askEnEventoViolenciaSexualHuboExposicionRiesgo();
            } elseif($selectedValue=='Física'){
                $this->askAquiTemuestroPlanesAccionFisica();
            } elseif($selectedValue=='Psicológica'){
                $this->say('Tus contactos pueden llamarte, acudir a tu casa o al lugar donde te encuentres para cerciorarse de que estés bien, así como frenar la situación de violencia y en el momento oportuno, poder salir del lugar con cualquier excusa, evitando que la situación de peligro se agrave.');
                $this->askTepuedoApoyarConAlgoMas();

            } elseif($selectedValue=='Si te preguntas ¿Qué puedo hacer si vivo con una persona violenta?'){
                $this->say('Comentarlo con alguna persona de tu absoluta confianza, acudir a alguna Institución especializada para recibir atención, implementar un plan de seguridad para disminuir cualquier situación de riesgo. Dejar una relación es una estrategia de seguridad común e importante, y permite que estemos más seguras. Sin embargo, irse no es una opción para todas, entendemos el miedo y lo que implica, por ello te recuerdo que en la Red Nacional de Refugios estamos para acompañarte.');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->say('Es muy importante saber que el plan de seguridad es personal, si bien, hay estrategias generales que puedes seguir, cada caso es diferente, por lo que si sientes que estas en una relación violenta, es necesario que una profesional te acompañe a realizar tu propio plan.  Contáctanos: 55.56.74.96.95 y 800.822.44.60 también por redes sociales  puedes contactarnos, es muy fácil solo busca “Red Nacional de Refugios” e identifica la casita con el mapa de México. ¡Nosotras te acompañamos!');
                $this->askTepuedoApoyarConAlgoMas();

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
                Button::create('Salir')->value('Salir'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No','Salir'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->EnEventoViolenciaSexualHuboExposicionRiesgo = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='Si'){
                        $this->askSucedioInmediato();
                }
                elseif($selectedValue=='Salir'){
                    $this->askTepuedoApoyarConAlgoMas();
                }
                else{
                    $this->askDerechosSexualesReproductivos();
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
                Button::create('Salir')->value('Salir'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si', 'No','Salir'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            }
            else {
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
                }
                elseif($selectedValue=='Salir'){
                    $this->askTepuedoApoyarConAlgoMas();
                }
                else{

                    $this->askPlanesDeAccionProteccionSituacionViolencia();
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
                Button::create("Salir")->value('Salir'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Aqui tengo algunos numeros de servicios de atencion en tu entidad', 'Anticoncepción de emergencia','Salir'])) {
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
                elseif($selectedValue=='Salir'){
                    $this->askTepuedoApoyarConAlgoMas();
                }


            }
        }, ['askTengoMasInformacionSepasHAcerDespuesEventoid']);
    }
    public function askLineasAtencionEspecializadaDerechosSexualesFiltro(): void
    {
        $estado= $this->estado_republica?:"";
        $instituciones=  self::ListarOrganizaciones(
            Instituciones_Organizaciones::estadoRepublica($estado)
                ->Clasificaciones([
                    "Acceso a derechos sexuales (Interrupción del embarazo, denuncias)"
                ])
                ->Identidad("Mujer")
                ->get()
            );
        $this->say("<b>Líneas de atención especializada en derechos sexuales y reproductivos</b>   </br></br>".   $instituciones);
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
    $this->askTepuedoApoyarConAlgoMas();

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
                Button::create("Anterior")->value('Anterior'),

            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, [
                'Anterior',
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
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTepuedoApoyarConAlgoMas();

            }elseif($selectedValue == 'Para protegerte fuera de la casa, escuela o lugar de trabajo, considera los siguientes puntos'){
                $this->say('Cambia regularmente las rutas de tu trayecto. Haz compras en lugares diferentes. Mantén los números telefónicos de emergencia contigo todo el tiempo. Comparte tu ubicación con los contactos que elegiste en la APP de Sendero Violeta, ¡descargala! o con cualquier otra persona de tu confianza. Evita utilizar tu celular si vas caminando o manejando. Antes de salir o entrar a algún lugar mira a tu alrededor y observa si no está la persona agresora o hay algo extraño en el entorno.');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTepuedoApoyarConAlgoMas();


            }elseif($selectedValue == 'Lo que puedes hacer si llegan a discutir y la situación se pone peligrosa'){
                $this->say('Haz lo posible por moverte hacia un lugar cerca de la puerta o por donde puedas salir sin peligro
                            No entres a los baños o la cocina (a menos que allí haya una salida). Aléjate de lugares donde haya objetos pesados o con los que pueden lastimarte (esculturas, cuchillos, tijeras, etc.). 
                            Ve a alguna habitación donde haya un teléfono (llama al 911 o alguna red de apoyo) o una ventana grande donde puedas salir sin lastimarte. 
                            Recuerda que tú eres la única persona que puede decidir cuál es el mejor momento para dejar la casa. Sin ponerte en mayor peligro, espera la oportunidad hasta que puedas salir. 
                            Si la situación se vuelve peligrosa y te das cuenta de que no hay cómo salir inmediatamente, hazle caso a la persona agresora en ese momento, hasta que se tranquilice. Debes protegerte hasta que esté fuera de peligro.
                            Si te han golpeado, busca ayuda médica y en la medida de lo posible, trata de tomarte fotos de las heridas, es importante para tener evidencias. ');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTepuedoApoyarConAlgoMas();
            }

            elseif($selectedValue == 'Qué hacer si la persona agresora intenta secuestrarme'){
                $this->say('No desestimes tus presentimientos, ni minimices las situaciones de riesgo ¡No estás sola¡ Si han salido y de pronto te das cuenta de que toma una dirección distinta, percibes algo extraño, no te dice a donde van o lo que responde no te hace sentir segura puedes compartir tu ubicación con algún contacto o redes de apoyo. También pueden llamarte en ese momento como si te estuviera saludando para que puedas decirle por donde vas. Después de unos 15 min puede volverte a llamar con algún pretexto para que se cerciore de que estas bien. Si no contestas es importante que tus contactos notifiquen a las autoridades correspondientes. ');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTepuedoApoyarConAlgoMas();
            }
            elseif($selectedValue == 'Existen otras estrategias que podemos crear conjuntamente y compartir'){
                $this->say('Te compartimos líneas de Atención especializada (diferenciando psicología feminista (los CEAR) de atención psicológica).');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askatencionesEspecializadasFiltro();
            }
            elseif($selectedValue == 'Si la persona agresora ha dejado la casa'){
                $this->say('Se sugiere cambiar cerraduras nuevas en las puertas, porque recuerda que él todavía puede tener una copia de las llaves.  Ponle seguros a las ventanas por si él intenta abrir o forzarlas. Comparte con alguna vecina o vecino de tu confianza a grandes rasgos tu situación para que te pueda informar si la persona agresora se presenta o lo ven rondando cerca.   Informa a la escuela o al centro de cuidado de tus hijas/os quién tiene permiso para recogerlas/os. Si tienes una orden de protección entrégale una copia al personal de la escuela.  Si no cuentas con una orden de protección puedes tramitarla. Cambia el número de teléfono fijo o celular y no llames a la persona agresora desde ellos. ');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTepuedoApoyarConAlgoMas();
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
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askatencionesEspecializadasFiltro();
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
            elseif($selectedValue == 'Anterior'){
                $this->askPlanesDeAccionProteccionSituacionViolencia();
            }

        }, ['askAquiTemuestroPlanesAccionFisicaid']);
    }
    public function askTeMuestroMasAccionesViolenciaFisica():void
    {
        $question = Question::create('Tengo las siguientes opciones para ti')
            ->fallback('Edad no valida')
            ->callbackId('askTeMuestroMasAccionesViolenciaFisicaid')
            ->addButtons([
                Button::create("Alerta Amber y Protocolo")->value('Alerta Amber y Protocolo'),
                Button::create("Has uso de tu denuncia en la CNDH")->value('Has uso de tu denuncia en la CNDH'),

            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Alerta Amber y Protocolo','Has uso de tu denuncia en la CNDH'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            }
            $this->TeMuestroMasAccionesViolenciaFisica = $selectedValue;
            $this->say('<div class="response-right">' . $answer->getText().'</div>');
            $this->bot->typesAndWaits($this->tiempoRespuesta);

            if($selectedValue == 'Alerta Amber y Protocolo') {
                $this->say('Tienes derecho a solicitar la Alerta Amber, en caso de niñas y adolescentes al 8000085400 y el Protocolo alba en caso de mujeres desaparecidas. (Ambas alertas las puedes solicitar al momento de realizar la denuncia o reporte). También puedes apoyarte de Organizaciones de la Sociedad Civil y difundir en redes sociales la ficha de búsqueda.  <a href="https://www.idheas.org.mx/ ">https://www.idheas.org.mx/ </a>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTepuedoApoyarConAlgoMas();

            }
            if($selectedValue == 'Has uso de tu denuncia en la CNDH') {
                $this->say('<ul><li> 1. También puedes presentarle en línea https://atencionciuadana.com CNDH 55 5681 8125  /   55 5490 7400 </li> <li> 2. Realiza tu reporte La fiscalía Especializada y Comisiones de Búsqueda deben expedir una ficha de búsqueda que contenga: nombre completo; fotografía; descripción física, última fecha y lugar en dónde fue vista; último contacto que se tuvo con ella (precisando el evento) y vestimenta que llevaba puesta el día de su desaparición.  Si así lo deseas, puedes participar de forma activa en la búsqueda y puedes solicitar a las autoridades; los videos de vigilancia; acceso a investigación de perfiles de redes sociales; geolocalización de cualquier dispositivo; comunicación inmediata con hospitales, terminales de autobuses, aeropuertos y otros espacios; documentos de antecedentes de violencias.  </li></ul>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTepuedoApoyarConAlgoMas();

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
                Button::create("Identificamos los siguientes servicios de atención a las mujeres en tu entidad")->value('Identificamos los siguientes servicios de atención a las mujeres en tu entidad'),
                Button::create("Anterior")->value('Anterior')
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Anterior','Prepara con tiempo','Identifica personas conocidas, amigas o familiares que puedan apoyarte','Identificamos los siguientes servicios de atención a las mujeres en tu entidad'])) {
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
                $this->say('Postal Wendy hijos');

                $this->askTepuedoApoyarConAlgoMas();


            }elseif($selectedValue == 'Identifica personas conocidas, amigas o familiares que puedan apoyarte'){
                $this->say('<b>Redes de apoyo:</b> elige personas conocidas, amigas o familiares que puedan apoyarte, y contáctalas para que estén pendientes de la situación y puedan apoyarte, puedes acordar previamente con ellas claves con emojis para que sepan que significa y llamar a la policía de ser necesario. Memoriza o haz una lista con los números de teléfono de tus amistades, familiares, personas del trabajo o de alguna organización o servicio local en donde te puedan ayudar.  Puedes ir a casa de alguna amistad o familiar, preferible a un lugar donde la persona agresora no se atreva a ir a buscarte o a la casa de alguien que él no conozca. Si no cuenta son una red de apoyo puedes comunicarte con nosotras.');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTepuedoApoyarConAlgoMas();


            }elseif($selectedValue == 'Identificamos los siguientes servicios de atención a las mujeres en tu entidad'){
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askatencionesEspecializadasFiltro();
            }
            elseif($selectedValue == 'Anterior'){
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askAquiTemuestroPlanesAccionFisica();



            }


        }, ['askSiyaIdentificasteSituacionPeligroid']);
    }

    public function askatencionesEspecializadasFiltro(): void
    {
        $estado= $this->estado_republica?:"";
        $instituciones=  self::ListarOrganizaciones(
            Instituciones_Organizaciones::estadoRepublica($estado)
                ->Clasificaciones([
                    "Atención especializada (Referencia a Refugio y Orientación ante situaciones de violencia por ejemplo CEAR)"
                ])
                ->Identidad("Mujer")
                ->get());
        $this->say("<b>Líneas de atención especializada</b></br></br>".   $instituciones);
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askTepuedoApoyarConAlgoMas();


    }

    //Información sobre derechos sexuales y reproductivos
    public function askDebesSaberTienesDerechoSobreDerechoSexuales():void
    {
        $question = Question::create('Debes saber que tienes derecho a:')
            ->fallback('Edad no valida')
            ->callbackId('DebesSaberTienesDerechoSobreDerechoSexualesid')
            ->addButtons([
                Button::create("Menstruación digna")->value('Menstruación digna'),
                Button::create("Plenipausia")->value('Plenipausia'),
                Button::create("Acceder a servicios de salud y atención médica")->value('Acceder a servicios de salud y atención médica'),
                Button::create("Métodos Anticonceptivos")->value('Métodos Anticonceptivos'),
                Button::create("Servicios de interrupción del embarazo")->value('Servicios de interrupción del embarazo'),
                Button::create("Tipos de aborto")->value('Tipos de aborto'),
                Button::create("¿Quieres saber más?")->value('¿Quieres saber más?'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Tipos de aborto','¿Quieres saber más?',"Menstruación digna", "Plenipausia", "Acceder a servicios de salud y atención médica", "Métodos Anticonceptivos","Servicios de interrupción del embarazo"])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            }
            $this->DebesSaberTienesDerechoSobreDerechoSexuales = $selectedValue;
            $this->say('<div class="response-right">' . $answer->getText().'</div>');
            $this->bot->typesAndWaits($this->tiempoRespuesta);


            if($selectedValue == 'Menstruación digna') {
                $this->say('Garantizar el acceso y abasto de los insumos contribuye a revertir la desigualdad histórica en la que viven niñas, adolescentes y mujeres. Hablar de la menstruación es un derecho y permite resignificarla y vivirla sin tabúes, además facilita identificar las discriminaciones y desigualdades que impactan en la vida de las mujeres.  Nombrar la menstruación sirve para el reconocimiento de la cuerpa, para saber que la sangre anuncia cambios.');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTecompartimosAPPInformacion();
            }
            elseif($selectedValue == 'Plenipausia') {
                $this->say('Se refiere a la plenitud que la mujer alcanza en la menopausia cuando rompe con los mitos de esta etapa. </br>
                            &#8226; Identifica que las mujeres somos cíclicas.</br>
                            &#8226; Culturalmente se asocia a la pérdida o a lo negativo, pero desde la medicina de la tierra presupone una conexión con la CREATIVIDAD y la SABIDURIA  de la cuerpa. </br>
                            &#8226; Es la oportunidad de dedicarse completamente a una misma');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTecompartimosAPPInformacion();
            }
            elseif($selectedValue == 'Acceder a servicios de salud y atención médica') {
                $this->say('Todas las mujeres tienen derecho a acceder a servicios de salud y atención médica, y quienes decidan ser madres, a tener una maternidad segura y libre de todo riesgo durante el proceso reproductivo, es decir desde la intención reproductiva, la concepción, gestación, parto y puerperio. El gozo y el placer también ¡es un derecho!');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTecompartimosAPPInformacion();
            }
            elseif($selectedValue == 'Métodos Anticonceptivos') {
                $this->say('
                            &#8226; Para prevenir un embarazo, empieza a usar un método anticonceptivo, como alguno de los siguientes: </br>
                            &#8226; Un condón interno femenino o uno externo masculino. </br>
                            &#8226; Un método hormonal, como las pastillas, inyecciones o implantes anticonceptivos. De haber tenido un aborto el mismo día que te hagas el aborto. Evitarás un embarazo si empiezas a usar un método hormonal durante los primeros 7 días después del aborto. Pero si esperas más de 7 días para empezar a usarlo, debes usar un condón durante la primera semana, ya que los métodos hormonales toman tiempo para empezar a funcionar y protegerte. </br> 
                            &#8226; Te pueden colocar un DIU, en caso de aborto tan pronto como confirmen que el aborto fue exitoso y que no hay infección. Usa condones hasta que te coloquen el DIU. </br>
                            &#8226; Existen métodos permanentes para que las personas que tienen la certeza de que nunca más quieren tener otro embarazo. La operación llamada “ligadura de trompas” en la que se cortan los tubos que llevan los óvulos al útero, lo que previene el embarazo. También hay una operación llamada “vasectomía” en la que se cortan los tubos que llevan el esperma desde los testículos al pene.  Esto impide que el esperma salga del pene durante la eyaculación, lo que previene el embarazo. </br> 
                            ');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTecompartimosAPPInformacion();


            }
            elseif($selectedValue=='Servicios de interrupción del embarazo'){
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->say('El aborto en México se despenalizó el 6 de septiembre de 2023 por vía judicial en el Código Penal Federal. Todas las mujeres tienen derecho a acceder a servicios de interrupción del embarazo.
                             Cualquier institución de salud federal incluido IMSS, ISSSTE y PEMEX, deberán darte el servicio de aborto en todo el país si lo solicitas.
                            Asimismo, el personal de salud que realice un aborto consentido no podrá ser criminalizado.
                            ');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askServiciosInterrupcionEmbarazo();
            }
            elseif($selectedValue=='Tipos de aborto'){
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTiposdeAborto();
            }
            elseif($selectedValue=='¿Quieres saber más?'){
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->say('Tus derechos sexuales y reproductivos están vinculados con la seguridad, la libertad, la integridad física, las decisiones sobre sexualidad, la maternidad y el rechazo a toda forma de violencia, discriminación y opresión.');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->say('Los he convertido en frases para que los puedas sentir tuyos, los tengo en grupos de tres en tres.');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                $this->askQuieresSaberMasAborto5();
            }

        }, ['DebesSaberTienesDerechoSobreDerechoSexualesid']);
    }

    public function askQuieresSaberMasAborto(): void
    {
        $question = Question::create('Quieres saber más?')
            ->fallback('Edad no valida')
            ->callbackId('QuieresSaberMasAbortoid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No')
            ]);
        $this->ask($question, function (Answer $answer)  {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si','No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->QuieresSaberMasAborto = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='Si'){

                   $this->askEsmiderechoDecidirFormaLibreInformada();
                }
                else{

                    $this->askTepuedoApoyarConAlgoMas();
                }


            }
        }, ['QuieresSaberMasAbortoid']);
    }
    public function askQuieresSaberMasAborto2(): void
    {
        $question = Question::create('Quieres saber más?')
            ->fallback('Edad no valida')
            ->callbackId('QuieresSaberMasAbortoid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No')
            ]);
        $this->ask($question, function (Answer $answer)  {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si','No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->QuieresSaberMasAborto = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='Si'){

                   $this->askEsmiderechoIdentidadSexual();
                }
                else{

                    $this->askTepuedoApoyarConAlgoMas();
                }


            }
        }, ['QuieresSaberMasAbortoid']);
    }
    public function askQuieresSaberMasAborto3(): void
    {
        $question = Question::create('Quieres saber más?')
            ->fallback('Edad no valida')
            ->callbackId('QuieresSaberMasAbortoid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No')
            ]);
        $this->ask($question, function (Answer $answer)  {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si','No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->QuieresSaberMasAborto = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='Si'){

                   $this->askEsmiderechoConQuienQuines();
                }
                else{

                    $this->askTepuedoApoyarConAlgoMas();
                }


            }
        }, ['QuieresSaberMasAbortoid']);
    }
    public function askQuieresSaberMasAborto4(): void
    {
        $question = Question::create('Quieres saber más?')
            ->fallback('Edad no valida')
            ->callbackId('QuieresSaberMasAbortoid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No')
            ]);
        $this->ask($question, function (Answer $answer)  {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si','No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->QuieresSaberMasAborto = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='Si'){

                   $this->askEsmiderechoRecibirInformacion();
                }
                else{

                    $this->askTepuedoApoyarConAlgoMas();
                }


            }
        }, ['QuieresSaberMasAbortoid']);
    }
    public function askQuieresSaberMasAborto5(): void
    {
        $question = Question::create('Quieres saber más?')
            ->fallback('Edad no valida')
            ->callbackId('QuieresSaberMasAbortoid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No')
            ]);
        $this->ask($question, function (Answer $answer)  {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si','No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->QuieresSaberMasAborto = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='Si'){

                    $this->askEsmiderechoDecidirFormaLibre();
                }
                else{

                    $this->askTepuedoApoyarConAlgoMas();
                }


            }
        }, ['QuieresSaberMasAbortoid']);
    }

    public function askEsmiderechoDecidirFormaLibre(){
        $this->say('<ul>
        <li>. Es mi derecho decidir de forma libre y responsable sobre mi cuerpo y mi sexualidad.</li>
        <li>. Es mi derecho ejercer y disfrutar plenamente mi vida sexual.</li>
        <li>. Es mi derecho manifestar públicamente mis afectos</li>
        </ul>
        ');
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askQuieresSaberMasAborto();
    }
    public function askEsmiderechoDecidirFormaLibreInformada(){
        $this->say('<ul>
        <li>. Es mi derecho decidir de manera libre e informada sobre mi vida reproductiva.</li>
        <li>. Es mi derecho tener igualdad de oportunidades, trato digno y respeto.</li>
        <li>. Es mi derecho vivir libre de toda discriminación.</li>
        </ul>
        ');
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askQuieresSaberMasAborto2();
    }
    public function askEsmiderechoIdentidadSexual(){
        $this->say('<ul>
            <li>. Es mi derecho la identidad sexual y expresión de género.</li>
            <li>. Es mi derecho participar en las políticas públicas sobre sexualidad y reproducción.</li>
            <li>. Es mi derecho gozar de mi sexualidad, sentir placer sexual y vivir mi erotismo.</li>
            </ul>
        ');
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askQuieresSaberMasAborto3();
    }
    public function askEsmiderechoConQuienQuines(){
        $this->say('<ul>
            <li>. Es mi derecho decidir con quien o quienes compartir mi vida y mi sexualidad, así como a vivir de manera libre mi orientación sexual.</li>
            <li>. Es mi derecho el respeto a mi intimidad, mi vida privada y la confidencialidad de mi información.</li>
            <li>. Es mi derecho vivir libre de cualquier tipo de violencias.</li>
            </ul>
        ');
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askQuieresSaberMasAborto4();
    }
    public function askEsmiderechoRecibirInformacion(){
        $this->say('<ul>
          <li>. Es mi derecho recibir información completa, científica y laica sobre sexualidad, métodos de protección y planificación, placer y erotismo.</li>
          <li>. Es mi derecho recibir educación de la sexualidad de manera integral, libre de prejuicios y estereotipos.</li>
          <li>. Es mi derecho recibir servicios de salud sexual y salud reproductiva.</li>
          </ul>
        ');
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askTepuedoApoyarConAlgoMas();
    }

    public function askTiposdeAborto(): void
    {
        $question = Question::create('Selecciona algún tema de tu interés sobre servicios de interrupción del embarazo:')
            ->fallback('Edad no valida')
            ->callbackId('TiposdeAbortoid')
            ->addButtons([
                Button::create('Aborto por aspiración')->value('Aborto por aspiración'),
                Button::create('Aborto por dilatación y evacuación (D y E)')->value('Aborto por dilatación y evacuación (D y E)'),
                Button::create('Señales de alerta y qué debes de hacer')->value('Señales de alerta y qué debes de hacer'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Aborto por aspiración','Aborto por dilatación y evacuación (D y E)','Señales de alerta y qué debes de hacer'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TiposdeAborto = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='Aborto por aspiración'){
                    $this->say('Primeras 17 semanas.
                                El aborto por aspiración es un método de aborto seguro y eficaz en las primeras 17 semanas de embarazo. Una persona capacitada utiliza un equipo de aspiración para remover el tejido y la sangre de la matriz a través de un tubo de plástico flexible llamado cánula.  La succión se crea con una jeringa manual grande (aspiración manual endouterina o AMEU) o una pequeña bomba eléctrica (aspiración eléctrica endouterina AEEU).
                                El aborto por aspiración toma de 5 a 10 minutos. Por lo general,  se lleva a cabo en un consultorio,  clínica o centro de salud.
                                Es un método seguro en las primeras 17 semanas de embarazo siempre y cuando lo realice una persona capacitada y con experiencia que utilice equipo desinfectado y técnica estéril.  En este método,  se inserta un tubo de plástico a través del cuello del útero (cérvix)  para remover el tejido y la sangre del útero con la aspiración.  comparados con los abortos por dilatación y evacuación,  los abortos por aspiración tienen un menor riesgo de infección,  sangrado abundante, hemorragia, lesiones en el útero o cuello del útero.
                                Los abortos por aspiración inseguros,  realizados por personas sin ética o capacitación,  en condiciones de poca limpieza,  son más frecuentes en lugares donde el aborto está criminalizado o prohibido y pueden causar emergencias médicas como infecciones o sangrado abundante.
                                ');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say('Casos en los que no deberías tener un aborto por aspiración. Si tienes un trastorno hemorrágico, estás tomando anticoagulantes,  informa al personal de salud para que puedan planificar el procedimiento de forma adecuada.
                                El aborto por aspiración no sirve para poner fin a un embarazo ectópico (embarazo en las trompas de Falopio).  Las señales de un embarazo ectópico incluyen dolor abdominal y sangrado.
                                Después de realizar el aborto,  el personal médico examina el tejido y la sangre que sacó para asegurarse de que se haya eliminado por completo.  Las náuseas deben desaparecer en un día, las molestias de los pechos pueden durar un poco más. 
                                ');

                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTecompartimosAPPInformacion();
                }
                elseif($selectedValue=='Aborto por dilatación y evacuación (D y E)'){
                    $this->say('Más de 14 semanas
                                La dilatación y evacuación es un método de aborto seguro y eficaz que usa una combinación de aspiración e instrumentos médicos. A menudo se usan medicamentos para ablandar y abrir el cuello uterino antes de realizar el aborto.
                                Este método se puede usar para embarazos de más de 14 semanas. También se usa para tratar un aborto espontáneo y asegurarse de que todos los tejidos y la sangre restante se remuevan por completo del útero.
                                No confundas la dilatación y evacuación con la dilatación y curetaje (legrado). En vez de raspar el interior del útero, la dilatación y evacuación emplea succión guiada e instrumentos médicos para remover los tejidos del útero. Este método duele menos y causa menos infecciones que un legrado.
                                ');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askMasInformacionAbortoDilatacion();
                }
                elseif($selectedValue=='Señales de alerta y qué debes de hacer'){
                    $this->say('
                                Es normal que todos los abortos provoquen sangrado y molestias. Rara vez los abortos provocan sangrado excesivo o dolores demasiado fuertes, pero si esto ocurre pueden tratarse. Consigue ayuda médica si presentas cualquiera de las siguientes señales. Si es posible pide a alguien que te acompañe.
                                Para todo tipo de aborto: </br>
                                <ul>
                                <li>• Sangrado demasiado abundante por la vagina</li>
                                <li>• Que empapa más de dos toallas higiénicas o compresas en una hora durante dos horas seguidas</li>
                                <li>• Que provoca mareos o sensación de que te vas a desmayar</li>
                                <li>• Coágulos más grandes que tu puño</li>
                                <li>• Dolor constante y fuerte en el vientre,  que empeora y que las medicinas para el dolor no quitan</li>
                                <li>• Flujo vaginal con mal olor, de color verde o amarillo</li> 
                                <li>• Fiebre de más de 38 grados</li>
                                <li>• Un goteo lento y constante de sangre de color rojo vivo también es una señal de alerta.  puede ser una lesión interna que esté sangrando</li>
                                </ul>
                   ');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say('<b>¿Qué hacer ante señales de alerta?</b> Busca atención médica de inmediato si tienes cualquiera de  estas señales.  necesitas tomar antibióticos para prevenir infecciones y puede ser necesario que te vacíen el útero mediante aspiración.  Necesitas que alguien te ayude y además esté pendiente de que las señales de choque ( shock)  causadas por pérdida demasiada sangre.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);

                    $this->askTecompartimosAPPInformacion();
                }


            }
        }, ['TiposdeAbortoid']);
    }
    public function askMasInformacionAbortoDilatacion(): void
    {
        $question = Question::create('Mas informacion sobre aborto por dilatacion')
            ->fallback('Edad no valida')
            ->callbackId('MasInformacionAbortoDilatacionid')
            ->addButtons([
                Button::create('¿Cuánto tiempo tarda?')->value('¿Cuánto tiempo tarda?'),
                Button::create('¿Qué tan seguro es un aborto por dilatación y evacuación?')->value('¿Qué tan seguro es un aborto por dilatación y evacuación?'),

            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['¿Cuánto tiempo tarda?','¿Qué tan seguro es un aborto por dilatación y evacuación?'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->MasInformacionAbortoDilatacion = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='¿Cuánto tiempo tarda?'){
                    $this->say('Por lo general agrandar el cuello del útero con medicinas o dilatadores toma unas horas Si está cerca de las 14 semanas de embarazo, y de 1 a 2 días si el embarazo está más avanzado. Una vez que el cuello del útero se ha abierto lo suficiente, el aborto dura aproximadamente 20 minutos o más, dependiendo de cuánto tiempo lleve el embarazo.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTecompartimosAPPInformacion();
                }
                elseif($selectedValue=='¿Qué tan seguro es un aborto por dilatación y evacuación?'){
                    $this->say('Es seguro a partir de las 14 semanas siempre y cuando lo realice una persona capacitada con experiencia y con instrumentos esterilizados (desinfectados). Con este método,  primero se ablanda y dilata el cuello uterino para que el tubo de aspiración y los instrumentos puedan remover el tejido y la sangre del aborto. Para prevenir infecciones,  es sumamente importante que la persona que realice el aborto use equipo esterilizado. En comparación con los abortos con pastillas o por aspiración los abortos por dilatación y evacuación tienen un mayor riesgo de infección,  sangrado abundante y lesiones en el útero o cuello del útero.  Pero estos problemas no son comunes cuando el personal médico tiene experiencia.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTecompartimosAPPInformacion();
                }



            }
        }, ['MasInformacionAbortoDilatacionid']);
    }
    public function askServiciosInterrupcionEmbarazo(): void
    {
        $question = Question::create('Selecciona algún tema de tu interés sobre servicios de interrupción del embarazo:')
            ->fallback('Edad no valida')
            ->callbackId('ServiciosInterrupcionEmbarazoid')
            ->addButtons([
                Button::create('Aborto')->value('Aborto'),
                Button::create('Aborto con pastillas')->value('Aborto con pastillas'),
                Button::create('Acerca de las medicinas para abortar')->value('Acerca de las medicinas para abortar'),
                Button::create('Casos en los que no hay que usar pastillas para abortar')->value('Casos en los que no hay que usar pastillas para abortar'),
                Button::create('Las señales de embarazo desaparecen')->value('Las señales de embarazo desaparecen'),
                Button::create('Conocer tus derechos desde la perspectiva Feminista y de Derechos Humanos')->value('Conocer tus derechos desde la perspectiva Feminista y de Derechos Humanos')

            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Aborto', 'Aborto con pastillas', 'Acerca de las medicinas para abortar', 'Casos en los que no hay que usar pastillas para abortar','Conocer tus derechos desde la perspectiva Feminista y de Derechos Humanos','Las señales de embarazo desaparecen'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->ServiciosInterrupcionEmbarazo = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='Aborto'){
                    $this->say('Para saber cuál método de aborto es mejor para ti, necesitas saber cuántas semanas de embarazo tienes.  Es posible que algunos métodos no estén disponibles donde vives. El aborto con pastillas se puede realizar durante las primeras 25 semanas de embarazo, pero es más eficaz para interrumpir un embarazo antes de las 13 semanas. El aborto por aspiración puede realizarse a más tardar en la semana 17 y el aborto por dilatación y evacuación puede realizarse a partir de las 14 semanas.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTecompartimosAPPInformacion();
                }
                elseif($selectedValue=='Aborto con pastillas'){
                    $this->say('13 a 25 semanas. Cuando un aborto se realiza con medicamentos,  se llama aborto médico o aborto con pastillas. Un aborto con pastillas dura más tiempo y expulsa una mayor cantidad de tejido que los abortos que se realizan antes de estas semanas. El misoprostol es un medicamento común que puede interrumpir el embarazo de forma segura y eficaz, similar a un aborto espontáneo natural.  Puede usarse  solo,  y es aún más efectivo cuando se usa junto con la mifepristona,  una medicina que solo se usa para abortos.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTecompartimosAPPInformacion();
                }
                elseif($selectedValue=='Acerca de las medicinas para abortar'){
                    $this->say('<b>El misoprostol</b> hace que el útero se contraiga con fuerza y expulse el tejido y la sangre del aborto. Este medicamento está disponible en muchos lugares porque también se usa para tratar las úlceras estomacales y el sagrado muy abundante después de dar a luz.  Todas las marcas de misoprostol se pueden usar de tres formas diferentes: dejando que se disuelva debajo de la lengua,  entre el interior de las mejillas y las encías,  o profundo en la vagina (solamente donde el aborto es legal).
                                </br><b>La mifepristona</b> siempre debe usarse junto con el misoprostol.  Este impide que la hormona progesterona continúe la gestación y hace que el aborto salga más fácilmente. Para tener un aborto seguro y eficaz,  los hombres trans y las personas no binarias que toman testosterona deben usar las mismas dosis de mifepristona y misoprostol que las personas que no toman testosterona.
                                El personal de salud no debe preguntar a los pacientes si hicieron algo para interrumpir el embarazo. Nadie tiene la obligación de decirle al personal de salud si su aborto fue provocado o natural.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTecompartimosAPPInformacion();
                }
                elseif($selectedValue=='Casos en los que no hay que usar pastillas para abortar'){
                    $this->say('<ul>
                   <li> • Has tenido dolor o sangrado durante este embarazo.</li>
                   <li> • Tienes un problema de salud grave, como enfermedad del corazón o anemia severa, un trastorno de sangrado como la hemofilia,  o insuficiencia suprarrenal crónica.</li>
                    <li>• Estás tomando un medicamento anticoagulante,  como warfarina, dabigatrán o rivaroxaban.</li>
                    <li>• Si alguna vez has tenido una reacción alérgica a la mifepristona o al misoprostol.</li>
                    <li>• Si tienes un DIU en el útero.  Puedes abortar con pastillas después de que te quiten el DIU.</li></ul>
                    Las pastillas para abortar no sirven para poner fin a un embarazo ectópico (embarazo en las trompas de Falopio).  Las señales de un embarazo ectópico incluyen dolor abdominal o sangrado.  Encuentra más información sobre este tema y sobre el embarazo ectópico que puede ser mortal.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTecompartimosAPPInformacion();
                }
                elseif($selectedValue=='Las señales de embarazo desaparecen'){
                    $this->say('<ul>
                                <li>Si tuviste un aborto por aspiración o por dilatación y evacuación: todas las señales del embarazo, incluso las náuseas y las molestias de los pechos, deben desaparecer en un día.</li>
                                <li>Si tuviste un aborto con pastillas:  las náuseas generalmente desaparecen en las primeras 24 horas, pero las molestias de los pechos pueden continuar por una a dos semanas.</li>
                                </ul>
                                Si no desaparecen las señales de embarazo, tales como la náusea y el dolor de los pechos, es posible que el embarazo siga ahí, ya sea dentro de la matriz o en las trompas de falopio (embarazo ectópico). Las hormonas del embarazo permanecen en el cuerpo unas tres semanas después de un aborto, por lo que una prueba de embarazo casera saldrá positiva incluso si el aborto se completó con éxito. Si las señales de embarazo continúan después de una o dos semanas, puedes hacerte una ecografía (ultrasonido) en un centro de salud o un hospital para confirmar si el aborto funcionó.
                                </br>Puedes volver a embarazarte poco después de tener un aborto, incluso antes de que te vuelva la regla. 
                                ');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTecompartimosAPPInformacion();
                }
                elseif($selectedValue=='Conocer tus derechos desde la perspectiva Feminista y de Derechos Humanos'){
                    $this->say('Tus derechos sexuales y reproductivos están vinculados con la seguridad, la libertad, la integridad física, las decisiones sobre sexualidad, la maternidad y el rechazo a toda forma de violencia, discriminación y opresión. ');
                    $this->say('Los he convertido en frases para que los puedas sentir tuyos, los tengo en grupos de tres en tres.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askQuieresSaberMasDerechos();

                }


            }
        }, ['ServiciosInterrupcionEmbarazoid']);
    }

    public function askQuieresSaberMasDerechos(): void
    {
        $question = Question::create('Quieres saber más?')
            ->fallback('Edad no valida')
            ->callbackId('QuieresSaberMasDerechosid')
            ->addButtons([
                Button::create('Si')->value('Si'),
                Button::create('No')->value('No')
            ]);
        $this->ask($question, function (Answer $answer)  {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Si','No'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->QuieresSaberMasDerechos = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='Si'){

                    $this->askEsmiderechoDecidirFormaLibre();
                }
                else{

                    $this->askTepuedoApoyarConAlgoMas();
                }


            }
        }, ['QuieresSaberMasDerechosid']);
    }

    public function askTecompartimosAPPInformacion(){
        $this->say('Te compartimos una APP con toda esta información <b> <a style="color:purple" target="_blank" href="https://hesperian.org/apps-moviles/"> hesperian</a><b>');
        $this->askTepuedoApoyarConAlgoMas();
    }

    //Orientación psicológica
    public function askTePuedoAcompanarAlgunasPreguntasIdentificarProcesoPsicoterapeutico():void
    {
        $question = Question::create('Te puedo acompañar con algunas preguntas que te permitan identificar temas de interés en tu proceso psicoterapéutico.')
            ->fallback('Edad no valida')
            ->callbackId('askTePuedoAcompañarAlgunasPreguntasIdentificarProcesoPsicoterapeuticoid')
            ->addButtons([
                Button::create('Empoderamiento')->value('Empoderamiento'),
                Button::create('Autocuidado')->value('Autocuidado'),
                Button::create('En tus relaciones')->value('En tus relaciones'),
                Button::create('Igualdad de oportunidades y el reconocimiento del valor individual')->value('Igualdad de oportunidades y el reconocimiento del valor individual'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Empoderamiento','Autocuidado','En tus relaciones','Igualdad de oportunidades y el reconocimiento del valor individual'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            }
            $this->TePuedoAcompanarAlgunasPreguntasIdentificarProcesoPsicoterapeutico = $selectedValue;
            $this->say('<div class="response-right">' . $answer->getText().'</div>');
            $this->bot->typesAndWaits($this->tiempoRespuesta);

            if($selectedValue == 'Empoderamiento') {
                $this->askSientesFaltaConfianzaMisma();
            }
            elseif($selectedValue=='Autocuidado'){
                $this->askRealizasActividadesActivarMente();

            }
            elseif($selectedValue=='En tus relaciones'){
                $this->askHasIdentificadoTienenControlTi();
            }
            elseif($selectedValue=='Igualdad de oportunidades y el reconocimiento del valor individual'){
                $this->say('En alguno de los siguientes ámbitos: comunitario, laboral, escolar, familiar, de pareja, entre otros. Te encuentras en una o varias de las siguientes situaciones: ');
                $this->askLasTareasFinanzasResponsabilidadesEstanDistribuidas();
            }
        }, ['askDebesSaberTienesDerechoSobreDerechoSexualesid']);
    }
    // Empodermmiento
    public function askSientesFaltaConfianzaMisma(): void
    {
        $question = Question::create('¿Sientes que te falta confianza en ti misma?')
            ->fallback('Edad no valida')
            ->callbackId('SientesFaltaConfianzaMismaid')
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
                $this->SientesFaltaConfianzaMisma = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTecuestaExpresarOpinionesDeseos();
            }
        }, ['SientesFaltaConfianzaMismaid']);
    }
    public function askTecuestaExpresarOpinionesDeseos(): void
    {
        $question = Question::create('¿Te cuesta trabajo expresar tus opiniones y deseos?')
            ->fallback('Edad no valida')
            ->callbackId('TecuestaExpresarOpinionesDeseosid')
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
                $this->TecuestaExpresarOpinionesDeseos = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askParaTomarDecisionesSiempreBuscasOpinion();
            }
        }, ['TecuestaExpresarOpinionesDeseosid']);
    }
    public function askParaTomarDecisionesSiempreBuscasOpinion(): void
    {
        $question = Question::create('Para tomar decisiones, ¿siempre buscas la opinión o aprobación de otras personas?')
            ->fallback('Edad no valida')
            ->callbackId('ParaTomarDecisionesSiempreBuscasOpinionid')
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
                $this->ParaTomarDecisionesSiempreBuscasOpinion = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTeEsFacilIdentificarProblematicas();
            }
        }, ['ParaTomarDecisionesSiempreBuscasOpinionid']);
    }
    public function askTeEsFacilIdentificarProblematicas(): void
    {
        $question = Question::create('¿Te es fácil identificar ante una problemática  diversas opciones ?')
            ->fallback('Edad no valida')
            ->callbackId('TeEsFacilIdentificarProblematicasid')
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
                $this->TeEsFacilIdentificarProblematicas = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askHasIdentificadoAcompananFrecuentemente();
            }
        }, ['TeEsFacilIdentificarProblematicasid']);
    }
    public function askHasIdentificadoAcompananFrecuentemente(): void
    {
        $question = Question::create('¿Has identificado que te acompañan frecuentemente sentimientos de inferioridad o inseguridad?')
            ->fallback('Edad no valida')
            ->callbackId('HasIdentificadoAcompananFrecuentementeid')
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
                $this->HasIdentificadoAcompananFrecuentemente = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                $respuestas=[$this->SientesFaltaConfianzaMisma,$this->TecuestaExpresarOpinionesDeseos,$this->ParaTomarDecisionesSiempreBuscasOpinion,$this->TeEsFacilIdentificarProblematicas,$this->HasIdentificadoAcompananFrecuentemente];

               if (in_array('Si', $respuestas)) {
                    $this->say('El empoderamiento es un proceso cada persona tiene su propio ritmo y camino hacia el fortalecimiento personal, considera buscar acompañamiento.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say('La RNR te puede poner en contacto con una psicóloga con formación y experiencia necesaria para brindarte el acompañamiento emocional que requieres. Ellas están capacitadas para proporcionar orientación especializada y herramientas que pueden ser benéficas para ti. Línea de atención 55 56749695 y 55 5243 6432, interior de la Republica 800 822 44 60 24 hrs. ');
                    $this->askTepuedoApoyarConAlgoMas();
                 }else{
                     $this->askMuyBienTeAnimoExploresPreguntas();
                 }



            }
        }, ['HasIdentificadoAcompananFrecuentementeid']);
    }
    public function  askMuyBienTeAnimoExploresPreguntas(){
        $this->say('¡Muy bien! Te animo a que explores otras preguntas relacionadas con aspectos a tener en cuenta al considerar la orientación psicológica, y a seguir informándote sobre temas que contribuyan a tu bienestar.. ');
        $this->askTepuedoApoyarConAlgoMas();
    }

    //Autocuidado
    public function askRealizasActividadesActivarMente(): void
    {
        $question = Question::create('¿Realizas actividades para activar tu mente como leer, tocar un instrumento....?')
            ->fallback('Edad no valida')
            ->callbackId('RealizasActividadesActivarMenteid')
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
                $this->RealizasActividadesActivarMente = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askPonesLimitesSabesDecirNo();
            }
        }, ['RealizasActividadesActivarMenteid']);
    }
    public function askPonesLimitesSabesDecirNo(): void
    {
        $question = Question::create('¿Pones límites, sabes decir NO?')
            ->fallback('Edad no valida')
            ->callbackId('PonesLimitesSabesDecirNoid')
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
                $this->PonesLimitesSabesDecirNo = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askExpresasEnfadoTristeza()();
            }
        }, ['PonesLimitesSabesDecirNoid']);
    }
    public function askExpresasEnfadoTristeza(): void
    {
        $question = Question::create('¿Expresas enfado o tristeza cuando lo necesitas? ')
            ->fallback('Edad no valida')
            ->callbackId('ExpresasEnfadoTristezaid')
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
                $this->ExpresasEnfadoTristeza = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTePermitesDisfrutarSalirAmistades();
            }
        }, ['ExpresasEnfadoTristezaid']);
    }
    public function askTePermitesDisfrutarSalirAmistades(): void
    {
        $question = Question::create('¿Te permites disfrutar y salir con amistades? ')
            ->fallback('Edad no valida')
            ->callbackId('PermitesDisfrutarSalirAmistadesid')
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
                $this->PermitesDisfrutarSalirAmistades = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askHacesPequenasDescansosDia();
            }
        }, ['PermitesDisfrutarSalirAmistadesid']);
    }
    public function askHacesPequenasDescansosDia(): void
    {
        $question = Question::create('¿Haces pequeños descansos en el día y comes tranquilamente a tus horas?')
            ->fallback('Edad no valida')
            ->callbackId('HacesPequenasDescansosDiaid')
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
                $this->HacesPequenasDescansosDia = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $respuestas=[$this->RealizasActividadesActivarMente, $this->PonesLimitesSabesDecirNo, $this->ExpresasEnfadoTristeza, $this->PermitesDisfrutarSalirAmistades, $this->HacesPequenasDescansosDia];

                if (in_array('Si', $respuestas)) {
                    $this->say('Las mujeres tenemos derecho a cuidar de nosotras mismas y priorizar nuestro bienestar. El autocuidado feminista promueve la autoestima, autonomía y la toma de decisiones informadas sobre la salud y el bienestar. Considera buscar acompañamiento.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say('La RNR te puede poner en contacto con una psicóloga con formación y experiencia necesaria para brindarte el acompañamiento emocional que requieres. Ellas están capacitadas para proporcionar orientación especializada y herramientas que pueden ser benéficas para ti. Línea de atención 55 56749695 y 55 5243 6432, interior de la Republica 800 822 44 60 24 hrs. ');
                    $this->askTepuedoApoyarConAlgoMas();
                }else{
                    $this->askMuyBienTeAnimoExploresPreguntas();
                }
            }
        }, ['HacesPequenasDescansosDiaid']);
    }

    //En tus Relaciones
    public function askHasIdentificadoTienenControlTi(): void
    {
        $question = Question::create('¿Has identificado que tienen control sobre ti?')
            ->fallback('Edad no valida')
            ->callbackId('HasIdentificadoTienenControlTiid')
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
                $this->HasIdentificadoTienenControlTi = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTefaltaApoyoEmocinalNecesario();
            }
        }, ['HasIdentificadoTienenControlTiid']);
    }
    public function askTefaltaApoyoEmocinalNecesario(): void
    {
        $question = Question::create('¿Te falta el apoyo emocional necesario en momentos difíciles?')
            ->fallback('Edad no valida')
            ->callbackId('TefaltaApoyoEmocinalNecesarioid')
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
                $this->TefaltaApoyoEmocinalNecesario = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askEscuchasCriticasConstantes();
            }
        }, ['TefaltaApoyoEmocinalNecesarioid']);
    }
    public function askEscuchasCriticasConstantes(): void
    {
        $question = Question::create('¿Escuchas criticas constantes?')
            ->fallback('Edad no valida')
            ->callbackId('EscuchasCriticasConstantesid')
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
                $this->EscuchasCriticasConstantes = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askHasIdentificadoUtilizadoTacticasManipuladoras();
            }
        }, ['EscuchasCriticasConstantesid']);
    }
    public function askHasIdentificadoUtilizadoTacticasManipuladoras(): void
    {
        $question = Question::create('¿Has identificado que utilizan tácticas manipuladoras para conseguir lo que quieren o para influir en tus decisiones?')
            ->fallback('Edad no valida')
            ->callbackId('HasIdentificoUtilizadoTacticasManipuladorasid')
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
                $this->HasIdentificoUtilizadoTacticasManipuladoras = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askHasIdentificadoAlgunasRelacionesAnsiedad();
            }
        }, ['HasIdentificoUtilizadoTacticasManipuladorasid']);
    }
    public function askHasIdentificadoAlgunasRelacionesAnsiedad(): void
    {
        $question = Question::create('¿Has identificado que algunas relaciones te generan ansiedad, tristeza, miedo o malestar constante?')
            ->fallback('Edad no valida')
            ->callbackId('HasIdentificoAlgunasRelacionesAnsiedadid')
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
                $this->HasIdentificoAlgunasRelacionesAnsiedad = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $respuestas=[$this->HasIdentificadoTienenControlTi, $this->TefaltaApoyoEmocinalNecesario, $this->EscuchasCriticasConstantes, $this->HasIdentificoUtilizadoTacticasManipuladoras, $this->HasIdentificoAlgunasRelacionesAnsiedad];
                if(in_array('Si',$respuestas)){
                    $this->say('Cada relación es única y estas señales pueden manifestarse de diferente manera, considera buscar apoyo.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say('La RNR te puede poner en contacto con una terapeuta con formación y experiencia necesarias para brindarte el apoyo emocional que requieres. Ellas están capacitadas para proporcionar orientación especializada y herramientas terapéuticas que pueden ser benéficas para ti. Línea de atención 55 56749695 y 55 5243 6432, interior de la Republica 800 822 44 60 24 hrs. ');
                    $this->askTepuedoApoyarConAlgoMas();
                }
                else{
                    $this->askMuyBienTeAnimoExploresPreguntas();
                }
            }
        }, ['HasIdentificoAlgunasRelacionesAnsiedadid']);
    }

    //Igualdad de oportunidades y el reconocimiento del valor individual
    public function askLasTareasFinanzasResponsabilidadesEstanDistribuidas(): void
    {
        $question = Question::create('Las tareas, finanzas o responsabilidades están distribuidas de manera desigual')
            ->fallback('Edad no valida')
            ->callbackId('LasTareasFinanzasResponsabilidadesEstanDistribuidasid')
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
                $this->LasTareasFinanzasResponsabilidadesEstanDistribuidas = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTusOpinionesDeseosNecesidadesTomadoCuenta();
            }
        }, ['LasTareasFinanzasResponsabilidadesEstanDistribuidasid']);
    }
    public function askTusOpinionesDeseosNecesidadesTomadoCuenta(): void
    {
        $question = Question::create('Tus opiniones, deseos y necesidades no son tomados en cuenta de la misma manera')
            ->fallback('Edad no valida')
            ->callbackId('TusOpinionesDeseosNecesidadesTomadoCuentaid')
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
                $this->TusOpinionesDeseosNecesidadesTomadoCuenta = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askSeAplicanDifereneEstandaresComportamiento();
            }
        }, ['TusOpinionesDeseosNecesidadesTomadoCuentaid']);
    }
    public function askSeAplicanDifereneEstandaresComportamiento(): void
    {
        $question = Question::create('Se aplican diferentes estándares de comportamiento basados en el género.')
            ->fallback('Edad no valida')
            ->callbackId('SeAplicanDifereneEstandaresComportamientoid')
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
                $this->SeAplicanDifereneEstandaresComportamiento = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askNoPuedoExpresarmeFormaLibre()();
            }
        }, ['SeAplicanDifereneEstandaresComportamientoid']);
    }
    public function askNoPuedoExpresarmeFormaLibre(): void
    {
        $question = Question::create('No puedo expresarme de forma libre y honesta por temor a consecuencias.')
            ->fallback('Edad no valida')
            ->callbackId('NoPuedoExpresarmeFormaLibreid')
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
                $this->NoPuedoExpresarmeFormaLibre = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $respuestas=[$this->LasTareasFinanzasResponsabilidadesEstanDistribuidas, $this->TusOpinionesDeseosNecesidadesTomadoCuenta, $this->SeAplicanDifereneEstandaresComportamiento, $this->NoPuedoExpresarmeFormaLibre];
                if(in_array('Si',$respuestas)){
                        $this->say('Para la igualdad de oportunidades y el reconocimiento del valor individual independientemente del género. Es importante reflexionar sobre cómo te sientes al respecto y considerar buscar apoyo personas cercanas y alguna profesional. ');
                        $this->bot->typesAndWaits($this->tiempoRespuesta);
                        $this->say('La RNR te puede poner en contacto con una terapeuta con formación y experiencia necesarias para brindarte el apoyo emocional que requieres. Ellas están capacitadas para proporcionar orientación especializada y herramientas terapéuticas que pueden ser benéficas para ti. 
                                    Línea de atención 55 56749695 y 55 5243 6432, interior de la Republica 800 822 44 60 24 hrs. ');
                }else{
                    $this->askMuyBienTeAnimoExploresPreguntas();
                }
            }
        }, ['NoPuedoExpresarmeFormaLibreid']);
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
                        $this->askLineasAtencionCEAREjercicioDerSexFiltro(
                            [
                                "Atención especializada (Referencia a Refugio y Orientación ante situaciones de violencia por ejemplo CEAR)",
                                "Acceso a derechos sexuales (Interrupción del embarazo, denuncias)"
                            ]
                        );
                }elseif($selectedValue=='Autogestión económica y economía feminista'){
                     $this->askLineasAtencionCEAREjercicioDerSexFiltro(
                         [
                             "Atención especializada (Referencia a Refugio y Orientación ante situaciones de violencia por ejemplo CEAR)",
                         ]
                     );
                }elseif($selectedValue=='Orientación jurídica'){
                    $this->askAlgunaOpcionesOrientacionJuridica();
                }


            }
        }, ['askHeSeleccionadAlgunasAtencionesPuedesRecibirAtravesOrganizacionesFormanParteRNROtrosid']);
    }
    public function askLíneasAtenciónPsicologiaFeministaOrganizacionesNoFormanParteRNR()
    {
        $this->askLineasAtencionPsicologicasFiltro();
    }
    public function askLineasAtencionPsicologicasFiltro(): void
    {
        $estado= $this->estado_republica?:"";
        $instituciones=  self::ListarOrganizaciones(
            Instituciones_Organizaciones::estadoRepublica($estado)
                ->Psicologica()
                ->ClasificacionNo([
                    "Emergencia",
                    "Acceso a derechos sexuales (Interrupción del embarazo, denuncias)"
                ])
                ->Identidad("Mujer")
                ->get());
        $this->say("<b>Líneas de atención </b></br></br>".   $instituciones);
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askTepuedoApoyarConAlgoMas();

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
                    $this->askTramitesConsultas();

                }


            }
        }, ['AnteriormenteTeBrindeInformacionRequeriasid']);
    }
    public function askprogramas(): void
    {
        $question = Question::create('Selecciona el programa de tu interés')
            ->fallback('Edad no valida')
            ->callbackId('askprogramasid')
            ->addButtons([
                Button::create('Pensión')->value('Pensión'),
                Button::create('Cultivo')->value('Cultivo'),
                Button::create('Apoyo economico')->value('Apoyo economico'),
                Button::create('Educación')->value('Educación'),
                Button::create('Vivienda')->value('Vivienda')
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Pensión', 'Cultivo', 'Apoyo economico', 'Educación', 'Vivienda'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->Programa = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askSeFiltraBaseProgramasTramitesConsultasFiltro('Programa');
            }
        }, ['askprogramasid']);








    }
    public function askTramitesConsultas(): void
    {
        $question = Question::create('Selecciona el tramite de tu interés')
            ->fallback('Edad no valida')
            ->callbackId('askTramitesConsultasid')
            ->addButtons([
                Button::create('Identificación')->value('Identificación'),
                Button::create('Finanzas personales')->value('Finanzas personales'),
                Button::create('Educación')->value('Educación'),
                Button::create('Seguridad Social')->value('Seguridad Social'),
                Button::create('Juridíco')->value('Juridíco'),
                Button::create('Empleo')->value('Empleo')
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Identificación', 'Finanzas personales', 'Educación', 'Seguridad Social', 'Juridíco', 'Empleo'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->Tramite = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askSeFiltraBaseProgramasTramitesConsultasFiltro('Tramite');
            }
        }, ['askTramitesConsultasid']);




    }
    public function askSeFiltraBaseProgramasTramitesConsultasFiltro($entorno): void
    {
        if($entorno=='Programa'){
            $programa=$this->Programa;
            $Programas=  self::ListarProgramasTramites(Programas_Sociales_Tramites::Tipo('Programa')->caracteristica($programa)->get());
            $this->say("<b>Programas</b></br></br>".   $Programas);
            $this->bot->typesAndWaits($this->tiempoRespuesta);
            $this->askTepuedoApoyarConAlgoMas();

        }else{
            $tramite=$this->Tramite;
            $Programas=  self::ListarProgramasTramites(Programas_Sociales_Tramites::Tipo('Tramites y consultas')->caracteristica($tramite)->get());
            $this->say("<b>Tramites y Consultas</b></br></br>".   $Programas);
            $this->bot->typesAndWaits($this->tiempoRespuesta);
            $this->askTepuedoApoyarConAlgoMas();
        }

    }
    public function askLineasAtencionCEAREjercicioDerSexFiltro($clasificacion):void{



        $estado=$this->estado_republica;
        $Programas=  self::ListarOrganizaciones(
            Instituciones_Organizaciones::estadoRepublica($estado)
                ->Identidad("Mujer")
                ->Clasificaciones($clasificacion)

                ->get()
            );
        $this->say("<b>Líneas de Atención Especializada</b></br></br>".   $Programas);
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askTepuedoApoyarConAlgoMas();

    }
    public function askAlgunaOpcionesOrientacionJuridica(): void
    {
        $question = Question::create('A continuación algunos  opciones de Orientación Jurídica')
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

                    $this->askQuieresSaberSolicitarOrdenProteccion();

                } elseif($selectedValue=='Poner una denuncia por violencia'){
                    $this->askAlgunasOpcionesPonerDenunciaPorViolencia();

                } elseif($selectedValue=='Números telefónicos para orientación'){
                    $this->askLineasAtencionLegalFiltro();
                }
            }
        }, ['AnteriormenteTeBrindeInformacionRequeriasid']);
    }
    public function askQuieresSaberSolicitarOrdenProteccion(): void
    {
        $question = Question::create('¿Quieres saber cómo solicitar una orden de protección?')
            ->fallback('Edad no valida')
            ->callbackId('QuieresSaberSolicitarOrdenProteccionid')
            ->addButtons([
                Button::create('Presencial')->value('Presencial'),
                Button::create('En linea')->value('En linea'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Presencial','En linea'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {

                $this->QuieresSaberSolicitarOrdenProteccion = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='Presencial'){
                    $this->say('
                    1.- Puedes acudir al Ministerio Público, Centros de Justicia para las Mujeres y al Poder Judicial para pedir una orden de protección. Las autoridades no deber exigirte pruebas de los hechos de violencia o riesgo, debe bastar con tu palabra, por lo que negarte el acceso a protección por falta de pruebas o documentos es una violación a tus derechos humanos. </br>
                    2. La orden de Protección también puede ser solicitada por terceras personas, sin embargo, la mujer víctima de violencias debe acudir después a ratificar la información. </br>
                    3. En ninguna circunstancia deben condicionarte la protección, ni exigirte hagas una denuncia.</br>
                    4. Puedes solicitar: restricción de comunicación; restricción de acercamiento; botón de pánico o número telefónico de autoridad responsable; rondín policíaco; sacar a la persona agresora de domicilio en común y acompañamiento a la víctima para sacar pertenencias del domicilio en común con apoyo de elementos de seguridad pública.</br>
                    ');
                    $this->askTepuedoApoyarConAlgoMas();

                }
                elseif($selectedValue=='En linea') {

                    $this->say('
                    1. Descarga el siguiente  formato  <a style="color:purple; font-weight: bold;font-style: italic; "  href="https://92eab0f5-8dd4-485d-a54f-b06fa499694d.filesusr.com/ugd/ba8440_d36c5f87e400477da29bcba2e2252f0c.pdf"> Aquí </a>   imprímelo y llena la información solicitada.</br>
                    2. Acude a un Ministerio Público, Juzgado en turno o Centro de Justicia para las Mujeres.</br>
                    3. Las autoridades te harán una entrevista en donde deberás informar los hechos de violencia, datos de la persona agresora y si existen antecedentes de violencia. </br>
                    4. Te realizarán una evaluación de riesgo para determinar qué tipo de medida de protección es necesaria implementar (Lo anterior no debe ser excluyente para otorgarte una medida de protección). </br>
                    5. La autoridad emitirá un documento en el que quede constatado el otorgamiento de la orden de protección.</br>
                    6. Las medidas de protección se notificarán personalmente a la persona agresora para garantizar su cumplimiento. Ninguna autoridad debe obligarte a informar de forma directo al agresor, dicha acción debe realizarla la autoridad competente. </br>
                    ');
                    $this->askTepuedoApoyarConAlgoMas();

                }

            }
        }, ['QuieresSaberSolicitarOrdenProteccionid']);
    }
    public function askLineasAtencionLegalFiltro():void{
        $estado=$this->estado_republica;
        $Programas=  self::ListarOrganizaciones(
            Instituciones_Organizaciones::estadoRepublica($estado)
                ->Identidad("Mujer")
                ->Legal()
                ->get()
        );
        $this->say("<b>Líneas de Atención Legal</b></br></br>".   $Programas);
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askTepuedoApoyarConAlgoMas();

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
                    $this->askTepuedoApoyarConAlgoMas();
                } elseif($selectedValue=='Tipos de denuncia'){
                    $this->say('<ul>
                                <li>1. Querella: reportados por la mujer afectada (Violencias). </li>
                            <li>2. Oficio: no es necesaria la presencia de la víctima (violación, feminicidio).</li>
                            <li>3. Tentativa: no se llega a la consumación, pero se pone en peligro el bien jurídico.</li>
                            </ul>');
                    $this->askTepuedoApoyarConAlgoMas();


                } elseif($selectedValue=='¿Dónde denunciar?'){
                    $this->say('<ul>
                                    <li>1. FGR</li>
                                    <li>2. FGJ</li>
                                    <li>3. Línea: denuncia.org </li>
                                </ul>');
                    $this->askTepuedoApoyarConAlgoMas();


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
                    $this->askTepuedoApoyarConAlgoMas();

                }


            }
        }, ['AnteriormenteTeBrindeInformacionRequeriasid']);
    }


//Información adicional
    public function askAlgunasOpcionesInformacionAdicional(): void
    {
        $question = Question::create('Selecciona la información adicional de tu interés')
            ->fallback('Edad no valida')
            ->callbackId('askAlgunasOpcionesInformacionAdicionalid')
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
                $this->AlgunasOpcionesInformacionAdicional = $selectedValue;
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
                elseif($selectedValue=='Y tú ¿Vives violencia?'){
                    $this->say('Con esta prueba puedes analizar las relaciones que tengas, puede ser con tu pareja; algún familiar; compañero/a de trabajo, amistad, etc.  Recuerda que es importante que respondas con honestidad para obtener un resultado confiable, solo tú conocerás lo que resulta.');
                    $this->askCuandoDirigeTeLlamaApodoDesagradeTest();
                }
                elseif($selectedValue=='Amor propio'){
                    $this->say('Se adentra en la posibilidad que tenemos las mujeres de construir nuevas narrativas, lenguajes y símbolos sobre nuestros cuerpos y crear nuevas formas de ser y estar en el mundo. Lejos de las exigencias capitalistas de los modelos hegemónicos de belleza.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say('Tengo 5 preguntas para ti');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askPuedesIrMedicoSolaAunqueSeaEnfermaGrave();
                }
            }
        }, ['askAlgunasOpcionesInformacionAdicionalid']);
    }
    public function askPuedesIrMedicoSolaAunqueSeaEnfermaGrave(): void
    {
        $question = Question::create('¿Puedes ir al medico tu sola aunque sea una enfermedad grave?')
            ->fallback('Edad no valida')
            ->callbackId('PuedesIrMedicoSolaAunqueSeaEnfermaGraveid')
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

                $this->PuedesIrMedicoSolaAunqueSeaEnfermaGrave = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                $this->askCreesNoTienesMuchoSentirteOrgullosa();


            }
        }, ['PuedesIrMedicoSolaAunqueSeaEnfermaGraveid']);
    }
    public function askCreesNoTienesMuchoSentirteOrgullosa(): void
    {
        $question = Question::create('¿Crees que no tienes mucho por lo que sentirte orgullosa?')
            ->fallback('Edad no valida')
            ->callbackId('CreesNoTienesMuchoSentirteOrgullosaid')
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

                $this->CreesNoTienesMuchoSentirteOrgullosa = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askSiTienesPasarFinSemanaSola();



            }
        }, ['CreesNoTienesMuchoSentirteOrgullosaid']);
    }
    public function askSiTienesPasarFinSemanaSola(): void
    {
        $question = Question::create('¿Si tienes que pasar el fin de semana sola, ¿te aburres, te sientes mal y tienes que llamar a todo el mundo?')
            ->fallback('Edad no valida')
            ->callbackId('SiTienesPasarFinSemanaSolaid')
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
                $this->SiTienesPasarFinSemanaSola = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                $this->askGeneralmenteDasMasValorOpinaTuPareja();


            }
        }, ['SiTienesPasarFinSemanaSolaid']);
    }
    public function askGeneralmenteDasMasValorOpinaTuPareja(): void
    {
        $question = Question::create('¿Generalmente, le das más valor a lo que opina tu pareja, tus amistades o tu familia que a tus propias opiniones?')
            ->fallback('Edad no valida')
            ->callbackId('GeneralmenteDasMasValorOpinaTuParejaid')
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
                $this->GeneralmenteDasMasValorOpinaTuPareja = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askCuandoTienesTomarDecisionImportanteNoHacerlo();
            }
        }, ['GeneralmenteDasMasValorOpinaTuParejaid']);
    }
    public function askCuandoTienesTomarDecisionImportanteNoHacerlo(): void
    {
        $question = Question::create('¿Cuando tienes que tomar una decisión importante, no puedes hacerlo sin consultar a alguien más? ')
            ->fallback('Edad no valida')
            ->callbackId('CuandoTienesTomarDecisionImportanteNoHacerloid')
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
                $this->CuandoTienesTomarDecisionImportanteNoHacerlo = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $AmorPropi=[$this->PuedesIrMedicoSolaAunqueSeaEnfermaGrave, $this->CreesNoTienesMuchoSentirteOrgullosa, $this->SiTienesPasarFinSemanaSola, $this->GeneralmenteDasMasValorOpinaTuPareja, $this->CuandoTienesTomarDecisionImportanteNoHacerlo];
                if(in_array('Si',$AmorPropi)){
                    $this->say('La RNR te puede poner en contacto con profesionales  con formación y experiencia necesaria para darte orientación especializada y herramientas que pueden ser benéficas para ti. ');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askLineasAtencionAmorPropioFiltro();
                }else{
                    $this->say('Has contestado acertadamente cinco preguntas sobre amor propio para seguir informándote sobre este tema crucial para promover un entorno seguro y saludable para todas, puedes buscar talleres u orientación psicológica. Si te interesa selecciona si, para brindarte un contacto.');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askLineasAtencionAmorPropioFiltro();
                }


            }
        }, ['CuandoTienesTomarDecisionImportanteNoHacerloid']);
    }
    public function askLineasAtencionAmorPropioFiltro(): void
    {
        $estado= $this->estado_republica?:"";
        $genero= $this->genero?:"";
        if($genero=='Mujer'){
            $Ins=Instituciones_Organizaciones::estadoRepublica($estado)->Identidad($genero)
                ->Clasificaciones(["Atención especializada (Referencia a Refugio y Orientación ante situaciones de violencia por ejemplo CEAR)", "Otra"])
                ->whereOr(function ($query) {
                    return $query->Legal();
                })
                ->whereOr(function ($query) {
                    return $query->Digital();
                })
                ->get();

        }else{
            $Ins=Instituciones_Organizaciones::estadoRepublica($estado)->Identidad($genero)
                ->Clasificaciones(["Atención especializada (Referencia a Refugio y Orientación ante situaciones de violencia por ejemplo CEAR)", "Otra"])
                ->where("Edad_M_Ho", ">=", 18)
                ->whereOr(function ($query) {
                    return $query->Legal();
                })
                ->whereOr(function ($query) {
                    return $query->Digital();
                })
                ->get();

        }
         $instituciones=  self::ListarOrganizaciones($Ins);

        $this->say("<b>Líneas de atención </b></br></br>".   $instituciones);
        $this->bot->typesAndWaits($this->tiempoRespuesta);
        $this->askTepuedoApoyarConAlgoMas();

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
                    $this->say('<b>FASE 1</b></br>
                                Empieza con burlas sobre lo que hablas y haces, hay gritos y amenazas bajo la excusa de que haces las cosas mal.
                                Esta fase es llamada Acumulación de tensión.
                               </br>
                                <b>FASE 2</b></br>
                                Sin importar si has hechos cosas para evitar el enojo de la otra persona llega el momento de la agresión.
                                Fase conocida como Explosión violenta.
                                </br>
                                <b>FASE 3</b></br>
                                Después de la violencia la persona agresora pide perdón, promete que no va a volver a actuar así, piensas que la relación ha cambiado y vuelves a confiar, pero vuelve a la Fase 1 y así repetidamente.
                                La fase se conoce como la Luna de Miel.
                                ');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTepuedoApoyarConAlgoMas();
                }else{
                   $this->askTepuedoApoyarConAlgoMas();
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
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTepuedoApoyarConAlgoMas();

                }elseif($selectedValue=='Laboral o docente'){
                    $this->say('Se ejerce por las personas que tienen un vínculo laboral, docente o análogo con la víctima, independientemente de la relación jerárquica, consistente en un acto o una omisión en abuso de poder que daña la autoestima, salud, integridad, libertad y seguridad de la víctima, e impide su desarrollo y atenta contra la igualdad. </br>
                                Puede consistir en un solo evento dañino o en una serie de eventos cuya suma produce el daño. También incluye el acoso o el hostigamiento sexual. </br>
                                La violencia laboral se constituye por la negativa ilegal a contratar a la víctima o a respetar su permanencia o condiciones generales de trabajo; la descalificación del trabajo realizado, las amenazas, la intimidación, las humillaciones, la explotación, el impedimento a las mujeres de llevar a cabo el período de lactancia previsto en la ley y todo tipo de discriminación por condición de género.  </br>
                                La violencia docente se constituye por aquellas conductas que dañen la autoestima de las alumnas con actos de discriminación por su sexo, edad, condición social, académica, limitaciones o características físicas, que les infligen maestras o maestros. </br>
                                El hostigamiento sexual es el ejercicio del poder, en una relación de subordinación real de la víctima frente a la persona agresora en los ámbitos laboral o escolar. Se expresa en conductas verbales, física o ambas, relacionadas con la sexualidad de connotación lasciva.</br>
                                El acoso sexual es una forma de violencia en la que, si bien no existe la subordinación, hay un ejercicio abusivo de poder que conlleva a un estado de indefensión y de riesgo para la víctima, independientemente de que se realice en uno o varios eventos. 
                                ');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTepuedoApoyarConAlgoMas();
                }elseif($selectedValue=='Institucional'){
                        $this->say('Son los actos u omisiones de las y los servidores públicos de cualquier orden de gobierno que discriminen o tengan como fin dilatar, obstaculizar o impedir el goce y ejercicio de los derechos humanos de las mujeres así como su acceso  al disfrute de políticas públicas destinadas a prevenir, atender, investigar, sancionar y erradicar los diferentes tipos de violencia. ');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTepuedoApoyarConAlgoMas();
                }
            elseif($selectedValue=='Feminicida') {
                    $this->say('La violencia feminicida es la forma extrema de violencia de género contra las mujeres, producto de la violación de sus derechos humanos, en los ámbitos público y privado, conformada por el conjunto de conductas misóginas que pueden conllevar impunidad social y del Estado y puede culminar en homicidio y otras formas de muerte violenta de mujeres.');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTepuedoApoyarConAlgoMas();
                }
            elseif($selectedValue=='Alerta de violencia de género contra las mujeres') {
                $this->say('La alerta de violencia de género es el conjunto de acciones gubernamentales de emergencia para enfrentar y erradicar la violencia feminicida en un territorio determinado, ya sea ejercida por individuos o por la propia comunidad.');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                $this->askTepuedoApoyarConAlgoMas();
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
                    $this->askLineasEmergenciaFiltro();
                }elseif($selectedValue=='Identifica los tipos de violencia') {

                    $this->askQuieroSaberIdentificarViolencias();
                }


            }
        }, ['QuieresSaberQueConsisteid']);
    }


    //test
    public function askCuandoDirigeTeLlamaApodoDesagradeTest():void{
        $question = Question::create('¿Cuándo se dirige a ti te llama por un apodo que te desagrade o con groserías?')
            ->fallback('Edad no valida')
            ->callbackId('CuandoDirigeTeLlamaApodoDesagrdeTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->CuandoDirigeTeLlamaApodoDesagrdeTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=1;
                }


                $this->askTeDiceQueEstasConAlguienMasTest();
            }
        }, ['CuandoDirigeTeLlamaApodoDesagrdeTestid']);
    }
    public function askTeDiceQueEstasConAlguienMasTest():void{
        $question = Question::create('¿Te dice que estás con alguien más, o que tus amigos quieren estar contigo?')
            ->fallback('Edad no valida')
            ->callbackId('TeDiceQueEstasConAlguienMasTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TeDiceQueEstasConAlguienMasTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=1;
                }
                $this->askTeHaInterrumpidoEnSituacionesLaboralesTest();
            }
        }, ['TeDiceQueEstasConAlguienMasTestid']);
    }
    public function askTeHaInterrumpidoEnSituacionesLaboralesTest():void{
        $question = Question::create('¿Te ha interrumpido en situaciones laborales o personales para pedirte explicaciones por algo que tú realizaste')
            ->fallback('Edad no valida')
            ->callbackId('TeHaInterrumpidoEnSituacionesLaboralesTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TeHaInterrumpidoEnSituacionesLaboralesTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=1;
                }
                $this->askTeDicenTieneOtrasParejasTest();
            }
        }, ['TeHaInterrumpidoEnSituacionesLaboralesTestid']);
    }
    public function askTeDicenTieneOtrasParejasTest():void{
        $question = Question::create('¿Te dicen que tiene otras parejas y te compara con sus exparejas?')
            ->fallback('Edad no valida')
            ->callbackId('TeDicenTieneOtrasParejasTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TeDicenTieneOtrasParejasTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=1;
                }
                $this->askTodoTiempoQuiereSaberDondeEstasTest();
            }
        }, ['TeDicenTieneOtrasParejasTestid']);
    }
    public function askTodoTiempoQuiereSaberDondeEstasTest():void{
        $question = Question::create('¿Todo el tiempo quiere saber dónde estás y con quién estás?')
            ->fallback('Edad no valida')
            ->callbackId('TodoTiempoQuiereSaberDondeEstasTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TodoTiempoQuiereSaberDondeEstasTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=1;
                }
                $this->askTeCriticaBurlaCuerpoErroresTest();
            }
        }, ['TodoTiempoQuiereSaberDondeEstasTestid']);
    }
    public function askTeCriticaBurlaCuerpoErroresTest():void{
        $question = Question::create('¿Te critica, se burla de tu cuerpo y/o de tus errores en público o en privado? ')
            ->fallback('Edad no valida')
            ->callbackId('TeCriticaBurlaCUerpoErroresTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TeCriticaBurlaCUerpoErroresTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=1;
                }
                $this->askTeHaPedidoCambiesFormaVestirTest();
            }
        }, ['TeCriticaBurlaCUerpoErroresTestid']);
    }
    public function askTeHaPedidoCambiesFormaVestirTest():void{
        $question = Question::create('¿Te ha pedido que cambies tu forma de vestir, maquillarte o peinarte?')
            ->fallback('Edad no valida')
            ->callbackId('TeHaPedidoCambiesFormaVestirTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TeHaPedidoCambiesFormaVestirTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=1;
                }
                $this->askCuandoEstasConEsaPersonaTensionTest();
            }
        }, ['TeHaPedidoCambiesFormaVestirTestid']);
    }
    public function askCuandoEstasConEsaPersonaTensionTest():void{
        $question = Question::create('Cuando estás con esa persona ¿Sientes tensión y piensas que se molestará en cualquier momento?')
            ->fallback('Edad no valida')
            ->callbackId('CuandoEstasConEsaPersonaTensionTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->CuandoEstasConEsaPersonaTensionTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=2;
                }
                $this->askHaRevisadoCelularLlamadasMensajesTest();
            }
        }, ['CuandoEstasConEsaPersonaTensionTestid']);
    }
    public function askHaRevisadoCelularLlamadasMensajesTest():void{
        $question = Question::create('¿Ha revisado tu celular, llamadas, mensajes e incluso te ha exigido que le proporciones las contraseñas de tus cuentas como redes sociales o correo electrónico? ')
            ->fallback('Edad no valida')
            ->callbackId('HaRevisadoCelularLlamadasMensajesTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->HaRevisadoCelularLlamadasMensajesTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=1;
                }
                $this->askParaDecidirLoHaranCuandoSalenTest();
            }
        }, ['HaRevisadoCelularLlamadasMensajesTestid']);
    }
    public function askParaDecidirLoHaranCuandoSalenTest():void{
        $question = Question::create('Para decidir lo que harán cuando salen ¿Ignora tu opinión?')
            ->fallback('Edad no valida')
            ->callbackId('ParaDecidirLoHaranCuandoSalenTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->ParaDecidirLoHaranCuandoSalenTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askHaInterferidoRelacionesConversacionesInternetTest();
            }
        }, ['ParaDecidirLoHaranCuandoSalenTestid']);
    }
    public function askHaInterferidoRelacionesConversacionesInternetTest():void{
        $question = Question::create('¿Ha interferido en tus relaciones o conversaciones en internet con otras personas?')
            ->fallback('Edad no valida')
            ->callbackId('HaInterferidoRelacionesConversacionesInternetTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->HaInterferidoRelacionesConversacionesInternetTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=1;
                }
                $this->askCuandoHablanTesientesMalHablaSexoTest();
            }
        }, ['HaInterferidoRelacionesConversacionesInternetTestid']);
    }
    public function askCuandoHablanTesientesMalHablaSexoTest():void{
        $question = Question::create('Cuando hablan ¿Te sientes mal porque solo hablan de sexo y te pregunta si tuviste relaciones sexuales con otras personas?')
            ->fallback('Edad no valida')
            ->callbackId('CuandoHablanTesientesMalHablaSexoTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->CuandoHablanTesientesMalHablaSexoTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=2;
                }
                $this->askHaHechoUsoDineroTusAhorrosTest();
            }
        }, ['CuandoHablanTesientesMalHablaSexoTestid']);
    }
    public function askHaHechoUsoDineroTusAhorrosTest():void{
        $question = Question::create('¿Ha hecho uso de tu dinero o de tus ahorros sin tu autorización? ')
            ->fallback('Edad no valida')
            ->callbackId('HaHechoUsoDineroTusAhorrosTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->HaHechoUsoDineroTusAhorrosTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=1;
                }
                $this->askSientesConstantementeEstaControlandoTest();
            }
        }, ['HaHechoUsoDineroTusAhorrosTestid']);
    }
    public function askSientesConstantementeEstaControlandoTest():void{
        $question = Question::create('¿Sientes que constantemente te está controlando y lo justifica en “nombre del amor”?')
            ->fallback('Edad no valida')
            ->callbackId('SientesConstantementeEstaControlandoTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->SientesConstantementeEstaControlandoTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=2;
                }
                $this->askTeHaLimitadoControladoGastosCubrirTest();
            }
        }, ['SientesConstantementeEstaControlandoTestid']);
    }
    public function askTeHaLimitadoControladoGastosCubrirTest():void{
        $question = Question::create('¿Te ha limitado y controlado los gastos para cubrir tus necesidades básicas o de la familia?')
            ->fallback('Edad no valida')
            ->callbackId('TeHaLimitadoControladoGastosCubrirTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TeHaLimitadoControladoGastosCubrirTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=2;
                }
                $this->askHasEscondidoDestruidoTusDocumentosTest();
            }
        }, ['TeHaLimitadoControladoGastosCubrirTestid']);
    }
    public function askHasEscondidoDestruidoTusDocumentosTest():void{
        $question = Question::create('¿Has escondido o destruido tus documentos, correspondencia o algunas otras pertenencias? ')
            ->fallback('Edad no valida')
            ->callbackId('HasEscondidoDestruidoTusDocumentosTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->HasEscondidoDestruidoTusDocumentosTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=2;
                }
                $this->askSiHasCedidoDeseosSexualesTest();
            }
        }, ['HasEscondidoDestruidoTusDocumentosTestid']);
    }
    public function askSiHasCedidoDeseosSexualesTest():void{
        $question = Question::create('Si has cedido a sus deseos sexuales ¿Sientes que ha sido por temor o presión? ')
            ->fallback('Edad no valida')
            ->callbackId('SiHasCedidoDeseosSexualesTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->SiHasCedidoDeseosSexualesTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askSiTienenRelacionesSexualesTeImpideUsoMetodoAntiTest();
            }
        }, ['SiHasCedidoDeseosSexualesTestid']);
    }
    public function askSiTienenRelacionesSexualesTeImpideUsoMetodoAntiTest():void{
        $question = Question::create('Si tienen relaciones sexuales ¿Te impide o condiciona el uso de métodos anticonceptivos? ')
            ->fallback('Edad no valida')
            ->callbackId('SiTienenRelacionesSexualesTeImpideUsoMetodoAntiTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->SiTienenRelacionesSexualesTeImpideUsoMetodoAntiTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askTeHaObligadoVerPornografiaTest();
            }
        }, ['SiTienenRelacionesSexualesTeImpideUsoMetodoAntiTestid']);
    }
    public function askTeHaObligadoVerPornografiaTest():void{
        $question = Question::create('¿Te ha obligado a ver pornografía o tener prácticas sexuales que te desagraden? ')
            ->fallback('Edad no valida')
            ->callbackId('TeHaObligadoVerPornografiaTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TeHaObligadoVerPornografiaTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askHaDifundidoInformacionImagenesEnviadoTest();
            }
        }, ['TeHaObligadoVerPornografiaTestid']);
    }
    public function askHaDifundidoInformacionImagenesEnviadoTest():void{
        $question = Question::create('¿Ha difundido información e imágenes, que tú le has enviado desde la confianza, a otras personas sin tu consentimiento?')
            ->fallback('Edad no valida')
            ->callbackId('HaDifundidoInformacionImagenesEnviadoTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->HaDifundidoInformacionImagenesEnviadoTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askTeHaPrecionadoObligadoConsumirDrogaTest();
            }
        }, ['HaDifundidoInformacionImagenesEnviadoTestid']);
    }
    public function askTeHaPrecionadoObligadoConsumirDrogaTest():void{
        $question = Question::create('¿Te ha presionado u obligado a consumir algún tipo de sustancia o droga? ')
            ->fallback('Edad no valida')
            ->callbackId('TeHaPrecionadoObligadoConsumirDrogaTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TeHaPrecionadoObligadoConsumirDrogaTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askSiTomaAlcoholConsumeAlgunTipoDrogaTest();
            }
        }, ['TeHaPrecionadoObligadoConsumirDrogaTestid']);
    }
    public function askSiTomaAlcoholConsumeAlgunTipoDrogaTest():void{
        $question = Question::create('Si toma alcohol o consume algún tipo de droga ¿Se comporta violento/a contigo o con otras')
            ->fallback('Edad no valida')
            ->callbackId('SiTomaAlcoholConsumeAlgunTipoDrogaTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->SiTomaAlcoholConsumeAlgunTipoDrogaTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=2;
                }
                $this->askTienesRendirleCuentasTodoTest();
            }
        }, ['SiTomaAlcoholConsumeAlgunTipoDrogaTestid']);
    }
    public function askTienesRendirleCuentasTodoTest():void{
        $question = Question::create('¿Tienes que rendirle cuentas de todo lo que gastas y/o haces? ')
            ->fallback('Edad no valida')
            ->callbackId('TienesRendirleCuentasTodoTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TienesRendirleCuentasTodoTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=2;
                }
                $this->askACausaProblemasTienesPerdidaApetitoTest();
            }
        }, ['TienesRendirleCuentasTodoTestid']);
    }
    public function askACausaProblemasTienesPerdidaApetitoTest():void{
        $question = Question::create('A causa de los problemas ¿Tienes:  pérdida del apetito, sueño, malos resultados o abandono de tus actividades, alejamiento de tus amistades y/o familiares?')
            ->fallback('Edad no valida')
            ->callbackId('ACausaProblemasTienesPerdidaApetitoTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->ACausaProblemasTienesPerdidaApetitoTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askCuandoSeEnojaDiscutenTest();
            }
        }, ['ACausaProblemasTienesPerdidaApetitoTestid']);
    }
    public function askCuandoSeEnojaDiscutenTest():void{
        $question = Question::create('Cuando se enojan o discuten ¿Has sentido que tu vida está en peligro? ')
            ->fallback('Edad no valida')
            ->callbackId('CuandoSeEnojaDiscutenTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->CuandoSeEnojaDiscutenTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askTeHaGolpeadoAlgunaParteCuerpoTest();
            }
        }, ['CuandoSeEnojaDiscutenTestid']);
    }
    public function askTeHaGolpeadoAlgunaParteCuerpoTest():void{
        $question = Question::create('¿Te ha golpeado con alguna parte de su cuerpo o con algún objeto? ')
            ->fallback('Edad no valida')
            ->callbackId('TeHaGolpeadoAlgunaParteCuerpoTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TeHaGolpeadoAlgunaParteCuerpoTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askTeHaObligadoPresionadoEnviarImagenesIntimasTest();
            }
        }, ['TeHaGolpeadoAlgunaParteCuerpoTestid']);
    }
    public function askTeHaObligadoPresionadoEnviarImagenesIntimasTest():void{
        $question = Question::create('¿Te ha obligado o presionado enviar imágenes íntimas? ')
            ->fallback('Edad no valida')
            ->callbackId('TeHaObligadoPresionadoEnviarImagenesIntimasTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TeHaObligadoPresionadoEnviarImagenesIntimasTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askTehaCausadoLesionesAmeritenRecibirAtencionMedicaTest();
            }
        }, ['TeHaObligadoPresionadoEnviarImagenesIntimasTestid']);
    }
    public function askTehaCausadoLesionesAmeritenRecibirAtencionMedicaTest():void{
        $question = Question::create('¿Te ha causado lesiones que ameriten recibir atención médica, psicológica, jurídica o auxilio policial? ')
            ->fallback('Edad no valida')
            ->callbackId('TehaCausadoLesionesAmeritenRecibirAtencionMedicaTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TehaCausadoLesionesAmeritenRecibirAtencionMedicaTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askTeHaAmenazadoConMatarteCuandoQuieresTerminarTest();
            }
        }, ['TehaCausadoLesionesAmeritenRecibirAtencionMedicaTestid']);
    }
    public function askTeHaAmenazadoConMatarteCuandoQuieresTerminarTest():void{
        $question = Question::create('¿Te ha amenazado con matarte cuando le dices que quieres terminar con él? ')
            ->fallback('Edad no valida')
            ->callbackId('TeHaAmenazadoConMatarteCuandoQuieresTerminarTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TeHaAmenazadoConMatarteCuandoQuieresTerminarTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askTeHaExigidoDemuestresDondeEstaTuGeoTest();
            }
        }, ['TeHaAmenazadoConMatarteCuandoQuieresTerminarTestid']);
    }
    public function askTeHaExigidoDemuestresDondeEstaTuGeoTest():void{
        $question = Question::create('¿Te ha exigido que demuestres dónde estás con tu geolocalización?.')
            ->fallback('Edad no valida')
            ->callbackId('TeHaExigidoDemuestresDondeEstaTuGeoTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->TeHaExigidoDemuestresDondeEstaTuGeoTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askDespuesDisculpasMuestraCarinoAtencionTest();
            }
        }, ['TeHaExigidoDemuestresDondeEstaTuGeoTestid']);
    }
    public function askDespuesDisculpasMuestraCarinoAtencionTest():void{
        $question = Question::create('Después de una disculpa ¿Muestra cariño y atención; te regala cosas y te promete que nunca volverá a suceder, que todo cambiará? ')
            ->fallback('Edad no valida')
            ->callbackId('DespuesDisculpasMuestraCArinoAtencionTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->DespuesDisculpasMuestraCArinoAtencionTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askSeHaEnfadadoPorNoTenerUnaRespuestaInmediantaTest();
            }
        }, ['DespuesDisculpasMuestraCArinoAtencionTestid']);
    }
    public function askSeHaEnfadadoPorNoTenerUnaRespuestaInmediantaTest():void{
        $question = Question::create('¿Se ha enfadado por no tener siempre una respuesta inmediata cuando te mando un mensaje o inbox? ')
            ->fallback('Edad no valida')
            ->callbackId('SeHaEnfadadoPorNoTenerUnaRespuestaInmediantaTestid')
            ->addButtons([
                Button::create('Frecuentemente')->value('Frecuentemente'),
                Button::create('Algunas veces')->value('Algunas veces'),
                Button::create('Nunca')->value('Nunca')]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue,['Frecuentemente','Algunas veces','Nunca'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->SeHaEnfadadoPorNoTenerUnaRespuestaInmediantaTest = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue!='Nunca'){
                    $this->ResultadoTest+=3;
                }
                $this->askResultadoTest();
            }
        }, ['SeHaEnfadadoPorNoTenerUnaRespuestaInmediantaTestid']);
    }

    public function askResultadoTest(){
        $r=$this->ResultadoTest;

        if($r==0){
            $this->say('¡Tu relación está libre de violencia! Mantente siempre atenta y acompaña a otras mujeres y niñas a concientizarse acerca de las violencias machistas.  Recuerda en la más mínima señal, toma decisiones, pon límites y busca acompañamiento. En la Red Nacional de Refugios te acompañamos, recuerda que un Refugio también es una charla, una orientación, ese lugar físico o emocional en donde te sientes con bienestar.');
            $this->bot->typesAndWaits(5);
            $this->say('<img src="/imageneschatbot/postal3.jpeg" style="width:100%"/>');
            $this->bot->typesAndWaits(5);
            $this->say('<img src="/imageneschatbot/postal6.jpeg" style="width:100%"/>');
        }
        if($r==1 && $r<=7){
            $this->say('Al parecer hay situaciones en tu relación que te generan incomodidad, es esencial que no ignores estos sentimientos. Podrías estar en una relación de control o en una en la que no te sientes plenamente cómoda ni libre de ser tu misma. Es importante que hables sobre tus sentimientos con tu red de apoyo o que busques nuestro acompañamiento psicológico feminista, recuerda que es gratuito. Este acompañamiento te ayudará a determinar si tu relación te proporciona bienestar y te permitirá conocer diversas opciones. Recuerda, si algo te incomoda, merece tu atención.');
            $this->bot->typesAndWaits(5);
            $this->say('<img src="/imageneschatbot/postal2.jpeg" style="width:100%"/>');
            $this->bot->typesAndWaits(5);
            $this->say('<img src="/imageneschatbot/postal3.jpeg" style="width:100%"/>');
        }
        if($r==8 && $r<=18){
            $this->say('La violencia nunca es aceptable, en ninguna circunstancia. Es vital que recuerdes que los malos tratos pueden escalar: desde forzarte a hacer algo que no deseas, empujones disfrazados de "juego" o insultos, hasta agresiones que te lleven al hospital o a una situación muy difícil de escapar. El amor no debe doler ni dañar. Sabemos que no es fácil, pero estamos aquí para acompañarte  a construir una relación basada en el respeto, la igualdad y libre de violencias. Puedes asistir a talleres, conversatorios y diversas actividades para aprender a manejar límites, conocer tus derechos y tomar decisiones sobre tu vida sin presiones, priorizándote a ti misma. Recuerda, tienes derecho a ser libre y a ser tratada con respeto siempre. Puedes contactarnos al 55 56 74 96 95 en CDMX y Zona metropolitana o si estás en el interior de la Republica al  800 822 4460, estamos las 24 horas del día todo el año. También nos puedes mandar mensaje privado a nuestras redes sociales ');
            $this->bot->typesAndWaits(5);
            $this->say('<img src="/imageneschatbot/postal2.jpeg" style="width:100%"/>');
            $this->bot->typesAndWaits(5);
            $this->say('<img src="/imageneschatbot/postal4.jpeg" style="width:100%"/>');
            $this->bot->typesAndWaits(5);
            $this->say('<img src="/imageneschatbot/postal5.jpeg" style="width:100%"/>');
        }
        if( $r>18){
            $this->say('Es importante que sepas que todo indica que estás en una situación de riesgo y que tu vida podría estar en peligro. Queremos que estés a salvo y queremos acompañarte. Busca apoyo inmediatamente, ya sea de una red de apoyo cercana, servicios de emergencia o líneas de ayuda. No estás sola en esto y hay personas y recursos disponibles para protegerte y asistirte. Si no tuvieras un lugar seguro a dónde ir llama al 55 56 74 96 95 o 800 822 4460 Si estás en riesgo y no puedes salir de tu casa llama al 911, si el evento de violencia ya pasó y no estás lastimada, puedes encontrar ayuda en una institución especializada');
            $this->bot->typesAndWaits(5);
            $this->say('<img src="/imageneschatbot/postal4.jpeg" style="width:100%"/>');
            $this->bot->typesAndWaits(5);
            $this->say('<img src="/imageneschatbot/postal5.jpeg" style="width:100%"/>');
        }

   $this->askTepuedoApoyarConAlgoMas();
    }
//test



//Derechos sexuales y reproductivos
    public function askDerechosSexualesReproductivos(){

        $question = Question::create('Para conocer más sobre tus derechos sexuales y reproductivos, selecciona una opción de tu interés:')
            ->fallback('Edad no valida')
            ->callbackId('DerechosSexualesReproductivosid')
            ->addButtons([
                Button::create('Placer sexual')->value('Placer sexual'),
                Button::create('Consentir')->value('Consentir'),
                Button::create('Salud Sexual')->value('Salud Sexual'),
                Button::create('Anterior')->value('Anterior'),

            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Placer sexual','Consentir','Salud Sexual','Anterior'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->DerechosSexualesReproductivos = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='Placer sexual'){
                    $this->askPlacerSexual();
                }elseif($selectedValue=='Consentir'){
                    $this->askConsentir();
                }elseif($selectedValue=='Salud Sexual'){
                        $this->askSaludSexual();
                }elseif($selectedValue=='Anterior'){
                        $this->askAquiTengoUnasOpcionesParaTi();
                }

            }
        }, ['DerechosSexualesReproductivosid']);

    }
    public function askPlacerSexual(){

        $question = Question::create('Para conocer mas sobre el placer sexual, selecciona alguna de tu interés:')
            ->fallback('Edad no valida')
            ->callbackId('PlacerSexualid')
            ->addButtons([
                Button::create('¿Qué es?')->value('¿Qué es?'),
                Button::create('Derecho al placer sexual')->value('Derecho al placer sexual'),
                Button::create('El goce')->value('El goce'),
            ]);

        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['¿Qué es?', 'Derecho al placer sexual', 'El goce'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->PlacerSexual = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='¿Qué es?'){
                    $this->say('“la satisfacción y disfrute físico y psicológico derivado de experiencias eróticas compartidas o solitarias, en la que se involucran o entran en juego pensamientos, fantasías, sueños, emociones y sentimientos” (WAS, 2019).');
                    $this->askTepuedoApoyarConAlgoMas();
                }elseif($selectedValue=='Derecho al placer sexual'){
                    $this->say('Sabias que el placer sexual forma parte de los derechos sexuales considerados como derechos humanos.');
                    $this->say('<b>Derecho a:</b></br><ul>
                                <li>. Decidir de forma libre, autónoma e informada sobre nuestro cuerpo y nuestra sexualidad.</li>
                                <li>. Ejercer y disfrutar plenamente nuestra sexualidad.</li>
                                <li>. Manifestar públicamente nuestros afectos.</li>
                                <li>. Decidir libremente con quien o quienes relacionarnos afectiva, erótica y socialmente.</li>
                                <li>. Que se respete nuestra privacidad e intimidad y a que se resguarde confidencialmente nuestra información personal.</li>
                                </ul>');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->say('<b>Derecho a:</b></br>
                                  <ul>
                                    <li>. La vida, a la integridad física, psicológica y sexual.</li>
                                    <li>. Decidir de manera libre e informada sobre nuestra vida reproductiva.</li>
                                    <li>. La igualdad.</li>
                                    <li>. Vivir libres de discriminación.</li>
                                    <li>. La información actualizada, veraz, completa, científica y laica sobre sexualidad.</li>
                                    <li>. La educación integral en sexualidad.</li>
                                    <li>. Los servicios de salud sexual y reproductiva.</li>
                                    <li>. La identidad sexual.</li>
                                    <li>. La participación en las políticas públicas sobre sexualidad y reproducción.</li>
                                </ul>
                            ');
                    $this->askTepuedoApoyarConAlgoMas();
                }elseif($selectedValue=='El goce'){
                    $this->say('Todas las personas tenemos derecho al libre goce del propio cuerpo incluyendo el placer sexual. Históricamente los estereotipos y roles de género han limitado la forma en que las mujeres  experimentan y disfrutan su sexualidad. ');
                    $this->askTepuedoApoyarConAlgoMas();
                }


            }
        }, ['PlacerSexualid']);

    }
    public function askConsentir(){
            $this->say('Consiste en establecer tus límites personales y respetar los de las personas con las que te relacionas. Cada persona tiene límites distintos y todo el mundo merece que sean respetados.Consentir se acompaña de los siguientes puntos:');
            $this->say('
                    El consentimiento tiene las siguientes características:</br></br>
                    <b>Se da libremente.</b> Consentir es una opción que tomas sin presión, sin manipulación o sin la influencia de las drogas o el alcohol.</br>
                    <b>Es deseado.</b> Cuando se trata de sexo, debes hacer las cosas que DESEAS hacer, no lo que otras personas esperan que hagas.</br>
                    <b>Es específico.</b> Decir que sí a algo (como ir a besarse al dormitorio) no significa que aceptes hacer otras cosas (como tener relaciones sexuales).</br>
                    <b>Se brinda estando informada.</b> Solo puedes consentir algo si tienes toda la información al respecto. Por ejemplo, si alguien dice que usará un condón y luego no lo hace, no hubo consentimiento total.</br>
                    <b>Es reversible.</b> Todos pueden cambiar de parecer sobre lo que desean hacer, en cualquier momento. Incluso si ya lo hicieron antes y ambos están desnudos en la cama.</br></br>
                    Tú tienes la última palabra sobre lo que pasa con tu cuerpo. No importa si ya lo hicieron o incluso si dijiste que sí antes y luego cambiaste de parecer. Tienes derecho a decir “basta” en cualquier momento, y tu pareja debe respetarlo.</br>
            ');
            $this->askTepuedoApoyarConAlgoMas();

        }
    public function askSaludSexual(){
        $question = Question::create('Para conocer mas sobre la salud sexual, selecciona alguna de tu interés:')
            ->fallback('Edad no valida')
            ->callbackId('SaludSexualid')
            ->addButtons([
                Button::create('¿Qué es?')->value('¿Qué es?'),
                Button::create('Problemas relacionados con la Salud sexual')->value('Consentir'),
                Button::create('A tomar en cuenta para posibilitar la salud sexual')->value('A tomar en cuenta para posibilitar la salud sexual'),
            ]);

        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['¿Qué es?', 'Problemas relacionados con la Salud sexual', 'A tomar en cuenta para posibilitar la salud sexual'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->SaludSexual = $selectedValue;
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);
                if($selectedValue=='¿Qué es?'){
                    $this->say('«...un estado de bienestar físico, mental y social en relación con la sexualidad, la cual no es la ausencia de enfermedad, disfunción o incapacidad. La salud sexual requiere un enfoque positivo y respetuoso de la sexualidad y de las relaciones sexuales, así como la posibilidad de tener experiencias sexuales placenteras y seguras, libres de toda coacción, discriminación y violencia. Para que la salud sexual se logre y se mantenga, los derechos sexuales de todas las personas deben ser respetados, protegidos y ejercidos a plenitud.»(OMS, 2006a)');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);
                    $this->askTepuedoApoyarConAlgoMas();
                }elseif($selectedValue=='Problemas relacionados con la Salud sexual'){
                    $this->say('
                       1. infecciones con el virus de la inmunodeficiencia humana (VIH), infecciones de transmisión sexual y del aparato reproductor, así como sus consecuencias adversas (por ejemplo, cáncer e infertilidad);</br> 
                        Te comparto los nombres de algunos estudios que permiten identificar y prevenir:</br>
                                <ul>
                                <li>. Pruebas inmunológicas para detectar VIH, VPH o Hepatitis B y C.</li>
                                <li>. Colposcopia</li>
                                <li>. Papanicolau </li>
                                <li>. Mastografía </li>
                                </ul> 
                       2. embarazos no deseados y abortos;</br>
                       3. disfunción sexual; La detección y el manejo de las disfunciones sexuales son componentes esenciales de la atención a la salud sexual. La orientación psicosexual proporciona a los pacientes apoyo e información u orientación específica relacionada con sus problemas sexuales, lo cual puede ayudar a que recuperen una actividad sexual satisfactoria.</br>
                       4. violencia sexual; </br>
                       5. prácticas nocivas (entre ellas la mutilación genital femenina).</br>
    
                    ');
                    $this->askTepuedoApoyarConAlgoMas();

                }elseif($selectedValue=='A tomar en cuenta para posibilitar la salud sexual'){
                    $this->say('Acceso a información integral de buena calidad sobre sexo y sexualidad; conocimiento de los riesgos que pueden correr y su vulnerabilidad ante las consecuencias adversas de la actividad sexual sin protección; posibilidad de acceder a la atención de salud sexual; residencia en un entorno que afirme y promueva la salud sexual.');
                    $this->askTepuedoApoyarConAlgoMas();
                }


            }
        }, ['SaludSexualid']);



    }
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
                        $this->askCompartemeTusSugerenciasPropuestas();

                    }



                }
            }, ['AntesQueTeVayasMeGustariaConversacionResultoUtilid']);
        }
    public function askRecomendariasGuetzaPersonasConoces(): void
    {
        $question = Question::create('¿Recomendarías Orejitas a las personas que conoces? ')
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
    public function askCompartemeTusSugerenciasPropuestas():void
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
    public function askTepuedoApoyarConAlgoMas(): void
    {
        $question = Question::create('¿Te puedo apoyar con algo más?')
            ->fallback('Edad no valida')
            ->callbackId('TepuedoApoyarAlgoMasid')
            ->addButtons([
                Button::create('Más opciones')->value('Más opciones'),
                Button::create('Terminar')->value('Terminar'),
            ]);
        $this->ask($question, function (Answer $answer) {
            $selectedValue = $answer->getValue();
            if (!in_array($selectedValue, ['Más opciones', 'Terminar'])) {
                $this->say("Haz click en un opcion valida");
                $this->repeat();
            } else {
                $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                $this->bot->typesAndWaits($this->tiempoRespuesta);

                if($selectedValue=='Más opciones'){
                    $this->askAquiTengoUnasOpcionesParaTi();
                }elseif($selectedValue=='Terminar'){
                        $this->askAntesQueTeVayasMeGustariaConversacionResultoUtil();
                }



            }
        }, ['TepuedoApoyarAlgoMasid']);
    }
    public function askQuieroExplorarMas(): void
        {
            $question = Question::create('¿Quieres explorar más las opciones que tengo para ti?')
                ->fallback('Edad no valida')
                ->callbackId('TepuedoApoyarAlgoMasid')
                ->addButtons([
                    Button::create('Más opciones')->value('Más opciones'),
                    Button::create('Terminar')->value('Terminar'),
                ]);
            $this->ask($question, function (Answer $answer) {
                $selectedValue = $answer->getValue();
                if (!in_array($selectedValue, ['Más opciones', 'Terminar'])) {
                    $this->say("Haz click en un opcion valida");
                    $this->repeat();
                } else {
                    $this->say('<div class="response-right">'.  $answer->getText().'</div>');
                    $this->bot->typesAndWaits($this->tiempoRespuesta);

                    if($selectedValue=='Más opciones'){
                        $this->askQuieresSaberSituacionRiesgo();
                    }elseif($selectedValue=='Terminar'){
                            $this->askAntesQueTeVayasMeGustariaConversacionResultoUtil();
                    }



                }
            }, ['TepuedoApoyarAlgoMasid']);
        }


    public function stopsConversation(IncomingMessage $message):bool
    {
        if (  in_array($message->getText(),['hola','ola','Hola','HOLA','Ola','hOla','HOla'])) {
            return true;
        }

        return false;
    }

}







