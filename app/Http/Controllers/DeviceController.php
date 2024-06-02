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
        }

        return view('data', compact('data'));
    }

    public function getLastDataAjax($deviceId)
    {
        // Ambil device berdasarkan ID
        $device = Devices::findOrFail($deviceId);

        // Ambil data terakhir berdasarkan timestamp
        $lastData = $device->datas()->latest('timestamp')->first();

        $data = [];
        // Jika data terakhir ditemukan, kirimkan data JSON
        if ($lastData) {
            $data = [
                'dev_eui' => $device->dev_eui,
                'snr' => $lastData->snr,
                'rssi' => $lastData->rssi,
                'last_update' => \Carbon\Carbon::parse($lastData->timestamp)->format('d/m/Y - H:i:s')
            ];
        }

        return response()->json($data);
    }
}
