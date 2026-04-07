<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pises extends Model
{
    protected $table = 'paises';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre'
    ];
}
