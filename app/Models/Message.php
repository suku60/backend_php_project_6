<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $fillable = [
        'message',
        'date',
        'writerMember',
        'partyID'
    ];

    public function members()
    {
        return $this->belongsTo(User::class);
    }

    public function parties()
    {
        return $this->belongsTo(Party::class);
    }

}