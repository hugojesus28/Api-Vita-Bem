<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'tb_usuario';

    protected $fillable = ['id', 'nome_usuario', 'email_usuario', 'senha_usuario', 
                            'peso_usuario', 'altura_usuario', 'genero_usuario', 
                            'data_nascimento_usuario', 'hipertenso_usuario', 'diabetico_usuario',
                            'img_usuario', 'created_at', 'updated_at'];

    public $timestamps = false;
}
