<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\FotoCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoCatalogController extends Controller
{
    //
    public function store(Request $request)
    {
        // $request->validate([
        //     'foto' => 'required|image|max:5120', // maksimum 5MB
        // ]);

        // $file =$request->file('foto');
        // $filename = time() . '_' . $file->getClientOriginalName();
        // $filepath = $file->storeAs('public/catalog', $filename);

        // $foto = new FotoCatalog();
        // $foto->catalog_id = $request->catalog_id;
        // $foto->path = $request->file('foto')->store('public/catalog');
        // $foto->save();

       // return response()->json(['path' => $filepath]);
       return response()->json($request->foto);
    }

    public function show($id)
    {
        $foto = FotoCatalog::findOrFail($id);
        $url = Storage::url($foto->path);
        $data = base64_encode(Storage::get($foto->path));

        return response()->json($data);
    }

    public function getCatalogFotos($id)
    {
        $catalog = Catalog::findOrFail($id);
        $fotos = $catalog->fotos()->select('id', 'path')->get();

        $response = [];
        foreach ($fotos as $foto) {
            $response[] = [
                'id' => $foto->id,
                'path' => $foto->path,
                'size' => filesize(public_path('storage/catalog/' . $foto->path)),
                'name' => basename($foto->path),
            ];
        }

        return response()->json([
            'fotos' => $response
        ]);
    }

    

    public function destroy($id)
    {
        $foto = FotoCatalog::findOrFail($id);
        Storage::delete(public_path('storage/catalog/' . $foto->path));
        $foto->delete();

        return response()->json(['success' => true]);
    }
}
