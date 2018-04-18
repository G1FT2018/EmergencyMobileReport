<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PagesController extends Controller
{
    //
    public function index()
{
    return view('pages.home');
}

public function admin()
{
    return view('pages.admin');
}
public function viewMessage()
{
    return view('pages.viewMessage');
}
public function sendMessage()
{
    return view('pages.sendMessage');
}
}
