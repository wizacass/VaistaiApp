<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $nameValidators = ['required', 'min:3', 'max:255'];

    public function index()
    {
        $employees = DB::select('SELECT * FROM DARBUOTOJAS INNER JOIN Vaistininko_Pareigos ON DARBUOTOJAS.pareigos = Vaistininko_Pareigos.id_Vaistininko_Pareigos ORDER BY DARBUOTOJAS.id');

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
        $attributes = request()->validate([
            'name' => $this->nameValidators,
            'surname' => $this->nameValidators,
            'seniority' => ['required', 'integer', 'min:0', 'max:100'],
            'position' => ['required', 'integer']
        ]);

        DB::insert('INSERT INTO DARBUOTOJAS (vardas, pavarde, darbo_stazas, pareigos, fk_TINKLASpavadinimas) VALUES (?, ?, ?, ?, ?)', [
            $attributes['name'],
            $attributes['surname'],
            $attributes['seniority'],
            $attributes['position'],
            $request->network
        ]);

        return redirect('employees');
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
        dd('I edit employee!');
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
