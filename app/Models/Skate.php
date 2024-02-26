<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'foto', 'redes', 'score', 'email', 'password'];

    //Un skate pertenece a un equipo (relación uno a muchos)
    public function team()
    {
        return $this->belongsTo(Team::class); // skate pertenece a un único equipo
    }
}
