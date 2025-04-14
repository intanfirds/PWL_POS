<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\KategoriModel; // Ensure that the KategoriModel class exists in the specified namespace or update the namespace accordingly

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang'; //Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'barang_id'; //Mendefinisikan nama primary key yang digunakan
    /** 
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['barang_id','barang_kode', 'barang_nama', 'kategori_id', 'harga_jual', 'harga_beli']; //Mendefinisikan atribut yang dapat diisi secara massal

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }
}