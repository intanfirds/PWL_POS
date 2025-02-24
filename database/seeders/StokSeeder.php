<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Beauty & Health
            ['stok_id' => 1, 'barang_id' => 1, 'user_id' => 1, 'stok_tanggal' => '2025-02-20 10:00:00', 'stok_jumlah' => 100],
            ['stok_id' => 2, 'barang_id' => 1, 'user_id' => 2, 'stok_tanggal' => '2025-02-21 15:30:00', 'stok_jumlah' => 50],
            ['stok_id' => 3, 'barang_id' => 2, 'user_id' => 3, 'stok_tanggal' => '2025-02-18 08:45:00', 'stok_jumlah' => 120],
            ['stok_id' => 4, 'barang_id' => 2, 'user_id' => 1, 'stok_tanggal' => '2025-02-19 14:00:00', 'stok_jumlah' => 60],
        
            // Home Care
            ['stok_id' => 5, 'barang_id' => 3, 'user_id' => 2, 'stok_tanggal' => '2025-02-17 09:15:00', 'stok_jumlah' => 80],
            ['stok_id' => 6, 'barang_id' => 3, 'user_id' => 3, 'stok_tanggal' => '2025-02-18 12:30:00', 'stok_jumlah' => 40],
            ['stok_id' => 7, 'barang_id' => 4, 'user_id' => 1, 'stok_tanggal' => '2025-02-15 07:50:00', 'stok_jumlah' => 150],
            ['stok_id' => 8, 'barang_id' => 4, 'user_id' => 2, 'stok_tanggal' => '2025-02-16 16:10:00', 'stok_jumlah' => 90],
        
            // Baby Kid
            ['stok_id' => 9, 'barang_id' => 5, 'user_id' => 3, 'stok_tanggal' => '2025-02-14 11:25:00', 'stok_jumlah' => 200],
            ['stok_id' => 10, 'barang_id' => 5, 'user_id' => 1, 'stok_tanggal' => '2025-02-15 17:40:00', 'stok_jumlah' => 100],
            ['stok_id' => 11, 'barang_id' => 6, 'user_id' => 2, 'stok_tanggal' => '2025-02-13 10:10:00', 'stok_jumlah' => 250],
            ['stok_id' => 12, 'barang_id' => 6, 'user_id' => 3, 'stok_tanggal' => '2025-02-14 15:55:00', 'stok_jumlah' => 130],
        
            // Food Beverage
            ['stok_id' => 13, 'barang_id' => 7, 'user_id' => 1, 'stok_tanggal' => '2025-02-12 09:00:00', 'stok_jumlah' => 300],
            ['stok_id' => 14, 'barang_id' => 7, 'user_id' => 2, 'stok_tanggal' => '2025-02-13 14:20:00', 'stok_jumlah' => 200],
            ['stok_id' => 15, 'barang_id' => 8, 'user_id' => 3, 'stok_tanggal' => '2025-02-11 13:45:00', 'stok_jumlah' => 350],
            ['stok_id' => 16, 'barang_id' => 8, 'user_id' => 1, 'stok_tanggal' => '2025-02-12 16:35:00', 'stok_jumlah' => 180],
        
            // Sports
            ['stok_id' => 17, 'barang_id' => 9, 'user_id' => 2, 'stok_tanggal' => '2025-02-10 11:00:00', 'stok_jumlah' => 50],
            ['stok_id' => 18, 'barang_id' => 9, 'user_id' => 3, 'stok_tanggal' => '2025-02-11 15:30:00', 'stok_jumlah' => 30],
            ['stok_id' => 19, 'barang_id' => 10, 'user_id' => 1, 'stok_tanggal' => '2025-02-09 12:15:00', 'stok_jumlah' => 75],
            ['stok_id' => 20, 'barang_id' => 10, 'user_id' => 2, 'stok_tanggal' => '2025-02-10 18:45:00', 'stok_jumlah' => 40],
        ];        
        DB::table('t_stok')->insert($data);
    }
}
