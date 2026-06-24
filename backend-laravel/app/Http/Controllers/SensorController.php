<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    // Digunakan ESP32 untuk mengirim data ke database
    public function store(Request $request)
    {
        $request->validate([
            'encoded_data' => 'required',
            'status_pompa' => 'required',
        ]);

        $data = SensorData::create([
            'encoded_data' => $request->encoded_data,
            'status_pompa' => $request->status_pompa,
        ]);

        return response()->json([
            'message' => 'Data berhasil disimpan',
            'data' => $data,
        ], 201);
    }

    // Digunakan Aplikasi Flutter untuk melihat data terakhir
    public function latest()
    {
        $data = SensorData::latest()->first();
        
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['data' => $data], 200);
    }

    // Digunakan Aplikasi Flutter untuk mengubah status pompa secara manual
    public function updateStatus(Request $request) 
    {
        $request->validate(['status' => 'required']);
        
        $data = SensorData::latest()->first();
        if ($data) {
            $data->update(['status_pompa' => $request->status]);
            return response()->json(['message' => 'Status pompa diubah ke ' . $request->status]);
        }
        
        return response()->json(['message' => 'Gagal update, tidak ada data'], 404);
    }

    // Digunakan ESP32 untuk mengecek apakah harus menyiram (Mode Manual)
    public function getStatus() 
    {
        $data = SensorData::latest()->first();
        return response()->json(['status' => $data ? $data->status_pompa : 'OFF']);
    }
}