<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\UserModel;
use App\Models\StockModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $activeMenu = 'stock';

        $barang = BarangModel::with('kategori')->get();
        $kategoriUnik = $barang->unique('kategori_id');

        return view('stock.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu, 'kategoriUnik' => $kategoriUnik]);
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
                /*$btn = '<a href="'.url('/stock/'.$row->stok_id).'" class="btn btn-info btn-sm">Detail</a>';
                $btn .= '<a href="'.url('/stock/'.$row->stok_id.'/edit').'" class="btn btn-warning btn-sm">Edit</a>';
                $btn .= '<form class="d-inline block" method="POST" action="'.url('/stock/'.$row->stok_id ).'">' . csrf_field() . method_field('DELETE') 
                . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini?\')">Hapus</button></form>';
                return $btn;*/
                $btn  = '<button onclick="modalAction(\''.url('/stock/' . $row->stok_id).'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/stock/' . $row->stok_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/stock/' . $row->stok_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // kalau pakai HTML
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stock',
            'list' => ['Home', 'Stock', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Stock baru'
        ];

        $activeMenu = 'stock';

        $stock = StockModel::all();
        $barang = BarangModel::all();
        $user = UserModel::all();

        return view('stock.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'stock' => $stock, 'barang' => $barang, 'user' => $user]);
    }

    public function store(Request $request)
    {
            $request->validate([
                'barang_id' => 'required|integer',
                'user_id' => 'required|integer',
                'stok_jumlah' => 'required|integer',
                'stok_tanggal' => 'required|date',
            ]);

            StockModel::create([
                'barang_id' => $request->barang_id,
                'user_id' => $request->user_id,
                'stok_jumlah' => $request->stok_jumlah,
                'stok_tanggal' => $request->stok_tanggal,
            ]);

        return redirect('/stock')->with('success', 'Stock berhasil disimpan');
    }

    public function show($id)
    {
        $stock = StockModel::with(['barang', 'user'])->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stock',
            'list' => ['Home', 'Stock', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Stock'
        ];

        $activeMenu = 'stock';

        return view('stock.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'stock' => $stock]);
    }

    public function edit(string $id)
    {
        $stock = StockModel::find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Stock',
            'list' => ['Home', 'Stock', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Stock'
        ];

        $activeMenu = 'stock';

        return view('stock.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'barang' => $barang, 'stock' => $stock, 'user' => $user]);
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'stok_jumlah' => 'required|integer',
            'stok_tanggal' => 'required|date',
        ]);

        StockModel::find($id)->update([
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'stok_jumlah' => $request->stok_jumlah,
            'stok_tanggal' => $request->stok_tanggal,
        ]);

        return redirect('/stock')->with('success', 'Data Stock berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $check = StockModel::find($id);
        if (!$check) {
            return redirect('/stock')->with('error', 'Data Stock tidak ditemukan');
        }

        try {
            StockModel::destroy($id);
            return redirect('/stock')->with('success', 'Data Stock berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stock')->with('error', 'Data Stock gagal dihapus, karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax()
    {
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $user = UserModel::select('user_id', 'username')->get();

        return view('stock.create_ajax', [
            'barang' => $barang,
            'user' => $user
        ]);
        
    }

    public function store_ajax(Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_id' => 'required|integer',
                'user_id' => 'required|integer',
                'stok_jumlah' => 'required|integer',
                'stok_tanggal' => 'required|date',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            
            StockModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function edit_ajax($id)
    {
        $stock = StockModel::find($id);
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();
        $user = UserModel::select('user_id', 'username')->get();

        return view('stock.edit_ajax', ['stock' => $stock, 'barang' => $barang, 'user' => $user]);
    }

    public function update_ajax(Request $request, $id){
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_id' => 'required|integer',
                'user_id' => 'required|integer',
                'stok_jumlah' => 'required|integer',
                'stok_tanggal' => 'required|date',
            ];
            
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,    // respon json, true: berhasil, false: gagal
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()  // menunjukkan field mana yang error
                ]);
            }
    
            $check = StockModel::find($id);
            if ($check) {
                
                $check->update($request->all());
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else{
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax( string $id) {
        $stock = StockModel::find($id);

        return view('stock.confirm_ajax', ['stock' => $stock]);
    }

    public function delete_ajax(Request $request, $id) {
        if ($request->ajax() || $request->wantsJson()) {
            $stock = StockModel::find($id);
            if ($stock) {
                $stock->delete();   
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else{
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}