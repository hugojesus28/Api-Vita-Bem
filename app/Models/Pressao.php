<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pressao extends Model
{
    use HasFactory;

    protected $table = 'tb_pressao';

    public $fillable = [
        'id',
        'id_usuario',
        'data_pressao',
        'hora_pressao',
        'medida_pressao',
        'img_pressao',
        'observacao',
        'created_at',
        'updated_at'
    ];

    public $timestamps = false;

    
}
