<?php

namespace App\Models;

use App\Models\Devices;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datas extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_id',
        'payload',
        'snr',
        'rssi',
        'timestamp'
    ];

    public function devices()
    {
        return $this->belongsTo(Devices::class, 'device_id');
    }
}
