<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Penjualan 1 (TRX-0001)
            ['id' => 1, 'penjualan_id' => 1, 'barang_id' => 1, 'harga' => 50000, 'jumlah' => 2],
            ['id' => 2, 'penjualan_id' => 1, 'barang_id' => 3, 'harga' => 30000, 'jumlah' => 1],
            ['id' => 3, 'penjualan_id' => 1, 'barang_id' => 5, 'harga' => 40000, 'jumlah' => 1],
        
            // Penjualan 2 (TRX-0002)
            ['id' => 4, 'penjualan_id' => 2, 'barang_id' => 2, 'harga' => 25000, 'jumlah' => 1],
            ['id' => 5, 'penjualan_id' => 2, 'barang_id' => 4, 'harga' => 35000, 'jumlah' => 2],
            ['id' => 6, 'penjualan_id' => 2, 'barang_id' => 6, 'harga' => 45000, 'jumlah' => 1],
        
            // Penjualan 3 (TRX-0003)
            ['id' => 7, 'penjualan_id' => 3, 'barang_id' => 7, 'harga' => 20000, 'jumlah' => 3],
            ['id' => 8, 'penjualan_id' => 3, 'barang_id' => 8, 'harga' => 55000, 'jumlah' => 1],
            ['id' => 9, 'penjualan_id' => 3, 'barang_id' => 9, 'harga' => 60000, 'jumlah' => 2],
        
            // Penjualan 4 (TRX-0004)
            ['id' => 10, 'penjualan_id' => 4, 'barang_id' => 10, 'harga' => 75000, 'jumlah' => 1],
            ['id' => 11, 'penjualan_id' => 4, 'barang_id' => 1, 'harga' => 50000, 'jumlah' => 1],
            ['id' => 12, 'penjualan_id' => 4, 'barang_id' => 2, 'harga' => 25000, 'jumlah' => 2],
        
            // Penjualan 5 (TRX-0005)
            ['id' => 13, 'penjualan_id' => 5, 'barang_id' => 3, 'harga' => 30000, 'jumlah' => 1],
            ['id' => 14, 'penjualan_id' => 5, 'barang_id' => 4, 'harga' => 35000, 'jumlah' => 2],
            ['id' => 15, 'penjualan_id' => 5, 'barang_id' => 5, 'harga' => 40000, 'jumlah' => 1],
        
            // Penjualan 6 (TRX-0006)
            ['id' => 16, 'penjualan_id' => 6, 'barang_id' => 6, 'harga' => 45000, 'jumlah' => 2],
            ['id' => 17, 'penjualan_id' => 6, 'barang_id' => 7, 'harga' => 20000, 'jumlah' => 3],
            ['id' => 18, 'penjualan_id' => 6, 'barang_id' => 8, 'harga' => 55000, 'jumlah' => 1],
        
            // Penjualan 7 (TRX-0007)
            ['id' => 19, 'penjualan_id' => 7, 'barang_id' => 9, 'harga' => 60000, 'jumlah' => 1],
            ['id' => 20, 'penjualan_id' => 7, 'barang_id' => 10, 'harga' => 75000, 'jumlah' => 1],
            ['id' => 21, 'penjualan_id' => 7, 'barang_id' => 1, 'harga' => 50000, 'jumlah' => 1],
        
            // Penjualan 8 (TRX-0008)
            ['id' => 22, 'penjualan_id' => 8, 'barang_id' => 2, 'harga' => 25000, 'jumlah' => 2],
            ['id' => 23, 'penjualan_id' => 8, 'barang_id' => 3, 'harga' => 30000, 'jumlah' => 1],
            ['id' => 24, 'penjualan_id' => 8, 'barang_id' => 4, 'harga' => 35000, 'jumlah' => 1],
        
            // Penjualan 9 (TRX-0009)
            ['id' => 25, 'penjualan_id' => 9, 'barang_id' => 5, 'harga' => 40000, 'jumlah' => 2],
            ['id' => 26, 'penjualan_id' => 9, 'barang_id' => 6, 'harga' => 45000, 'jumlah' => 1],
            ['id' => 27, 'penjualan_id' => 9, 'barang_id' => 7, 'harga' => 20000, 'jumlah' => 3],
        
            // Penjualan 10 (TRX-0010)
            ['id' => 28, 'penjualan_id' => 10, 'barang_id' => 8, 'harga' => 55000, 'jumlah' => 1],
            ['id' => 29, 'penjualan_id' => 10, 'barang_id' => 9, 'harga' => 60000, 'jumlah' => 2],
            ['id' => 30, 'penjualan_id' => 10, 'barang_id' => 10, 'harga' => 75000, 'jumlah' => 1],
        ];
        DB::table('t_penjualan_detail')->insert($data);
    }
}
