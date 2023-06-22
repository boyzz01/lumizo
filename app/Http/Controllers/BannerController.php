<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Banner::all();
        return view('banner',['data'=>$data]);
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
        //
        $request->validate([
            'title' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $banner = new Banner();
        $banner->title = $request->title;
    
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $compressedImage = Image::make($image)->encode('jpg', 75);
            $name = time().'.'.$compressedImage->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $compressedImage->move($destinationPath, $name);
            $banner->photo = $name;
        }
    
        $banner->save();
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
        $data = Banner::find($id);
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
        $data = Banner::find($id);
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

       

        $banner = Banner::find($id);
        $banner->title = $request->title;
    
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $compressedImage = Image::make($image)->encode('jpg', 75);
            $name = time().'.'.$compressedImage->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $compressedImage->move($destinationPath, $name);
            $banner->photo = $name;
        }
    
        $banner->save();
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
        $sponsor = Banner::findOrFail($id);
        
        // Hapus file gambar jika ada
        if (!empty($sponsor->image)) {
            Storage::delete('/images' . $sponsor->photo);
        }
        
        $sponsor->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
