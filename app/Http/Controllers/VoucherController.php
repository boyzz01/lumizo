<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::all();
        return view('voucher', ['vouchers' => $vouchers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $voucher = new Voucher();
        $voucher->nama = $request->name;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Resize the image
            $resizedImage = Image::make($image)->fit(800, 320);
            
            // Save the resized image to the storage disk
            Storage::disk('public')->put('voucher/' . $filename, $resizedImage->encode());
            
            // Set the image filename to the voucher model
            $voucher->image = $filename;
        }
        $voucher->save();
       // echo  $voucher->image."a";
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
        $data = Voucher::find($id);
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
        $data = Voucher::find($id);
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
        $voucher = Voucher::find($id);
        $voucher->nama = $request->name;
        $voucher->isactive = $request->isactive;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Resize the image
            $resizedImage = Image::make($image)->fit(800, 320);
            
            // Save the resized image to the storage disk
            Storage::disk('public')->put('voucher/' . $filename, $resizedImage->encode());
            
            // Set the image filename to the voucher model
            $voucher->image = $filename;
        }
        $voucher->save();
       // echo  $voucher->image."a";
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
        $data = Voucher::findOrFail($id);
        
        // Hapus file gambar jika ada
        if (!empty($data->image)) {
            Storage::disk('public')->delete('voucher/' . $data->image);
        }
        
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
