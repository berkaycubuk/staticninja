<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing');
    }
}
