<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwalPeriksas = JadwalPeriksa::with('dokter')->where('id_dokter', Auth::user()->id)->get();

        return view('dokter.jadwal-periksa.index')->with([
            'jadwalPeriksas' => $jadwalPeriksas
        ]);
    }

    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
    ]);

    if (
        JadwalPeriksa::where('id_dokter', Auth::user()->id)
            ->where('hari', $validatedData['hari'])
            ->where('jam_mulai', $validatedData['jam_mulai'])
            ->where('jam_selesai', $validatedData["jam_selesai"])
            ->exists()
    ) {
        return redirect()->route('dokter.jadwal-periksa.create')
                         ->with('error', 'Jadwal sudah terdaftar.');
    }

    JadwalPeriksa::create([
        'id_dokter' => Auth::user()->id,
        'hari' => $validatedData['hari'],
        'jam_mulai' => $validatedData['jam_mulai'],
        'jam_selesai' => $validatedData['jam_selesai'],
        'status' => 0
    ]);

    return redirect()->route('dokter.jadwal-periksa.index')
                     ->with('success', 'Jadwal periksa berhasil ditambahkan.');
    }

    public function update($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);

        if(!$jadwalPeriksa->status)
        {
            JadwalPeriksa::where('id_dokter', Auth::user()->id)->update(['status' => 0]);

            $jadwalPeriksa->status = true;
            $jadwalPeriksa->save();

            return redirect()->route('dokter.jadwal-periksa.index');
        }

        $jadwalPeriksa->status = false;
        $jadwalPeriksa->save();

        return redirect()->route('dokter.jadwal-periksa.index');
    }

}
