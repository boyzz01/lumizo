<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SponsorController extends Controller
{
    //
    public function index(){

        $sponsor = Sponsor::all();
        return view('sponsor',['sponsor'=>$sponsor]);
    }

    public function save(Request $request){

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
}
