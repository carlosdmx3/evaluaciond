<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AlumnoDocente extends Model
{
     use HasFactory;
    
    protected $table = 'e9alumno_docente';
    protected $fillable=[ 
                            'id',
                            'id_user',
                            'onombre',
                            'osede',
                            'osubsede',
                            'omatricula',
                            'ofolio',
                            'ogrado',
                            'ogrupo',
                            'oprograma',
                            'oasignatura',
                            'odocente',
                            'omodalidad',
                            'oanio',
                            'oetapa',
                            'ban_fin'
                        ];

    
    public function alumno() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function desempeno() {
        return $this->belongsTo(EvaluacionDocente::class, 'id', 'id_docente');
    }

}
