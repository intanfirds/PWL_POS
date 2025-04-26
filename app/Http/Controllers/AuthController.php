<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\LevelModel;
use App\Models\UserModel;


class AuthController extends Controller
{
    public function login()
    {
        // Jika sudah login, redirect ke halaman home
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal!',
                'msgField' => $validator->errors(),
            ]);
        }
    
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return response()->json([
                'status' => true,
                'message' => 'Login berhasil!',
                'redirect' => url('/'), // arahkan ke dashboard atau halaman utama
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Username atau password salah!',
                'msgField' => [
                    'username' => ['Periksa kembali username Anda.'],
                    'password' => ['Periksa kembali password Anda.'],
                ]
            ]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // Atau arahkan ke halaman lain setelah logout
    }

    public function register(){
        $level = LevelModel::select('level_id','level_name')->get();

        return View('auth.register')
        ->with('level', $level);
    }

    public function store_user(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama'     => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer',
        ]);
    
        // Menyimpan user baru
        UserModel::create([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => bcrypt($request->password), // Enkripsi password
            'level_id' => $request->level_id,
        ]);
    
        // Mengirim respons JSON jika permintaan AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Registrasi Berhasil',
                'redirect' => url('login')
            ]);
        }
    
        // Jika bukan AJAX, redirect ke halaman utama dengan flash message
        return redirect('/')->with('success', 'Registrasi berhasil');
    }

}   