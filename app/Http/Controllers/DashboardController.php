<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {

         $user =  User::get();
        // $umkm = DB::table('umkm')->get();
        return view('dashboard',['user'=>$user]);
    }
}
