<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlantProductController extends Controller
{
    public function index()
    {
        $data = DB::table('m_plant as p')
            ->join('m_plant_product as pp', 'pp.id_plant', '=', 'p.id')
            ->join('m_product as prod', 'prod.id', '=', 'pp.id_product')
            ->select('p.kode as plant', DB::raw('GROUP_CONCAT(prod.name ORDER BY prod.name SEPARATOR ", ") as products'))
            ->groupBy('p.kode')
            ->orderByDesc('p.kode')
            ->get();

        $plants = DB::table('m_plant')->get();
        $products = DB::table('m_product')->get();

        return view('plant_product.index', compact('data', 'plants', 'products'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_plant' => 'required|exists:m_plant,id',
            'id_product' => 'required|exists:m_product,id',
        ]);

        // Cek apakah data sudah ada
        $exists = DB::table('m_plant_product')
            ->where('id_plant', $request->id_plant)
            ->where('id_product', $request->id_product)
            ->exists();

        if ($exists) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Data sudah ada untuk kombinasi plant dan produk tersebut.'
                ], 409);
            } else {
                return redirect()->back()->with('error', 'Data sudah ada untuk kombinasi plant dan produk tersebut.');
            }
        }

        // Simpan ke database
        DB::table('m_plant_product')->insert([
            'id_plant' => $request->id_plant,
            'id_product' => $request->id_product,
            'file_url' => null,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Data berhasil ditambahkan.'
            ]);
        } else {
            return redirect()->route('plant_product.index')->with('success', 'Data berhasil ditambahkan.');
        }
    }
}
