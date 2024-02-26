<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon', 'score'];

    // Un equipo tiene muchos skates (relación uno a muchos)
    public function skates()
    {
        return $this->hasMany(Skate::class); // un equipo puede tener muchos skates
    }
}
