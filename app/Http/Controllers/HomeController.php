<?php

namespace App\Http\Controllers;

use App\Absen;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $commodity_count = Absen::count();


        $commodity_condition_good_count = Absen::where('condition', 1)->count();
        $commodity_condition_not_good_count = Absen::where('condition', 2)->count();
        $commodity_condition_heavily_damage_count = Absen::where('condition', 3)->count();

        $commodity_order_by_price = Absen::whereDate('created_at', today())->orderBy('created_at', 'DESC')->take(5)
            ->get();


        return view('home', compact('commodity_order_by_price', 'commodity_count', 'commodity_condition_good_count', 'commodity_condition_not_good_count', 'commodity_condition_heavily_damage_count'));
    }
}
