<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['penjualan_id' => 1, 'user_id' => 3, 'pembeli' => 'Andi', 'penjualan_kode' => 'TRX-0001', 'penjualan_tanggal' => '2025-02-01 10:15:00'],
            ['penjualan_id' => 2, 'user_id' => 3, 'pembeli' => 'Budi', 'penjualan_kode' => 'TRX-0002', 'penjualan_tanggal' => '2025-02-02 12:30:00'],
            ['penjualan_id' => 3, 'user_id' => 3, 'pembeli' => 'Citra', 'penjualan_kode' => 'TRX-0003', 'penjualan_tanggal' => '2025-02-03 14:45:00'],
            ['penjualan_id' => 4, 'user_id' => 3, 'pembeli' => 'Dewi', 'penjualan_kode' => 'TRX-0004', 'penjualan_tanggal' => '2025-02-04 16:00:00'],
            ['penjualan_id' => 5, 'user_id' => 3, 'pembeli' => 'Eko', 'penjualan_kode' => 'TRX-0005', 'penjualan_tanggal' => '2025-02-05 18:20:00'],
            ['penjualan_id' => 6, 'user_id' => 3, 'pembeli' => 'Fajar', 'penjualan_kode' => 'TRX-0006', 'penjualan_tanggal' => '2025-02-06 09:10:00'],
            ['penjualan_id' => 7, 'user_id' => 3, 'pembeli' => 'Gita', 'penjualan_kode' => 'TRX-0007', 'penjualan_tanggal' => '2025-02-07 11:35:00'],
            ['penjualan_id' => 8, 'user_id' => 3, 'pembeli' => 'Hadi', 'penjualan_kode' => 'TRX-0008', 'penjualan_tanggal' => '2025-02-08 13:50:00'],
            ['penjualan_id' => 9, 'user_id' => 3, 'pembeli' => 'Indah', 'penjualan_kode' => 'TRX-0009', 'penjualan_tanggal' => '2025-02-09 15:25:00'],
            ['penjualan_id' => 10, 'user_id' => 3, 'pembeli' => 'Joko', 'penjualan_kode' => 'TRX-0010', 'penjualan_tanggal' => '2025-02-10 17:40:00'],
        ];
        DB::table('t_penjualan')->insert($data);
        
    }
}
