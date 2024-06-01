<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use Illuminate\Http\Request;
use App\Events\NewDataEvent;

class DeviceController extends Controller
{
    public function index()
    {
        $device = Devices::getDev();
        return view('home', compact('device'));
    }

    public function getLastData($deviceId)
    {
        // Ambil device berdasarkan ID
        $device = Devices::findOrFail($deviceId);

        // Ambil data terakhir berdasarkan timestamp
        $lastData = $device->datas()->latest('timestamp')->first();

        $data = [];
        // Jika data terakhir ditemukan, kirimkan event NewDataEvent
        if ($lastData) {
            $data = [
                'id' => $device->id,
                'dev_eui' => $device->dev_eui,
                'data' => $lastData
            ];

            // Kirim event ke Pusher
            event(new NewDataEvent($lastData));
        }

        return view('data', compact('data'));
    }
}
