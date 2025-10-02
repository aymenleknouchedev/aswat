<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailAttachement extends Model
{
    protected $table = "mail_attachements";

    protected $fillable = [
        'mail_id',
        'file_path',
        'file_name',
    ];

    public function mail()
    {
        return $this->belongsTo(Mail::class);
    }
}
