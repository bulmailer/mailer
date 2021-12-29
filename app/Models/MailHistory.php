<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'mail',
        'subject',
        'addresses',
        'company',
        'failed',
        'username'
    ];
}
