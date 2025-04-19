<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome.html');
        //return view('faq.html');
    }

    public function conocenos()
    {
        return view('conocenos.html');
    }

    public function faq()
    {
        return view('faq.html');
    }

    public function dashboard()
    {
        return view('dashboard/dashboard');
    }

}

