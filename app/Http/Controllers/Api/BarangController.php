<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TblBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $barang = TblBarang::select('id', 'kode_barang', 'nama_barang', 'desc')->limit($request->number)->orderBy('id', 'asc')->paginate($request->number);

        return response()->json($barang, 200);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'desc' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 'barang',
                'message' => $validator->errors()
            ], 400);
        }

        TblBarang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'desc' => $request->desc,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data',
        ], 201);
    }

    public function show($id)
    {
        $barang = TblBarang::select('id', 'kode_barang', 'nama_barang', 'desc')->where('id'. $id)->first();
        if($barang->count() > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => $barang
            ], 200);
        }
        else {
            return response()->json([
                'success' => false,
                'code' => 'barang',
                'message' => 'Data tidak ditemukan atau terjadi kesalahan',
            ], 404);
        }
    }

    public function edit($id)
    {
        $barang = TblBarang::select('id', 'kode_barang', 'nama_barang', 'desc')->where('id', $id)->first();
        if($barang->count() > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengambil data',
                'data' => $barang
            ], 200);
        }
        else {
            return response()->json([
                'success' => false,
                'code' => 'barang',
                'message' => 'Data tidak ditemukan atau terjadi kesalahan',
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $barang = TblBarang::where('id', $id);
        if($barang->get()->count() == 0) {
            return response()->json([
                'success' => false,
                'code' => 'barang',
                'message' => 'Data tidak ditemukan atau terjadi kesalahan',
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'desc' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 'barang',
                'message' => $validator->errors()
            ], 400);
        }

        $barang->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'desc' => $request->desc,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengubah data'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = TblBarang::where('id', $id);
        if($barang->get()->count() == 0) {
            return response()->json([
                'success' => false,
                'code' => 'barang',
                'message' => 'Data tidak ditemukan atau terjadi kesalahan',
            ], 400);
        }

        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data',
        ], 200);
    }
}
