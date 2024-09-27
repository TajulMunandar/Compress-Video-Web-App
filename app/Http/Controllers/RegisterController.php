<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => ['required', 'unique:users'],
            'password' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['isAdmin'] = 0;

        $user = User::create($validatedData);

        if ($user) {
            return redirect()->route('login')->with('success', 'Register Berhasil!');
        } else {
            // Jika pembuatan pengguna gagal
            return redirect()->route('register.index')->with('failed', 'Register Tidak Berhasil!');;
        }
    }
}
