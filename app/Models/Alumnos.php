<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Alumnos extends Model
{
    //use HasFactory, Notifiable, HasRoles;

    protected $table = 'users';

    protected $fillable=[
                            'id',
                            'name',
                            'omatricula',
                            'ofolio',
                            'oanio',
                            'oetapa',
                            'osede',
                            'osubsede',
                            'oprograma',
                            'oban_fin',
                        ];

    public function alumnodocente() {
        return $this->belongsTo(AlumnoDocente::class, 'id', 'id_user');
    }



}
