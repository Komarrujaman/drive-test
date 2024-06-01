<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Models\Datas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubsController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->post();

        // Mendapatkan nilai devEui dari data JSON
        $devEui = $this->getDevEui($data);

        // Jika devEui ditemukan, simpan ke dalam tabel devices
        if (!empty($devEui)) {
            // Menyimpan device atau mengambil ID yang ada jika sudah ada
            $device = Devices::updateOrCreate(['dev_eui' => $devEui]);

            // Mendapatkan ID device
            $deviceId = $device->id;

            // Mendapatkan informasi lain dari payload
            $payload = $this->getPayload($data);
            $snr = $this->getSnr($data);
            $rssi = $this->getRssi($data);
            $timestamp = $this->getTimestamp($data);

            // Memeriksa apakah sudah ada data dengan timestamp yang sama
            $existingData = Datas::where('timestamp', $timestamp)->first();

            // Jika belum ada data dengan timestamp yang sama, simpan data baru
            if (!$existingData) {
                Datas::create([
                    'device_id' => $deviceId,
                    'payload' => $payload,
                    'snr' => $snr,
                    'rssi' => $rssi,
                    'timestamp' => $timestamp
                ]);
            }
        }

        Log::debug('Data received: ' . json_encode($data));
    }

    private function getDevEui($data)
    {
        // Cek apakah data memiliki struktur yang diharapkan
        if (isset($data['m2m:sgn']['m2m:nev']['m2m:rep']['m2m:cin']['con'])) {
            $con = json_decode($data['m2m:sgn']['m2m:nev']['m2m:rep']['m2m:cin']['con'], true);

            // Jika struktur sesuai, ambil nilai devEui
            if (isset($con['devEui'])) {
                return $con['devEui'];
            }
        }

        return null;
    }

    // Fungsi untuk mendapatkan payload dari data JSON
    private function getPayload($data)
    {
        if (isset($data['m2m:sgn']['m2m:nev']['m2m:rep']['m2m:cin']['con'])) {
            $con = json_decode($data['m2m:sgn']['m2m:nev']['m2m:rep']['m2m:cin']['con'], true);
            if (isset($con['data'])) {
                return $con['data'];
            }
        }
        return null;
    }

    // Fungsi untuk mendapatkan SNR dari data JSON
    private function getSnr($data)
    {
        // Sesuaikan dengan struktur data JSON yang Anda terima
        if (isset($data['m2m:sgn']['m2m:nev']['m2m:rep']['m2m:cin']['con'])) {
            $con = json_decode($data['m2m:sgn']['m2m:nev']['m2m:rep']['m2m:cin']['con'], true);
            if (isset($con['radio']['hardware']['snr'])) {
                return $con['radio']['hardware']['snr'];
            }
        }
        return null;
    }

    // Fungsi untuk mendapatkan RSSI dari data JSON
    private function getRssi($data)
    {
        // Sesuaikan dengan struktur data JSON yang Anda terima
        if (isset($data['m2m:sgn']['m2m:nev']['m2m:rep']['m2m:cin']['con'])) {
            $con = json_decode($data['m2m:sgn']['m2m:nev']['m2m:rep']['m2m:cin']['con'], true);
            if (isset($con['radio']['hardware']['rssi'])) {
                return $con['radio']['hardware']['rssi'];
            }
        }
        return null;
    }

    // Fungsi untuk mendapatkan timestamp dari data JSON
    private function getTimestamp($data)
    {
        // Sesuaikan dengan struktur data JSON yang Anda terima
        if (isset($data['m2m:sgn']['m2m:nev']['m2m:rep']['m2m:cin']['lt'])) {
            return $data['m2m:sgn']['m2m:nev']['m2m:rep']['m2m:cin']['lt'];
        }
        return null;
    }
}
