<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id')->unique();
            $table->string('genero')->nullable();
            $table->integer('edad')->nullable();
            $table->string('estado_republica')->nullable();
            $table->String('SiEstasAcompanadoMujerEllaTuEncuentranRiesgo')->nullable();
            $table->String('orientacionNecesitas',10)->nullable();
            $table->String('QuieresSaberSituacionRiesgo',10)->nullable();
            $table->String('QuieresSabernecesitarServicioEmergencia',10)->nullable();

            $table->String('AquiTengoOpcionesParaTi',10)->nullable();
            $table->String('AlgunaVezHanEmpujadoGolpeadoAgreFisicamente',10)->nullable();
            $table->String('HasSentidoMiedoSobreTuSeguridad',10)->nullable();
            $table->String('HasTenidoLesionesFisicas',10)->nullable();
            $table->String('TuParejaFamiliarAlguienCercanoObligadoEnganadoConsumas',10)->nullable();
            $table->String('AlguienCercanoCriticaMenospreciaBurla',10)->nullable();
            $table->String('SientesAlguienTuVidaLimitaTusDesiciones',10)->nullable();
            $table->String('TeHanExcluidoDeliberadamenteDeActividades',10)->nullable();
            $table->String('SientesMiedoAnsiedadConstante',10)->nullable();
//->nullable();
            $table->String('AlguienPresionadoParticiparActividadesSexuales',10)->nullable();
            $table->String('HasAccedidoRealizarActivadesSexuales',10)->nullable();
            $table->String('AlguienUtilizadoDrogasIncapacitarte',10)->nullable();
            $table->String('HasTenidoActividadesSexualesSinConsentimiento',10)->nullable();
            //patrimonial->nullable();
            $table->String('HasExperimentadoPresionFirmarContraVoluntad',10)->nullable();
            $table->String('AlguienDestruidoIntencionalmenteBienesMateriales',10)->nullable();
            $table->String('TeHanImpedidoTrabajarOEstudiarLimitar',10)->nullable();
            $table->String('AlgunaPersonaCercanaUtilizadoBienesSinConsentimiento',10)->nullable();
            //economica->nullable();
            $table->String('HasExperimentadoPresionAsumirDeudasCompromisos',10)->nullable();
            $table->String('AlguienCercanoATiControlaTusIngresos',10)->nullable();
            $table->String('TeHanNegadoRecursosEconomicos',10)->nullable();
            $table->String('TeHanImpedidoTrabajarOEstudiarLimitarFinanciera',10)->nullable();
// vicaria->nullable();
            $table->String('TeSientesPresionadaActuarPerderContactoHijos',10)->nullable();
            $table->String('TuParejaExparejaImpedidoComuniquesHijasHijos',10)->nullable();
            $table->String('HasNotadoTuParejaUtilizaHijasHijos',10)->nullable();
            $table->String('TeSientesExcluidaDecisionesImportantesHijasHijos',10)->nullable();
            $table->String('TeGustariaResponderAlgunasPreguntasViolenciaDigital',10)->nullable();
            $table->String('HasRecibidoAmenazasATravezMensajesRedesCorreo',10)->nullable();
            $table->String('AlguienHaDifundidoInformacionFalsaLinea',10)->nullable();
            $table->String('HasExperimentadoRoboIdentidadLineaSuplantacion',10)->nullable();
            $table->String('TeHanPresionadoEnviarFotosIntimasInformacionPersonal',10)->nullable();
            $table->String('PlanesDeAccionProteccionSituacionViolencia',10)->nullable();
            //sexual->nullable();
            $table->String('EnEventoViolenciaSexualHuboExposicionRiesgo',10)->nullable();
            $table->String('SucedioInmediato',10)->nullable();
            $table->String('TengoMasInformacionSepasHAcerDespuesEvento',10)->nullable();
            //fisica->nullable();
            $table->String('AquiTemuestroPlanesAccionFisica',10)->nullable();
            $table->String('SiyaIdentificasteSituacionPeligro',10)->nullable();
            $table->String('TeMuestroMasAccionesViolenciaFisica',10)->nullable();
            $table->String('DebesSaberTienesDerechoSobreDerechoSexuales',10)->nullable();
            $table->String('TiposdeAborto',10)->nullable();
            $table->String('MasInformacionAbortoDilatacion',10)->nullable();
            $table->String('ServiciosInterrupcionEmbarazo',10)->nullable();
