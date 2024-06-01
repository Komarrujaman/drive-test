<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Datas;

use function Laravel\Prompts\select;

class Devices extends Model
{
    use HasFactory;
    protected $table = 'devices';
    protected $fillable = [
        'dev_eui',
    ];

    public function datas()
    {
        return $this->hasMany(Datas::class, 'device_id');
    }

    public static function getDev()
    {
        $device = self::select('id', 'dev_eui')->get();

        $formated = $device->map(function ($item) {
            return [
                'id' => $item['id'],
                'dev_eui' => $item['dev_eui'],
            ];
        });
        return $formated;
    }
}
