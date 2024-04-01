<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'nama' => 'required',
            'username' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:user,email',
            'ktp' => 'required|numeric',
            'no_telp' => 'required|numeric',
            'password' => 'required|min:5|max:255',
            'role' => "3",
            'terms' => 'required'
        ]);
        $attributes['role'] = '3';

        $user = User::create($attributes);
        auth()->login($user);

        return redirect('/login');
    }
}
