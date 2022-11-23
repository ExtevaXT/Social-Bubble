<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

//    public function user()
//    {
//        return $this->belongsTo(User::class, 'users','id');
//    }
//    public function recipient()
//    {
//        return $this->belongsTo(User::class, 'recipient_id','id');
//    }
    protected $fillable = [
        'user_id',
        'recipient_id',
        'message',
    ];
    public function user()
    {
        return User::find($this->user_id);
    }
    public function recipient()
    {
        return User::find($this->recipient_id);
    }
}
