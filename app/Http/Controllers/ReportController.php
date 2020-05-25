<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $networks = DB::select('SELECT TINKLAS.pavadinimas FROM TINKLAS');

        return view('report.index', compact('networks'));
    }

    public function show(Request $request)
    {
        dd($request);
        dd('I display an actual report!');
    }
}
