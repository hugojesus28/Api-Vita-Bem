<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diabete extends Model
{
    use HasFactory;

    protected $table = 'tb_diabete';

    protected $fillable = [
        'id',
        'id_usuario',
        'data_registro',
        'nivel_glicose',
        'observacao',
        'horario_registro',
        'img_glicose',
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;

}
