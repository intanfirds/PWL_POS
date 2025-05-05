<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserModel;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil user dari model yang kamu pakai
        $user = UserModel::where('user_id', Auth::id())->first();

        return view('profile.index', [
            'user' => $user,
                'breadcrumb' => (object)[
                'title' => 'Profil Pengguna',
                'list' => ['Home','Profil' ]
                ],
            'activeMenu' => 'profile'
        ]);

    }

    public function update(Request $request)
    {
        $user = UserModel::where('user_id', Auth::id())->first(); // konsisten pakai UserModel

        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::exists('public/foto/' . $user->foto)) {
                Storage::delete('public/foto/' . $user->foto);
            }

            // Simpan foto baru
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto', $filename);

            $user->foto = $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}