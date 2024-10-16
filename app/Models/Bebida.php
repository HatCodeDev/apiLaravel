<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bebida extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo',
        'tostados_id',
        'precio',
        'filtracion',
        'altura',
        'complementos',
        'imagen',
    ];
}