//Orientación psicológica->nullable();
            $table->String('TePuedoAcompanarAlgunasPreguntasIden',10)->nullable();
            //Empoderamiento->nullable();
            $table->String('SientesFaltaConfianzaMisma',10)->nullable();
            $table->String('TecuestaExpresarOpinionesDeseos',10)->nullable();
            $table->String('ParaTomarDecisionesSiempreBuscasOpinion',10)->nullable();
            $table->String('TeEsFacilIdentificarProblematicas',10)->nullable();
            $table->String('HasIdentificadoAcompananFrecuentemente',10)->nullable();
            //Autocuidado->nullable();
            $table->String('RealizasActividadesActivarMente',10)->nullable();
            $table->String('PonesLimitesSabesDecirNo',10)->nullable();
            $table->String('ExpresasEnfadoTristeza',10)->nullable();
            $table->String('PermitesDisfrutarSalirAmistades',10)->nullable();
            $table->String('HacesPequenasDescansosDia',10)->nullable();
            //En tus Relaciones->nullable();
            $table->String('HasIdentificadoTienenControlTi',10)->nullable();
            $table->String('TefaltaApoyoEmocinalNecesario',10)->nullable();
            $table->String('EscuchasCriticasConstantes',10)->nullable();
            $table->String('HasIdentificoUtilizadoTacticasManipuladoras',10)->nullable();
            $table->String('HasIdentificoAlgunasRelacionesAnsiedad',10)->nullable();
            //Igualdad de oportunidades y el reconocimiento del valor individual->nullable();
            $table->String('LasTareasFinanzasResponsabilidadesEstanDistribuidas',10)->nullable();
            $table->String('TusOpinionesDeseosNecesidadesTomadoCuenta',10)->nullable();
            $table->String('SeAplicanDifereneEstandaresComportamiento',10)->nullable();
            $table->String('NoPuedoExpresarmeFormaLibre',10)->nullable();
