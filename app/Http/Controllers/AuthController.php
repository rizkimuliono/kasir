<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

   public function cekLogin(Request $request){
        // Validasi request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil data dari request
        $email = $request->input('email');
        $password = $request->input('password');

        // Cek apakah user ada dalam database
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Jika user tidak ditemukan, kembali ke halaman login dengan pesan error
            return redirect()->back()->with('error', 'Email atau password salah.');
        }

        // Jika user ditemukan, cek password
        if (password_verify($password, $user->password)) {
            // Jika password benar, set level ke session
            Session::put('level', $user->level);

            // Redirect ke halaman dashboard
            return redirect()->route('dashboard');
        } else {
            // Jika password salah, kembali ke halaman login dengan pesan error
            return redirect()->back()->with('error', 'Email atau password salah.');
        }
    }

}
