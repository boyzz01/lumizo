<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\FotoCatalog;
use App\Models\JenisCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jenisCatalogs = JenisCatalog::where('id', '=', 9)->first();
        $catalogs = Catalog::where('jenis_catalog_id', $jenisCatalogs->id)->with('fotos')->get();
        return view('rumahuni', compact('catalogs', 'jenisCatalogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $validatedData = $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'foto_catalog.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jenis_catalog_id' => 'required|exists:jenis_catalog,id',
        ]);

        $catalog = Catalog::create([
            'nama' => $validatedData['nama'],
            'harga' => $validatedData['harga'],
            'deskripsi' => nl2br($validatedData['deskripsi']),
            'jenis_catalog_id' => $validatedData['jenis_catalog_id'],
        ]);



        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $filepath = $file->storeAs('public/catalog', $filename);

                FotoCatalog::create([
                    'catalog_id' => $catalog->id,
                    'path' => $filename
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Catalog::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Catalog::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'jenis_catalog_id' => 'required|exists:jenis_catalog,id',
        ]);

        $catalog = Catalog::findOrFail($id);
        $catalog->nama = $validatedData['nama'];
        $catalog->harga = $validatedData['harga'];
        $catalog->deskripsi = nl2br($validatedData['deskripsi']);
        $catalog->jenis_catalog_id = $validatedData['jenis_catalog_id'];
        $catalog->save();

        // $catalog->fotos()->delete();
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $filepath = $file->storeAs('public/catalog', $filename);

                FotoCatalog::create([
                    'catalog_id' => $catalog->id,
                    'path' => $filename
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $catalog = Catalog::findOrFail($id);
        foreach ($catalog->fotos as $foto) {
            Storage::delete('public/catalog/' . $foto->path);
        }
        $catalog->fotos()->delete();
        $catalog->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
