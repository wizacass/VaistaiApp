<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PharmaceuticalNetwork;

class PharmaceuticalNetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $networks = DB::select('select * from DIDMENA');

        return view('ph_network.index', compact('networks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ph_network.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attributes = $this->validateParameters();

        DB::insert('INSERT INTO DIDMENA (pavadinimas, salis, adresas) VALUES (?, ?, ?)', [
            $attributes['name'],
            $attributes['country'],
            $attributes['address']
        ]);

        return redirect('/networks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $network = DB::select('SELECT * FROM DIDMENA WHERE pavadinimas = ?', [$id])[0];

        return view('ph_network.edit', compact('network'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($id);

        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = DB::delete('DELETE FROM DIDMENA where pvadinimas = ?', [$id]);

        dd($deleted);
    }

    private function validateParameters()
    {
        $validators = ['required', 'min:3', 'max:255'];

        return request()->validate([
            'name' => $validators,
            'country' => $validators,
            'address' => $validators
        ]);
    }
}
