<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use Illuminate\Http\Request;

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
        // Jika data terakhir ditemukan, kembalikan respons JSON
        if ($lastData) {
            $data = [
                'dev_eui' => $device->dev_eui,
                'data' => $lastData
            ];
        }
        return view('data', compact('data'));
    }
}
