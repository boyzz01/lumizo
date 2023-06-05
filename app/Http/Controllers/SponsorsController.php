<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SponsorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsor = Sponsor::all();
        return view('sponsor',['sponsor'=>$sponsor]);
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
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        $sponsor = new Sponsor();
        $sponsor->name = $request->name;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/sponsors/' . $filename);
            Image::make($image->getRealPath())->resize(300, 300)->save($path);
            $sponsor->image = 'uploads/sponsors/' . $filename;
        }
    
        $sponsor->save();
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
        $sponsor = Sponsor::find($id);
        return response()->json($sponsor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sponsor = Sponsor::find($id);
        return response()->json($sponsor);
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
    
        $sponsor = Sponsor::find($id);
        $sponsor->name = $request->name;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/sponsors/' . $filename);
            Image::make($image->getRealPath())->resize(300, 300)->save($path);
            $sponsor->image = 'uploads/sponsors/' . $filename;
        }
    
        $sponsor->save();
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
        $sponsor = Sponsor::findOrFail($id);
        
        // Hapus file gambar jika ada
        if (!empty($sponsor->image)) {
            $imagePath = public_path('uploads/sponsors/' . $sponsor->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        $sponsor->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

}
