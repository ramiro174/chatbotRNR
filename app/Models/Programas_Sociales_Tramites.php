<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programas_Sociales_Tramites extends Model
{
    use HasFactory;
    protected  $table = 'Programas_Sociales_Tramites';
    protected $fillable = ['Tipo','Caracteristicas','Dirigida_A','Nombre','Link','Vigencia','Estatus'];


    public function scopeCaracteristica (Builder $query,string $Caracteristicas): void
    {
        $query->where('Caracteristicas', $Caracteristicas);
    }
    public function scopeTipo (Builder $query,string $Tipo): void
    {
        $query->where('Tipo', $Tipo);
    }



}
