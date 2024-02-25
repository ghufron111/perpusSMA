<?php

namespace App\Http\Controllers;

use App\Models\Main;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view ('client.dashboard', [
            'tab' => 'Dashboard'
        ]);
    }

    public function anggota(){
        $user = User::where('role_id', '!=', 1)->get();

        return view ('admin.anggota.anggota', [
            'tab' => 'Keanggotaan',
            'user' => $user,
        ]);
    }

    public function anggota_tambah(){
        return view('admin.anggota.tambahanggota', [
            'tab' => 'Tambah Anggota Baru'
        ]);
    }

    public function anggota_tambah_baru(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $role_id = '2';

        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'role_id' => $role_id,
        ];
        
        Main::Simpan('users', $data);

        return redirect('/anggota');
    }

    public function anggota_active(Request $request, $id){
        $status = 'active';
        $keterangan = '';

        $data = [
            'status' => $status,
            'keterangan' =>$keterangan,
        ];

        $where = ['id' => $id];
        Main::Ubah('users', $data, $where);
        return redirect('anggota');
    }
    
    public function anggota_inactive(Request $request, $id){
        $status = 'inactive';
        $keterangan = 'Siswa terlambat mengembalikan';

        $data = [
            'status' => $status,
            'keterangan' =>$keterangan,
        ];

        $where = ['id' => $id];
        Main::Ubah('users', $data, $where);
        return redirect('anggota');
    }

    public function anggota_hapus($id){
        $result = Main::Hapus('users', array('id'=>$id));

        if ($result =1){
            return redirect('/anggota');
        }
    }

    public function anggota_ubah($id){
        $users = DB::table('users')->where('id', $id)->first();
        $tab = 'Ubah Anggota';

        return view('admin.anggota.ubahanggota', compact('users', 'tab'));
    }

    public function action_ubah(Request $request, $id){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        
        $data = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ];

        $where = ['id' => $id];
        Main::Ubah('users', $data, $where);
        return redirect('anggota');
    }
}
