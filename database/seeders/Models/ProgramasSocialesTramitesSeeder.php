<?php
namespace Database\Seeders\Models;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramasSocialesTramitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Command :
         * artisan seed:generate --model-mode --models=Programas_Sociales_Tramites
         *
         */

        
        $newData0 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 1,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Pensión',
            'Dirigida_A' => 'Adultas Mayores',
            'Nombre' => 'Pensión para el bienestar de las personas adultas mayores',
            'Link' => 'https://programasparaelbienestar.gob.mx/pensi',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData1 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 2,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Cultivo',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Sembrando vida',
            'Link' => 'https://programasparaelbienestar.gob.mx/sembr',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData2 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 3,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Apoyo economico',
            'Dirigida_A' => 'Adolescentes',
            'Nombre' => 'Jóvenes construyendo el futuro',
            'Link' => 'https://programasparaelbienestar.gob.mx/joven',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData3 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 4,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Educación',
            'Dirigida_A' => 'Niñas, niños y adolescentes',
            'Nombre' => 'Beca para el bienestar Benito Juárez de Educación básica',
            'Link' => 'https://programasparaelbienestar.gob.mx/beca-',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData4 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 5,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Educación',
            'Dirigida_A' => 'Adolescentes',
            'Nombre' => 'Beca para el bienestar Benito Juárez de Educación Media Superior',
            'Link' => 'https://programasparaelbienestar.gob.mx/becas',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData5 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 6,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Educación',
            'Dirigida_A' => 'Adolescentes',
            'Nombre' => 'Beca para el bienestar Benito Juárez de Educación Media Superior',
            'Link' => 'https://programasparaelbienestar.gob.mx/beca-',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData6 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 7,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Pensión',
            'Dirigida_A' => 'Personas con discapacidad',
            'Nombre' => 'Pensión para el bienestar de las personas con discapacidad ',
            'Link' => 'https://programasparaelbienestar.gob.mx/pensi',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData7 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 8,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Apoyo economico',
            'Dirigida_A' => 'Niñas y niños ',
            'Nombre' => 'Programa para el bienestar de niñas y niños hijos de madres trabajadoras',
            'Link' => 'https://programasparaelbienestar.gob.mx/progr',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData8 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 9,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Cultivo',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Producción para el bienestar',
            'Link' => 'https://programasparaelbienestar.gob.mx/produ',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData9 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 10,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Cultivo',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Bienpesca',
            'Link' => 'https://programasparaelbienestar.gob.mx/bienp',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData10 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 11,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Cultivo',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Fertilizantes para el bienestar',
            'Link' => 'https://programasparaelbienestar.gob.mx/ferti',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData11 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 12,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Vivienda',
            'Dirigida_A' => 'Vivienda',
            'Nombre' => 'Por una mejor vivienda',
            'Link' => 'https://programasparaelbienestar.gob.mx/por-u',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData12 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 13,
            'Tipo' => 'Programa',
            'Caracteristicas' => 'Cultivo',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Precios de garantía ',
            'Link' => 'https://programasparaelbienestar.gob.mx/preci',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData13 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 14,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Identificación',
            'Dirigida_A' => 'Toda persona interesada',
            'Nombre' => 'Consulta CURP',
            'Link' => 'https://www.gob.mx/curp/ ',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData14 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 15,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Identificación',
            'Dirigida_A' => 'Toda persona interesada',
            'Nombre' => 'Acta de Nacimiento (con validez oficial, se requiere CURP, costo depende del estado]',
            'Link' => 'https://www.gob.mx/ActaNacimiento/',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData15 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 16,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Finanzas personales',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Cotizar mi información de Infonavit y puntos (Requiere Número de Seguro Social y Fecha de nacimiento]',
            'Link' => 'http://portal.infonavit.org.mx/wps/wcm/connec',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData16 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 17,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Finanzas personales',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Servicios de Infonavit (Saldo, Info del crédito si tienes. Requiere NSS, RFC, CURP]',
            'Link' => 'https://micuenta.infonavit.org.mx/wps/portal/',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData17 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 18,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Educación',
            'Dirigida_A' => 'Toda persona interesada',
            'Nombre' => 'Consulta Cedula Profesional',
            'Link' => 'https://www.cedulaprofesional.sep.gob.mx/cedu',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData18 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 19,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Seguridad Social',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Consulta tu Número de Seguro Social NSS',
            'Link' => 'https://serviciosdigitales.imss.gob.mx/gestio',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData19 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 20,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Seguridad Social',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Consulta Semanas Cotizadas en el IMSS (con NSS & CURP]',
            'Link' => 'https://serviciosdigitales.imss.gob.mx/semana',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData20 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 21,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Seguridad Social',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Consulta Vigencia de Derechos IMSS',
            'Link' => 'https://serviciosdigitales.imss.gob.mx/gestio',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData21 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 22,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Seguridad Social',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Consulta la Clínica IMSS que te corresponde es con la app móvil',
            'Link' => 'http://www.imss.gob.mx/apps ',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData22 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 23,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Finanzas personales',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Consulta de Buro de Crédito (TIENE USTED DERECHO A UN REPOTE GRATIS POR AÑO!!]',
            'Link' => 'https://www.burodecredito.com.mx/reporte-info',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData23 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 24,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Finanzas personales',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Consulta en que AFORE estas registrado',
            'Link' => 'https://www.consar.gob.mx/wsafore/',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData24 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 25,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Identificación',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Cita INE (para tramitar la credencial para votar]',
            'Link' => 'https://app-inter.ife.org.mx/siac2011/citas_i',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData25 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 26,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Identificación',
            'Dirigida_A' => 'Toda persona interesada',
            'Nombre' => 'Cita SRE (para tramitar el pasaporte]',
            'Link' => 'https://citas.sre.gob.mx/citas.webportal/page',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData26 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 27,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Finanzas personales',
            'Dirigida_A' => 'Toda persona interesada',
            'Nombre' => 'Cita SAT (para alta RFC, Firma electronica]',
            'Link' => 'https://citas.sat.gob.mx/citasat/home.aspx',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData27 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 28,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Finanzas personales',
            'Dirigida_A' => 'Toda persona interesada',
            'Nombre' => 'Pago de la Luz en Línea',
            'Link' => 'https://app.cfe.mx/Aplicaciones/CCFE/Recibos/',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData28 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 29,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Identificación',
            'Dirigida_A' => 'Adultas Mayores',
            'Nombre' => 'Expedición de credencial del INAPAM ',
            'Link' => 'https://www.gob.mx/tramites/ficha/expedicion-',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData29 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 30,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Identificación',
            'Dirigida_A' => 'Toda persona interesada',
            'Nombre' => 'Migración, Visas y Estancias en México  ',
            'Link' => 'https://www.gob.mx/tramites/identidad',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData30 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 31,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Identificación',
            'Dirigida_A' => 'Toda persona interesada',
            'Nombre' => 'Pasaporte mayores y menores de edad ',
            'Link' => 'https://www.gob.mx/tramites/identidad ',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData31 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 32,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Educación',
            'Dirigida_A' => 'Toda persona interesada',
            'Nombre' => 'Capacitación y Cursos  ',
            'Link' => 'https://www.gob.mx/tramites/ficha/inscripcion',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData32 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 33,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Seguridad Social',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Afiliación para incorporarse al seguro para jefas de familia',
            'Link' => 'https://www.gob.mx/tramites/ficha/afiliacion-',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData33 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 34,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Educación',
            'Dirigida_A' => 'Niñas, niños y adolescentes',
            'Nombre' => 'Clases para niñas, niños y adolescentes ',
            'Link' => 'https://aprendeencasa.sep.gob.mx',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData34 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 35,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Juridíco',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'PROFEDET –ASESORIA LEGAL EN PROBLEMAS LABORALES- ',
            'Link' => 'https://www.gob.mx/tramites/ficha/centro-de-o',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
        $newData35 = \App\Models\Programas_Sociales_Tramites::create([
            'id' => 36,
            'Tipo' => 'Tramites y Consultas',
            'Caracteristicas' => 'Empleo',
            'Dirigida_A' => 'Mas de 18 años',
            'Nombre' => 'Solicitud de apoyos para encontrar empleo en la STPS  ',
            'Link' => 'https://www.gob.mx/tramites/ficha/solicitud-d',
            'Vigencia' => NULL,
            'Estatus' => 1,
            'created_at' => NULL,
            'updated_at' => NULL,
        ]);
    }
}