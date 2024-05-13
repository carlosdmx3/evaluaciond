<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class EvaluacionDocente extends Model
{
    protected $table = 'e9docente_evaluacion';


    protected $fillable=[
                        'id','id_alumno_usr','id_docente','oban_fin',
                        'op1','op2','op3','op4','op5','op6','op7','op8','op9','op10',
                        'op11','op12','op13','op14','op15','op16','op17','op18','op19','op20',
                        'op21','op22','op23','op24','op25','op26','op27','op28','op29','op30',
                        'op31','op32','op33','op34','op35', 'status', 'oanio', 'oetapa',
                        ];

    public function docente_eval() {
        return $this->belongsTo(Evaluacion::class);
    }

    public function alumnodoc() {
        return $this->belongsTo(AlumnoDocente::class, 'id', 'id_docente');
    }

}
