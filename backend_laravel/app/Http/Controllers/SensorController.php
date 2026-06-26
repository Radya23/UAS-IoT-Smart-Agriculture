<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SensorController extends Controller 
{
    public function index() {
        return view('dashboard');
    }

    // Digunakan saat menekan tombol Siram/Matikan di Web
    public function updatePompa(Request $request) {
        $status = $request->input('status');
        
        DB::table('sensor_data')->insert([
            'encoded_data' => '0', // Nilai default saat manual
            'status_pompa' => $status,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return response()->json(['message' => 'Sukses']);
    }

    // Digunakan oleh ESP32 dan Dashboard untuk mengecek status
    public function getStatus() {
        $latest = DB::table('sensor_data')->latest('created_at')->first();
        
        return response()->json([
            'status' => $latest ? $latest->status_pompa : 'OFF',
            // Jika data adalah angka (sensor), kirim angka tersebut, jika teks, kirim 0
            'kelembapan' => ($latest && is_numeric($latest->encoded_data)) ? (int)$latest->encoded_data : 0
        ]);
    }

    public function getHistori() {
        return response()->json(DB::table('sensor_data')->latest()->limit(10)->get());
    }
}