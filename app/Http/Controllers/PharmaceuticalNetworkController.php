<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PharmaceuticalNetworkController extends Controller
{
    public function index()
    {
        $networks = DB::select('SELECT * FROM TINKLAS');

        return view('ph_network.index', compact('networks'));
    }

    public function create()
    {
        return view('ph_network.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'year' => ['required', 'integer', 'min:1900', 'max:2020']
        ]);

        DB::insert('INSERT INTO TINKLAS (pavadinimas, vaistiniu_skaicius, ikurimo_metai) VALUES (?, 0, ?)', [
            $attributes['name'],
            $attributes['year']
        ]);

        return redirect('/networks');
    }

    public function show($id) { }

    public function edit($id)
    {
        $network = DB::select('SELECT * FROM TINKLAS WHERE pavadinimas = ?', [$id])[0];

        return view('ph_network.edit', compact('network'));
    }

    public function update($id)
    {
        $attributes = request()->validate([
            'year' => ['required', 'integer', 'min:1900', 'max:2020']
        ]);

        DB::update('UPDATE TINKLAS SET ikurimo_metai = ? WHERE pavadinimas = ?', [
            $attributes['year'],
            $id
        ]);

        return redirect('/networks');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM TINKLAS WHERE pavadinimas = ?', [$id]);

        return redirect('/networks');
    }
}
