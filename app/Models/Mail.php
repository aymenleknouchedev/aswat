<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MailAttachement;
USE App\Models\User;

class Mail extends Model
{

    protected $fillable = [
        "email", "subject", "body",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(MailAttachement::class);
    }
}
