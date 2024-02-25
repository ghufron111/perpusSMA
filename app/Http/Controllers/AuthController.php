<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(Request $request){
        return view('login', [
            'tab' => 'Login'
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            
            if (Auth::user()->status != 'active') {
                // dd(auth::user()->status);
                return redirect()->route('login')->with(['status' => 'failed', 'message' => 'Akun anda belum aktif, mohon hubungi Admin!']);
            }
            
            if(Auth::user()->role_id == 1){
                return redirect('dashboard');
            }
            
            if(Auth::user()->role_id == 2){
                return redirect('siswa');
            }
        }
    
        return redirect('/login')->with(['status' => 'failed', 'message' => 'Login Invalid']);
    }
    

    public function register(){
        return view('register', [
            'tab' => 'Register'
        ]);
    }

    public function tambahakun(Request $request){
        $request->validate([
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'password' => 'required|min:5|max:255',
            'name' => 'required',
            'phone' => 'required|min:10|max:13',
            'address' => 'required',
        ]);
        
        $role_id = '2';
        $keterangan = 'Pendaftaran akun baru';
        
        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'name' => $request->name,
            'role_id' => $role_id,
            'keterangan' => $keterangan,
        ];

        User::create($data);

        $request->session()->flash('success', 'Registrasi berhasil! Silahkan Hubungi Admin Untuk Pengaktifan Akun');

        return redirect('/login');
    }

    public function logout(){
        Auth::logout();
 
        request()->session()->invalidate();
     
        request()->session()->regenerateToken();

        request()->session()->flush();
     
        return redirect('/');
    }
}
