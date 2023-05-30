<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use App\Models\Anggota;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Berita;
use App\Models\Catalog;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Produk;
use App\Models\Sponsor;
use App\Models\Umkm;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    //

    public function getSponsor()
    {
        return response()->json(Sponsor::all());
    }

    public function getBanner()
    {
        return response()->json(Banner::all());
    }

    public function getDetailKatalog($id){
        $katalog = Catalog::with('fotos')->find($id);
        return response()->json($katalog);

    }

    public function getKatalogbyJenis($jenis){
        $katalog = Catalog::with('fotos')->where('jenis_catalog_id', $jenis)->get();
        return response()->json($katalog);

    }

    public function getKatalog(){
        $katalog = Catalog::with('fotos')->get();
        return response()->json($katalog);

    }

    public function getArtikel(){
        return response()->json(Article::all());
    }

    public function getDetailArtikel($id){
        return response()->json(Article::find($id));
    }

    public function check_user(Request $request)
    {

        $credential = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user == null) {
            return response()
                ->json([
                    'success' => false,
                    'message' => "Email Belum Terdaftar"
                ],402);
        } else {

            if ($user->is_verified == 1) {
                if (Auth::attempt($credential)) {
                    return response()
                        ->json([
                            'success' => true,
                            'message' => $user
                        ],200);
                } else {
                    return response()
                        ->json([
                            'success' => false,
                            'message' => "Username Atau Password Salah"
                        ],402);
                }
            } else {
                return response()
                    ->json([
                        'success' => false,
                        'message' => "Email Belum Terverifikasi"
                    ],402);
            }
        }
    }

    public function register(Request $request)
    {

        $emailExists = User::where('email', $request->email)->exists();

        if ($emailExists) {
            return response()
            ->json([
                'success' => false,
                'message' => "Email Sudah Terdaftar"
            ], 422);
        }else{
           
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'nama' => 'required',
                'nohp' => 'required',
            ]);
        
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }

            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'nama' => $request->nama,
                'nohp' => $request->nohp,
                'verification_token' =>Str::random(40)
            ]);
    
            $user->save();
    
            Mail::to($user->email)->send(new VerificationEmail($user));
    
            // Kirim email verifikasi ke pengguna
    
            return response()->json(['success' => true, 'message' => 'Registration successful. Please check your email for verification.'], 200);
        }

       
    }

  


   
}
