<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Subs extends Model
{
    use HasFactory;

    public function index(Request $request)
    {
        $data = json_encode($request->post());
        Log::debug('Data received: ' . $data);
        $this->show($request);
    }

    // Fungsi baru untuk menampilkan data
    public function show(Request $request)
    {
        $data = $request->post('m2m:sgn.m2m:nev.m2m:rep.m2m:cin.con');
        dd(json_decode($data, true));
    }
}
