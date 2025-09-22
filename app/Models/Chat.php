<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['chat_id',
        'genero',
        'edad',
        'estado_republica',
        'SiEstasAcompanadoMujerEllaTuEncuentranRie',
        'orientacionNecesitas',
        'QuieresSaberSituacionRiesgo',
        'QuieresSabernecesitarServicioEmergencia',
        'AquiTengoOpcionesParaTi',
        'AlgunaVezHanEmpujadoGolpeadoAgreFisicamente',
        'HasSentidoMiedoSobreTuSeguridad',
        'HasTenidoLesionesFisicas',
        'TuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas',
        'AlguienCercanoCriticaMenospreciaBurla',
        'SientesAlguienTuVidaLimitaTusDesiciones',
        'TeHanExcluidoDeliberadamenteDeActividades',
        'SientesMiedoAnsiedadConstante',
//
        'AlguienPresionadoParticiparActividadesSexuales',
        'HasAccedidoRealizarActivadesSexuales',
        'AlguienUtilizadoDrogasIncapacitarte',
        'HasTenidoActividadesSexualesSinConsentimiento',
//
        //patrimonial
        'HasExperimentadoPresionFirmarContraVoluntad',
        'AlguienDestruidoIntencionalmenteBienesMateriales',
        'TeHanImpedidoTrabajarOEstudiarLimitar',
        'AlgunaPersonaCercanaUtilizadoBienesSinConsentimiento',
//
        //economica
        'HasExperimentadoPresionAsumirDeudasCompromisos',
        'AlguienCercanoATiControlaTusIngresos',
        'TeHanNegadoRecursosEconomicos',
        'TeHanImpedidoTrabajarOEstudiarLimitarFinanciera',
// vicaria
        'TeSientesPresionadaActuarPerderContactoHijos',
        'TuParejaExparejaImpedidoComuniquesHijasHijos',
        'HasNotadoTuParejaUtilizaHijasHijos',
        'TeSientesExcluidaDecisionesImportantesHijasHijos',
//
        'TeGustariaResponderAlgunasPreguntasViolenciaDigital',
        'HasRecibidoAmenazasATravezMensajesRedesCorreo',
        'AlguienHaDifundidoInformacionFalsaLinea',
        'HasExperimentadoRoboIdentidadLineaSuplantacion',
        'TeHanPresionadoEnviarFotosIntimasInformacionPersonal',

//


        'PlanesDeAccionProteccionSituacionViolencia',
        //sexual
        'EnEventoViolenciaSexualHuboExposicionRiesgo',
        'SucedioInmediato',
        'TengoMasInformacionSepasHAcerDespuesEvento',
        //fisica
        'AquiTemuestroPlanesAccionFisica',
        'SiyaIdentificasteSituacionPeligro',
        'TeMuestroMasAccionesViolenciaFisica',


        'DebesSaberTienesDerechoSobreDerechoSexuales',
        'TiposdeAborto',
        'MasInformacionAbortoDilatacion',
        'ServiciosInterrupcionEmbarazo',


//Orientación psicológica
        'TePuedoAcompanarAlgunasPreguntasIden',
        //Empoderamiento
        'SientesFaltaConfianzaMisma',
        'TecuestaExpresarOpinionesDeseos',
        'ParaTomarDecisionesSiempreBuscasOpinion',
        'TeEsFacilIdentificarProblematicas',
        'HasIdentificadoAcompananFrecuentemente',

        //Autocuidado
        'RealizasActividadesActivarMente',
        'PonesLimitesSabesDecirNo',
        'ExpresasEnfadoTristeza',
        'PermitesDisfrutarSalirAmistades',
        'HacesPequenasDescansosDia',

        //En tus Relaciones
        'HasIdentificadoTienenControlTi',
        'TefaltaApoyoEmocinalNecesario',
        'EscuchasCriticasConstantes',
        'HasIdentificoUtilizadoTacticasManipuladoras',
        'HasIdentificoAlgunasRelacionesAnsiedad',

        //Igualdad de oportunidades y el reconocimiento del valor individual
        'LasTareasFinanzasResponsabilidadesEstanDistribuidas',
        'TusOpinionesDeseosNecesidadesTomadoCuenta',
        'SeAplicanDifereneEstandaresComportamiento',
        'NoPuedoExpresarmeFormaLibre',


// Me comuniqué con anterioridad y necesito atención.
        'AnteriormenteTeBrindeInformacionRequerias',
        'CompartemeSugerenciasPropuestas',
        'HeSeleccionadAlgunasAtencionesPuedesRecibirAtravesOrganizaciones',
        'SiTeInteresaConocerSobreProgramasSo',
        'Programa',
        'Tramite',

        //Información adicional
        'AlgunasOpcionesPonerDenunciaPorViolencia',
        'QuieresSaberQueConsiste',
        'LaViolenciaPresentaDiferentesAmbitos',
        'TanProntoComoSeaSeguroHacerlo',
        'AlgunasOpcionesInformacionAdicional',

        'AlgunaOpcionesOrientacionJuridica',
        'QuieresSaberSolicitarOrdenProteccion',


        //Test
        'ResultadoTest',
        'CuandoDirigeTeLlamaApodoDesagrdeTest',
        'TeDiceQueEstasConAlguienMasTest',
        'TeHaInterrumpidoEnSituacionesLaboralesTest',
        'TeDicenTieneOtrasParejasTest',
        'TodoTiempoQuiereSaberDondeEstasTest',
        'TeCriticaBurlaCUerpoErroresTest',
        'TeHaPedidoCambiesFormaVestirTest',
        'CuandoEstasConEsaPersonaTensionTest',
        'HaRevisadoCelularLlamadasMensajesTest',
        'ParaDecidirLoHaranCuandoSalenTest',
        'HaInterferidoRelacionesConversacionesInternetTest',
        'CuandoHablanTesientesMalHablaSexoTest',
        'HaHechoUsoDineroTusAhorrosTest',
        'SientesConstantementeEstaControlandoTest',
        'TeHaLimitadoControladoGastosCubrirTest',
        'HasEscondidoDestruidoTusDocumentosTest',
        'SiHasCedidoDeseosSexualesTest',
        'SiTienenRelacionesSexualesTeImpideUsoMetodoAntiTest',
        'TeHaObligadoVerPornografiaTest',
        'HaDifundidoInformacionImagenesEnviadoTest',
        'TeHaPrecionadoObligadoConsumirDrogaTest',
        'SiTomaAlcoholConsumeAlgunTipoDrogaTest',
        'TienesRendirleCuentasTodoTest',
        'ACausaProblemasTienesPerdidaApetitoTest',
        'CuandoSeEnojaDiscutenTest',
        'TeHaGolpeadoAlgunaParteCuerpoTest',
        'TeHaObligadoPresionadoEnviarImagenesIntimasTest',
        'TehaCausadoLesionesAmeritenRecibirAtencionMedicaTest',
        'TeHaAmenazadoConMatarteCuandoQuieresTerminarTest',
        'TeHaExigidoDemuestresDondeEstaTuGeoTest',
        'DespuesDisculpasMuestraCArinoAtencionTest',
        'SeHaEnfadadoPorNoTenerUnaRespuestaInmediantaTest',

        //Amor Propio
        'PuedesIrMedicoSolaAunqueSeaEnfermaGrave',
        'CreesNoTienesMuchoSentirteOrgullosa',
        'SiTienesPasarFinSemanaSola',
        'GeneralmenteDasMasValorOpinaTuPareja',
        'CuandoTienesTomarDecisionImportanteNoHacerlo',

        //Derechos sexuales y reproductivos
        'DerechosSexualesReproductivos',
        'PlacerSexual',

        //terminar
        'AntesQueTeVayasMeGustariaConversacionResultoUtil',
        'CompartemeTusSugerenciasPropuestas',
        'RecomendariasGuetzaPersonasConoces',
        'ConsiderasInformacionBrindadaPuedesIntegrarDiaADia',
    ];





}
