<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockModel extends Model
{
    protected $table = 'm_stock';

    protected $primaryKey = 'stock_id';

    public function barang()
    {
        return $this->belongsTo('App\Models\BarangModel', 'barang_id', 'barang_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_id', 'user_id');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Models\KategoriModel', 'kategori_id', 'kategori_id');
    }
}