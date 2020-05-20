<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function show(Request $request)
    {
        dd($request);
        dd('I display an actual report!');
    }
}
