<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AbsensiKameraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('absensiKamera');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|string',
        ]);

        $imageData = $request->input('image');
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageData = base64_decode($imageData);

        $fileName = 'absensi_' . Auth::id() . '_' . time() . '.png';
        Storage::disk('public')->put($fileName, $imageData);

        // Here you can add logic to record attendance in database, e.g., create an attendance record

        return response()->json(['success' => true, 'message' => 'Absensi berhasil dicatat!', 'file' => $fileName]);
    }
}
