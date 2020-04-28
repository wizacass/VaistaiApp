<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    private $validators = ['required', 'min:3', 'max:255'];

    public function index()
    {
        $positions = DB::select('SELECT * FROM Vaistininko_Pareigos');

        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return redirect('positions/index');
    }

    public function edit($id)
    {
        $position = DB::select('SELECT * FROM Vaistininko_Pareigos WHERE id_Vaistininko_Pareigos = ?', [$id])[0];

        return view('positions.edit', compact('position'));
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
