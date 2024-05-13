<?php

namespace App\Models;

use Illuminate\Database\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Evaluacion extends Model
{
//    use HasFactory;

    protected $table = 'e9evaluacion';

    protected $fillable=[
                            'id', 
                            'odescripcion', 
                            'oseccion', 
                            'onumpregunta', 
                            'oanio', 
                            'oetapa',
                        ];

    public function evaluacion() {
        return $this->belongsTo(Evaluacion::class);
    }

}
