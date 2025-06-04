<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remedio extends Model
{
    use HasFactory;
    protected $table = 'tb_remedios';

    protected $fillable =[
        'id','nome','horario','desc','dias', 'idUsuario','img','termino','created_at', 'updated_at'

    ];
    public $timestamps = false;

}
