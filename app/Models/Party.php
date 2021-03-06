<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;
    
    public $fillable = [
        'name',
        'description',
        'creatorId',
        'gameId'
    ];

    public function games()
    {
        return $this->belongsTo(Game::class);
    }

    public function usersJoined()
    {
        return $this->belongsTo(User::class);
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}