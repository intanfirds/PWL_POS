<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Beauty & Health
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'B001',
                'barang_nama' => 'Face Serum',
                'harga_beli' => 50000,
                'harga_jual' => 75000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'B002',
                'barang_nama' => 'Body Lotion',
                'harga_beli' => 40000,
                'harga_jual' => 60000,
            ],
        
            // Home Care
            [
                'barang_id' => 3,
                'kategori_id' => 2,
                'barang_kode' => 'H001',
                'barang_nama' => 'Floor Cleaner',
                'harga_beli' => 30000,
                'harga_jual' => 45000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2,
                'barang_kode' => 'H002',
                'barang_nama' => 'Air Freshener',
                'harga_beli' => 25000,
                'harga_jual' => 40000,
            ],
        
            // Baby Kid
            [
                'barang_id' => 5,
                'kategori_id' => 3,
                'barang_kode' => 'K001',
                'barang_nama' => 'Baby Diapers',
                'harga_beli' => 70000,
                'harga_jual' => 100000,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 3,
                'barang_kode' => 'K002',
                'barang_nama' => 'Baby Powder',
                'harga_beli' => 20000,
                'harga_jual' => 35000,
            ],
        
            // Food Beverage
            [
                'barang_id' => 7,
                'kategori_id' => 4,
                'barang_kode' => 'F001',
                'barang_nama' => 'Instant Coffee',
                'harga_beli' => 15000,
                'harga_jual' => 25000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 4,
                'barang_kode' => 'F002',
                'barang_nama' => 'Tea Bags',
                'harga_beli' => 10000,
                'harga_jual' => 20000,
            ],
        
            // Sports
            [
                'barang_id' => 9,
                'kategori_id' => 5,
                'barang_kode' => 'S001',
                'barang_nama' => 'Yoga Mat',
                'harga_beli' => 80000,
                'harga_jual' => 120000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => 'S002',
                'barang_nama' => 'Skipping Rope',
                'harga_beli' => 25000,
                'harga_jual' => 40000,
            ],
        ];       
        DB::table('m_barang')->insert($data); 
    }
}
