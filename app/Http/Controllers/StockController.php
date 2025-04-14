<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\UserModel;
use App\Models\StockModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Stock',
            'list' => ['Home', 'Stock']
        ];

        $page = (object) [
            'title' => 'Data Stock yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user';

        $stock = StockModel::with('barang.kategori')->get();

        return view('stock.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stock' => $stock, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
{
    $query = StockModel::with('barang.kategori');

    if ($request->kategori_id) {
        $query->whereHas('barang', function ($q) use ($request) {
            $q->where('kategori_id', $request->kategori_id);
        });
    }

    return datatables()->of($query)
        ->addIndexColumn()
        ->addColumn('kategori_nama', function ($row) {
            return $row->barang->kategori->kategori_nama ?? '-';
        })
        ->addColumn('aksi', function ($row) {
            return '<a href="#" class="btn btn-sm btn-primary">Detail</a>';
        })
        ->rawColumns(['aksi']) // kalau pakai HTML
        ->make(true);
}
}