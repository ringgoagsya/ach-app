<?php

namespace App\Http\Controllers;

use App\Models\master_kamar;
use App\Models\trx_volume;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class MasterPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master_kamar = master_kamar::orderByRaw("CASE
                        WHEN ruangan_kamar = 'vvip' THEN 1
                        WHEN ruangan_kamar = 'vip' THEN 2
                        WHEN ruangan_kamar = 'kelas1' THEN 3
                        WHEN ruangan_kamar = 'kelas2' THEN 4
                        WHEN ruangan_kamar = 'kelas3' THEN 5
                        ELSE 6
                        END")
                        ->orderBy('lantai_kamar', 'desc')
                        ->get();

        $trx_volume = trx_volume::all();
        return view('admin.pasien.pasien_index',compact('master_kamar','trx_volume'));
    }
    public function detail($id)
    {
        $kamar = master_kamar::where('master_kamars.id_kamar','=',$id)
                            ->leftJoin('trx_volumes','trx_volumes.id_kamar','=','master_kamars.id_kamar')
                            ->select('master_kamars.id_kamar as id_kamar','lantai_kamar','ruangan_kamar','panjang_kamar','lebar_kamar','tinggi_kamar','panjang_ventilasi','lebar_ventilasi','volume_udara','standart')
                            ->first();
        return view('admin.pasien.detail_kamar',compact('kamar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        $day = Carbon::parse($now)->format('d');
        $month = Carbon::parse($now)->format('m');
        $year = Carbon::parse($now)->format('Y');
        // dd($request);
        $master_kamar = master_kamar::all();
        $lastRuangan =(substr($request->ruangan_kamar, 0,3));
        $nextIdNumber = 0;

        // dd($nextIdNumber);
        $nextId = 'KAMAR' ."-".str_replace(' ', '',$request->ruangan_kamar)."-".(substr($request->lantai_kamar, 0,3));

        // dd($nextId);
        $kamar = master_kamar::create([
            'id_kamar' => $nextId,
            'lantai_kamar' => $request->lantai_kamar,
            'ruangan_kamar' => $request->ruangan_kamar,
            'panjang_kamar' => str_replace(',', '.', $request->panjang_kamar),
            'lebar_kamar' => str_replace(',', '.', $request->lebar_kamar),
            'tinggi_kamar' => str_replace(',', '.', $request->tinggi_kamar),
            'panjang_ventilasi' => str_replace(',', '.', $request->panjang_ventilasi),
            'lebar_ventilasi' => str_replace(',', '.', $request->lebar_ventilasi),
            'keterangan' => $request->keterangan,
            'standart' => $request->standart,

        ]);
        return redirect()->route('pasien.index')->with('success', 'Pendaftaran kamar berhasil! ID. :'.$nextId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $master_kamar = master_kamar::orderByRaw("CASE
                        WHEN ruangan_kamar = 'vvip' THEN 1
                        WHEN ruangan_kamar = 'vip' THEN 2
                        WHEN ruangan_kamar = 'kelas1' THEN 3
                        WHEN ruangan_kamar = 'kelas2' THEN 4
                        WHEN ruangan_kamar = 'kelas3' THEN 5
                        ELSE 6
                        END")
                        ->orderBy('lantai_kamar', 'desc')
                        ->get();
        $trx_volume = trx_volume::all();
        return view('auth.register',compact('master_kamar','trx_volume'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\master_pasien  $master_pasien
     * @return \Illuminate\Http\Response
     */
    public function show(master_pasien $master_pasien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\master_pasien  $master_pasien
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request)
    {
        // dd($request);
        $trx_volume = trx_volume::all();
        $update = false;
        foreach($trx_volume as $trx){
            if($trx->id_kamar == $request->id_kamar){
                trx_volume::where('id_kamar','=',$request->id_kamar)
                ->update(
                    ['volume_udara' => str_replace(',', '.',$request->volume_udara),
                    'updated_at' => now()]
                );
                $update = true;
                break;
            }
        }
        if($update == false){
            trx_volume::create([
                'id_kamar' => $request->id_kamar,
                'volume_udara' => str_replace(',', '.',$request->volume_udara),
                'created_at' => now(),
                'updated_at' => now()
                ]);
        }

        return redirect()->route('pasien.index');
    }
    public function editvelocity(request $request)
    {
        // dd($request);
        $trx_volume = trx_volume::all();
        $update = false;
        foreach($trx_volume as $trx){
            if($trx->id_kamar == $request->id_kamar){
                trx_volume::where('id_kamar','=',$request->id_kamar)
                ->update(
                    ['volume_udara' => str_replace(',', '.',$request->volume_udara) ?? 0.0,
                    'updated_at' => now()]
                );
                $update = true;
                break;
            }
        }
        if($update == false){
            if($update == false){
                trx_volume::create([
                    'id_kamar' => $request->id_kamar,
                    'volume_udara' => str_replace(',', '.',$request->volume_udara) ?? 0.0,
                    'created_at' => now(),
                    'updated_at' => now()
                    ]);
            }
        }

        return redirect()->route('pasien.create')->with('success', 'Pendaftaran kamar berhasil! ID. :'.$request->id_kamar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\master_pasien  $master_pasien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        if ($request->input('standart') == null) {
            $standart = 0.0; // Nilai float default
        }
        else{
            $standart = str_replace(',', '.',$request->input('standart'));
        }
        if ($request->input('volume_udara') == null) {
            $volume_udara = 0.0; // Nilai float default
        }
        else{
            $volume_udara = str_replace(',', '.',$request->input('volume_udara'));
        }
        // dd($standart,$volume_udara);
        $kamar = master_kamar::where('id_kamar','=',$request->id_kamar)->update([
            'lantai_kamar' => $request->lantai_kamar,
            'ruangan_kamar' => $request->ruangan_kamar,
            'panjang_kamar' => str_replace(',', '.', $request->panjang_kamar),
            'lebar_kamar' => str_replace(',', '.', $request->lebar_kamar),
            'tinggi_kamar' => str_replace(',', '.', $request->tinggi_kamar),
            'panjang_ventilasi' => str_replace(',', '.', $request->panjang_ventilasi),
            'lebar_ventilasi' => str_replace(',', '.', $request->lebar_ventilasi),
            'keterangan' => $request->keterangan,
            'standart' => $request->standart,
            'updated_at' => now(),
        ]);

        $trx_volume = trx_volume::all();
        $update = false;
        foreach($trx_volume as $trx){
            if($trx->id_kamar == $request->id_kamar){
                trx_volume::where('id_kamar','=',$request->id_kamar)
                ->update(
                    ['volume_udara' => $volume_udara,
                    'updated_at' => now()]
                );
                $update = true;
                break;
            }
        }
        if($update == false){
                trx_volume::create([
                    'id_kamar' => $request->id_kamar,
                    'volume_udara' => $volume_udara,
                    'created_at' => now(),
                    'updated_at' => now()
                    ]);
        }

        // dd($kamar,$volume);
        return redirect()->route('kamar.detail',$request->id_kamar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\master_pasien  $master_pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        master_kamar::where('id_kamar','=', $id)->delete();
        return redirect()->route('kamar.index')->with('success','Berhasil Hapus');
    }
}
