<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        dd('I display report selection!');
    }

    public function show(Request $request)
    {
        dd('I display an actual report!');
    }
}
