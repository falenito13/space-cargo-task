<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestResponseLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'method',
        'session_id',
        'ip_address',
        'address',
        'parameters',
        'request_time',
        'status_code',
        'error_message',
        'response',
        'service_work_time'
    ];

    protected $casts = [
        'parameters' => 'json',
        'response' => 'json'
    ];
}
