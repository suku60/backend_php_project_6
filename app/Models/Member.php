<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public $fillable = [
        'partyId',
        'userId'
    ];

    public function parties()
    {
        return $this->belongsTo(Party::class);
    }

    public function usersjoined()
    {
        return $this->belongsTo(User::class);
    }
}