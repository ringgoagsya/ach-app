<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\master_petugas;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use Carbon\Carbon;
class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }
    public function user(){
        $user  = user::all();
        return view('admin.user.user',compact('user'));
    }
    public function store(request $req){
        // dd($req);
        $req->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // dd($req,$petugas);
        User::create([
            'name' => $req->nama,
            'email' => $req->email,
            'email_verified_at' => now(),
            'password' => Hash::make($req->password),
            // 'level' => 'admin',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
            ]);
        return redirect()->route('user.index');
    }

    public function update(request $req,$id){
        $req->validate([
            'id_petugas' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $petugas = petugas::where('id_petugas','=',$req->id_petugas)->first();
        // dd($petugas);
        User::where('id', $id)->update([
            'name' => $petugas->nama_petugas,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'id_petugas' => $petugas->id_petugas,
            'updated_at' => now()
            ]);
        return redirect()->route('user.index');
    }
    public function destroy($id){
        User::where('id', $id)->delete();
        return redirect()->route('user.index');
    }
}
