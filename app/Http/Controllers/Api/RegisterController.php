<?php

namespace App\Http\Controllers\Api;

use App\Models\UserModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:20|unique:m_user',
            'nama' => 'required|max:100',
            'no_telp' => 'required|max:20',
            'password' => 'required|min:6|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'level_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            // Handle file upload
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('images', 'public');
            } else {
                // Gunakan default.jpg dari folder public/img
                $fotoPath = 'img/default.jpg';
            }

            $user = UserModel::create([
                'username' => $request->username,
                'nama' => $request->nama,
                'no_telp' => $request->no_telp,
                'password' => bcrypt($request->password),
                'foto' => $fotoPath,
                'level_id' => $request->level_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'user' => $user,
                'message' => 'User registered successfully'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to register user: ' . $e->getMessage()
            ], 500);
        }
    }
}