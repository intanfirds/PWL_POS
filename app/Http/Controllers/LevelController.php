<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelModel;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    public function index()
    {
        
        $breadcrumb = (object) [
            'title' => 'Data Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Data Level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level';

        $level = LevelModel::all();

        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function list()
    {
        $levels = LevelModel::select('level_id','level_kode', 'level_name');

        return DataTables::of($levels)
        ->addIndexColumn() // untuk DT_RowIndex
        ->addColumn('kode', function ($row) {
            return $row->level_kode;
        })
        ->addColumn('nama', function ($row) {
            return $row->level_name;
        })
        ->addColumn('aksi', function ($row) {
            $btn = '<a href="'.url('/level/'.$row->level_id.'/edit').'" class="btn btn-warning btn-sm">Edit</a>';
            $btn .= '<form class="d-inline block" method="POST" action="'.url('/level/'.$row->level_id).'">' . csrf_field() . method_field('DELETE') 
            . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah anda yakin ingin menghapus data ini?\')">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // agar tombol bisa dirender sebagai HTML
        ->make(true);

    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah level baru'
        ];

        $activeMenu = 'level';

        $level = LevelModel::all();

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'level' => $level]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_name' => 'required|string|max:100',
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_name' => $request->level_name,
        ]);

        return redirect('/level')->with('success', 'Level berhasil disimpan');
    }
    
    public function edit(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Level'
        ];

        $activeMenu = 'level';

        $levels = LevelModel::all();

        return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'user' => $level, 'level' => $levels]);
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode, '.$id. ',level_id',
            'level_name' => 'required|string|max:100',
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_name' => $request->level_name,
        ]);

        return redirect('/level')->with('success', 'Data Level berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = LevelModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            LevelModel::destroy($id);
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/user')->with('error', 'Data user gagal dihapus, karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
