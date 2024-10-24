<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vilao extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nome',
        'universo',
        'poder',
    ];
        
}