<?php

namespace App\Http\Controllers;

use App\Mail\VerificationEmail;
use App\Models\Anggota;
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
        $katalog = Catalog::with(['fotos' => function ($query) {
            $query->select('path');
        }])->find($id);
        return response()->json($katalog);

    }

   
}
