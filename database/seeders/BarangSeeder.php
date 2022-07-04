<?php

namespace Database\Seeders;

use App\Models\TblBarang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barangs = [[
            'kode_barang' => 'B00001',
            'nama_barang' => 'Bolpoin Standard AE7',
            'desc' => 'Bolpoin standard model AE7'
        ], [
            'kode_barang' => 'B00002',
            'nama_barang' => 'Bolpoin Standard R8',
            'desc' => 'Bolpoin standard model R8',
        ],
        [
            'kode_barang' => 'B00003',
            'nama_barang' => 'Bolpoin Standard NX7',
            'desc' => 'Bolpoin standard model NX7',
        ],[
            'kode_barang' => 'B00004',
            'nama_barang' => 'Bolpoin Standard Tecno',
            'desc' => 'Bolpoin standard model Tecno',
        ],[
            'kode_barang' => 'B00005',
            'nama_barang' => 'Bolpoin Standard AE9',
            'desc' => 'Bolpoin standard model AE9',
        ],];
        foreach($barangs as $key => $value) {
            TblBarang::create($value);
        }
    }
}
