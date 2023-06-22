<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DealController extends Controller
{
    public function index()
    {
        //
        $data = Deal::all();
        return view('deal',['data'=>$data]);
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ], [
            'photo.max' => 'File terlalu besar. Maksimum 1 MB yang diperbolehkan.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'File terlalu besar. Maksimum 1 MB yang diperbolehkan.');
        }


        $deal = new Deal();
        $deal->title = $request->title;
    
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $deal->photo = $name;
        }
    
        $deal->save();
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
        $data = Deal::find($id);
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
        $data = Deal::find($id);
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

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ], [
            'photo.max' => 'File terlalu besar. Maksimum 1 MB yang diperbolehkan.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'File terlalu besar. Maksimum 1 MB yang diperbolehkan.');
        }

        $deal = Deal::find($id);
        $deal->title = $request->title;
    
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $deal->photo = $name;
        }
    
        $deal->save();
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
        $sponsor = Deal::findOrFail($id);
        
        // Hapus file gambar jika ada
        if (!empty($sponsor->image)) {
            Storage::delete('/images' . $sponsor->photo);
        }
        
        $sponsor->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
