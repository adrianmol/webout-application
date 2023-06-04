<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        //Artisan::queue('app:products 2022-01-01');
        // $manufacturers = Manufacturer::with('products')->where('erp_manufacturer_id', 199)->get();
        // dd($manufacturers);

        $title = 'Webout Services | Dashboard';
        //dd(Auth::user());
        return view('dashboard', ['title' => $title]);
    }
}
