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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
