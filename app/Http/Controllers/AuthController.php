<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Services\UmkmService;

class AuthController extends Controller
{
    private $umkmService;
    public function __construct(UmkmService $umkmService)
    {
        $this->umkmService = $umkmService;
    }

    public function login(){
        return view('auth.login');
    }

    public function verify(LoginRequest $request){
        if(Auth::guard('umkm')->attempt($request->only('email', 'password'))){
            return to_route('home');
        }

        if(Auth::guard('web')->attempt($request->only('email', 'password'))){
            return to_route('home');
        }

        return back()->withInput()->with('error', 'Email atau Password Salah, Silahkan Coba Lagi!');
    }

    public function register(){
        return view('auth.register');
    }

    public function registration(RegisterRequest $request){
        if($this->umkmService->save(
            $request->name,
            $request->since,
            $request->nib,
            isset($request->has_bpom),
            isset($request->has_pirt),
            isset($request->has_halal),
            $request->address,
            $request->owner,
            $request->phone,
            $request->email,
            $request->password)){
                return to_route('login')->with('success', 'Sukses Mendaftar Akun UMKM, Silahkan Login!');
        }else{
            return back()->withInput()->with('error', 'Terjadi Kesalahan, Silahkan Coba Lagi!');
        }   
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        Auth::guard('umkm')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('login');
    }

    public function profile(){
        
    }

    public function updateProfile(){

    }
}
