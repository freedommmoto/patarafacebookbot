<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        //$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        return view('welcome');
    }
}
