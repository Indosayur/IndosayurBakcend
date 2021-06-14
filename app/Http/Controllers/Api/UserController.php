<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $Request){
        // dd($Request->all());die();
        $user = User::where('email', $Request->email)->first();
        
        if($user){
            if(password_verify($Request->password, $user->password)){
                return response()->json([
                    'success' => 1,
                    'message' => 'Selamat datang '.$user->nama,
                    'user' => $user
                ]);
            }
            return $this->error('Password Salah');
        }
        return $this->error('Email Tidak Terdaftar');
    }

    public function Register(Request $Request){
        $validasi = Validator::make($Request->all(),[
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6'
        ]);

        if($validasi->fails()){
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $user = User::create(array_merge($Request->all(),[
            'password' => bcrypt($Request->password)
        ]));

        if ($user){
            return response()->json([
                'success' => 1,
                'message' => 'Selamat Datang, Register Berhasil',
                'user' => $user
            ]);
        }

        return $this->error('Registrasi gagal');


    }

    public function error($pesan){
        return response()->json([
            'success' => 0,
            'message' => $pesan
        ]);
    }
}

    


