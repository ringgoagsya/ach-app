<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersTableSeeder::class]);
        // DB::table('master_pasiens')->insert([
        //     [
        //         'id_pasien'=>'PAS000001',
        //         'nama_pasien'=> 'Tina_Martha',
        //         'jenis_kelamin'=> 'Perempuan',
        //         'tanggal_lahir'=> '1990-02-03'
        //     ],
        //     [
        //         'id_pasien'=>'PAS000002',
        //         'nama_pasien'=> 'Radinal Dwiki Novendra',
        //         'jenis_kelamin'=> 'Laki-Laki',
        //         'tanggal_lahir' => '1995-09-10'
        //     ],
        // ]);
        // DB::table('master_layanans')->insert([
        //     [
        //         'id_layanan'=>'LAY001',
        //         'nama_layanan'=> 'Poliklinik Umum',
        //     ],
        //     [
        //         'id_layanan'=>'LAY002',
        //         'nama_layanan'=> 'Poliklinik Gigi',
        //     ],
        // ]);
        // DB::table('master_jenis_pendaftarans')->insert([
        //     [
        //         'id_jenis_pendaftaran'=>'JP001',
        //         'nama_jenis_pendaftaran'=> 'Rawat Jalan',
        //     ],
        //     [
        //         'id_jenis_pendaftaran'=>'JP002',
        //         'nama_jenis_pendaftaran'=> 'Rawat Inap',
        //     ],
        //     [
        //         'id_jenis_pendaftaran'=>'JP003',
        //         'nama_jenis_pendaftaran'=> 'UGD',
        //     ],
        // ]);
        // DB::table('master_petugas')->insert([
        //     [
        //         'id_petugas'=>'PTG000',
        //         'nama_petugas'=> 'Admin',
        //     ],
        //     [
        //         'id_petugas'=>'PTG001',
        //         'nama_petugas'=> 'Safitri Jayanti',
        //     ],
        //     [
        //         'id_petugas'=>'PTG002',
        //         'nama_petugas'=> 'Ahmad Sandi',
        //     ],
        //     [
        //         'id_petugas'=>'PTG003',
        //         'nama_petugas'=> 'Cici Utami',
        //     ],
        // ]);
        // DB::table('master_metode_pembayarans')->insert([
        //     [
        //         'id_metode_pembayaran'=>'PAYMENT001',
        //         'nama_metode_pembayaran'=> 'Umum',
        //     ],
        //     [
        //         'id_metode_pembayaran'=>'PAYMENT002',
        //         'nama_metode_pembayaran'=> 'BPJS Kesehatan',
        //     ],
        //     [
        //         'id_metode_pembayaran'=>'PAYMENT003',
        //         'nama_metode_pembayaran'=> 'Mandiri Inhealt',
        //     ],
        // ]);
    }
}
