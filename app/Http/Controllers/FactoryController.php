<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    private $validators = ['required', 'min:3', 'max:255'];

    public function index()
    {
        $factories = DB::select('SELECT * FROM FABRIKAS');

        return view('factory.index', compact('factories'));
    }

    public function create()
    {
        return view('factory.create');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => $this->validators,
            'country' => $this->validators,
            'email' => ['nullable', 'email', 'max:255']
        ]);

        DB::insert('INSERT INTO FABRIKAS (pavadinimas, salis, el_pastas) VALUES (?, ?, ?)', [
            $attributes['name'],
            $attributes['country'],
            $attributes['email'],
        ]);

        return redirect('factories');
    }

    public function show($id)
    {
        $factory = DB::select('SELECT * FROM FABRIKAS WHERE pavadinimas = ?', [$id])[0];
        $customers = DB::select('SELECT fk_DIDMENApavadinimas FROM DIDMENA_FABRIKAS WHERE fk_FABRIKASpavadinimas = ? ', [$id]);

        return view('factory.show', compact('factory', 'customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM FABRIKAS WHERE pavadinimas = ?', [$id]);

        return redirect('factories');
    }
}