// Me comuniqué con anterioridad y necesito atención.->nullable();
            $table->String('AnteriormenteTeBrindeInformacionRequerias',10)->nullable();
            $table->String('CompartemeSugerenciasPropuestas',10)->nullable();
            $table->String('HeSeleccionadAlgunasAtencionesPuedesRecibirAtravesOrganizaciones',10)->nullable();
            $table->String('SiTeInteresaConocerSobreProgramasSo',10)->nullable();
            $table->String('Programa',10)->nullable();
            $table->String('Tramite',10)->nullable();
            //Información adicional->nullable();
            $table->String('AlgunasOpcionesPonerDenunciaPorViolencia',10)->nullable();
            $table->String('QuieresSaberQueConsiste',10)->nullable();
            $table->String('LaViolenciaPresentaDiferentesAmbitos',10)->nullable();
            $table->String('TanProntoComoSeaSeguroHacerlo',10)->nullable();
            $table->String('AlgunasOpcionesInformacionAdicional',10)->nullable();
            $table->String('AlgunaOpcionesOrientacionJuridica',10)->nullable();
            $table->String('QuieresSaberSolicitarOrdenProteccion',10)->nullable();
            //Test->nullable();
            $table->String('ResultadoTest',10)->nullable();
            $table->String('CuandoDirigeTeLlamaApodoDesagrdeTest',10)->nullable();
            $table->String('TeDiceQueEstasConAlguienMasTest',10)->nullable();
            $table->String('TeHaInterrumpidoEnSituacionesLaboralesTest',10)->nullable();
            $table->String('TeDicenTieneOtrasParejasTest',10)->nullable();
            $table->String('TodoTiempoQuiereSaberDondeEstasTest',10)->nullable();
            $table->String('TeCriticaBurlaCUerpoErroresTest',10)->nullable();
            $table->String('TeHaPedidoCambiesFormaVestirTest',10)->nullable();
            $table->String('CuandoEstasConEsaPersonaTensionTest',10)->nullable();
            $table->String('HaRevisadoCelularLlamadasMensajesTest',10)->nullable();
            $table->String('ParaDecidirLoHaranCuandoSalenTest',10)->nullable();
            $table->String('HaInterferidoRelacionesConversacionesInternetTest',10)->nullable();
            $table->String('CuandoHablanTesientesMalHablaSexoTest',10)->nullable();
            $table->String('HaHechoUsoDineroTusAhorrosTest',10)->nullable();
            $table->String('SientesConstantementeEstaControlandoTest',10)->nullable();
            $table->String('TeHaLimitadoControladoGastosCubrirTest',10)->nullable();
            $table->String('HasEscondidoDestruidoTusDocumentosTest',10)->nullable();
            $table->String('SiHasCedidoDeseosSexualesTest',10)->nullable();
            $table->String('SiTienenRelacionesSexualesTeImpideUsoMetodoAntiTest',10)->nullable();
            $table->String('TeHaObligadoVerPornografiaTest',10)->nullable();
            $table->String('HaDifundidoInformacionImagenesEnviadoTest',10)->nullable();
            $table->String('TeHaPrecionadoObligadoConsumirDrogaTest',10)->nullable();
            $table->String('SiTomaAlcoholConsumeAlgunTipoDrogaTest',10)->nullable();
            $table->String('TienesRendirleCuentasTodoTest',10)->nullable();
            $table->String('ACausaProblemasTienesPerdidaApetitoTest',10)->nullable();
            $table->String('CuandoSeEnojaDiscutenTest',10)->nullable();
            $table->String('TeHaGolpeadoAlgunaParteCuerpoTest',10)->nullable();
            $table->String('TeHaObligadoPresionadoEnviarImagenesIntimasTest',10)->nullable();
            $table->String('TehaCausadoLesionesAmeritenRecibirAtencionMedicaTest',10)->nullable();
            $table->String('TeHaAmenazadoConMatarteCuandoQuieresTerminarTest',10)->nullable();
            $table->String('TeHaExigidoDemuestresDondeEstaTuGeoTest',10)->nullable();
            $table->String('DespuesDisculpasMuestraCArinoAtencionTest',10)->nullable();
            $table->String('SeHaEnfadadoPorNoTenerUnaRespuestaInmediantaTest',10)->nullable();
            //Amor Propio->nullable();
            $table->String('PuedesIrMedicoSolaAunqueSeaEnfermaGrave',10)->nullable();
            $table->String('CreesNoTienesMuchoSentirteOrgullosa',10)->nullable();
            $table->String('SiTienesPasarFinSemanaSola',10)->nullable();
            $table->String('GeneralmenteDasMasValorOpinaTuPareja',10)->nullable();
            $table->String('CuandoTienesTomarDecisionImportanteNoHacerlo',10)->nullable();
            //Derechos sexuales y reproductivos->nullable();
            $table->String('DerechosSexualesReproductivos',10)->nullable();
            $table->String('PlacerSexual',10)->nullable();
            //terminar->nullable();
            $table->String('AntesQueTeVayasMeGustariaConversacionResultoUtil',10)->nullable();
            $table->String('CompartemeTusSugerenciasPropuestas',10)->nullable();
            $table->String('RecomendariasGuetzaPersonasConoces',10)->nullable();
            $table->String('ConsiderasInformacionBrindadaPuedesIntegrarDiaADia',10)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};


