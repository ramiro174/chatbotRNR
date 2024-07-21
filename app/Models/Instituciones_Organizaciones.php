<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituciones_Organizaciones extends Model
{
    use HasFactory;
    protected  $table = 'Instituciones_Organizaciones';
    protected $fillable = ['Institucion_Organizacion', 'Estado', 'Municipio', 'Dias_de_atencion', 'Horario', 'Clasificacion', 'Otra', 'Psicologica', 'Legal', 'Medica', 'Social', 'Refiere_a_Refugio', 'Digital', 'Caracteristica', 'Telefono', 'Email', 'Pagina_web', 'Whats_APP', 'Facebook', 'Instagram', 'Twitter', 'Mujer', 'Edad_Mini_Mu', 'Edad_M_Mu', 'Hombre', 'Edad_Mini_Ho', 'Edad_M_Ho', 'Otras_identidades', 'Edad_Mini', 'Edad_M', 'Mensaje', 'Estatus'];


    public function scopeEstadoRepublica (Builder $query,string $estado): void
    {
        $query->where('Estado', 'Like','%'. $estado.'%')->OrWhere('Estado','Nacional');
    }

    public function scopeMujer (Builder $query): void
    {
        $query->where('Mujer', 1);
    }
    public function scopeHombre (Builder $query): void
    {
        $query->where('Hombre', 1);
    }
    public function scopeOtras_identidades (Builder $query): void
    {
        $query->where('Otras_identidades', 1);
    }

    public function scopeIdentidad (Builder $query, string $identidad): void
    {
        if($identidad=="Mujer"){
            $query->where('Mujer', 1);
        }elseif ($identidad=="Hombre"){
            $query->where('Hombre', 1);
        }elseif($identidad=="Otras_identidades"){
            $query->where('Otras_identidades', 1);
        }

    }



    public function scopeEdadMenorMujer (Builder $query,int $edadmenor): void
    {
        $query->where('Edad_M_Mu', ">=", $edadmenor);
    }
    public function scopeEdadMenorHombre (Builder $query,int $edadmenor): void
    {
        $query->where('Edad_M_Ho', ">=", $edadmenor);
    }
    public function scopeClasificacionEmergencia (Builder $query): void
    {
        $query->where('Clasificacion', 'Emergencia');
    }
    public function scopeClasificacionNo (Builder $query,$ClasificacionNo): void
    {
        $query->whereNotIn('Clasificacion', $ClasificacionNo);
    }
    public function scopeClasificaciones (Builder $query,$ClasificacionNo): void
    {
        $query->whereIn('Clasificacion', $ClasificacionNo);
    }


}
