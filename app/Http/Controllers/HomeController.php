<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Tag;

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
	$tags = Tag::limit(5)->get();
        return view('home', ["tags" => $tags]);
    }
}
