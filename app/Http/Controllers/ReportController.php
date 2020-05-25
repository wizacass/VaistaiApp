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
        $attributes = request()->validate([
            'network' => ['required'],
            'from' => ['required', 'integer', 'min:0'],
            'to' => ['required', 'integer', 'gte:from']
        ]);

        $network = $attributes['network'];

        //dd($attributes);

        return view('report.show', compact('network'));
    }
}
