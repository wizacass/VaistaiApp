<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = DB::select('SELECT * FROM DARBUOTOJAS INNER JOIN Vaistininko_Pareigos ON DARBUOTOJAS.pareigos = Vaistininko_Pareigos.id_Vaistininko_Pareigos');

        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $positions = DB::select('SELECT * FROM Vaistininko_Pareigos');
        $networks = DB::select('SELECT pavadinimas FROM TINKLAS');

        return view('employee.create', compact('positions', 'networks'));
    }

    public function store(Request $request)
    {
        dd($request);

        dd("I store new employee!");
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

    public function destroy($id)
    {
        DB::delete('DELETE FROM DARBUOTOJAS WHERE id = ?', [$id]);

        return redirect('employees');
    }
}
