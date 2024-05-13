<?php

namespace App\Models;

use Illuminate\Database\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Criterios extends Model
{
//    use HasFactory;

    protected $table = 'e9criterios';

    protected $fillable=[
                            'id', 
                            'ocriterio', 
                            'ovalor', 
                        ];


}
