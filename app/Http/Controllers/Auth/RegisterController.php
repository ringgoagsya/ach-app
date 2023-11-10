<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\master_pasien;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $lastPatient = master_pasien::orderBy('id_pasien', 'desc')->first();
        if (!$lastPatient) {
        $nextId = 'PAS000001';
        } else {
        $lastIdNumber = intval(substr($lastPatient->id_pasien, 3));
        $nextIdNumber = $lastIdNumber + 1;
        $nextId = 'PAS' . str_pad($nextIdNumber, 6, '0', STR_PAD_LEFT);
        }
        // dd($lastPatient, $lastIdNumber,$nextId,$nextId);
        $pasien = master_pasien::create([
            'id_pasien' => $nextId,
            'nama_pasien' => $data['name'],
            'tanggal_lahir' => $data['tanggal_lahir']->format('Y-m-d'),
            'jenis_kelamin' => $data['jenis_kelamin'],
        ]);
        // dd($pasien);
        return redirect()->route('register')->with('success', 'Pendaftaran berhasil!');
    }
}
