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

    public function show($id) { return redirect('employees'); }

    public function edit($id)
    {
        $employee = DB::select('SELECT * FROM DARBUOTOJAS WHERE id = ?', [$id])[0];
        $positions = DB::select('SELECT * FROM Vaistininko_Pareigos');
        $networks = DB::select('SELECT pavadinimas FROM TINKLAS');

        return view('employee.edit', compact('employee', 'positions', 'networks'));
    }

    public function update(Request $request, $id)
    {
        $attributes = request()->validate([
            'name' => $this->nameValidators,
            'surname' => $this->nameValidators,
            'seniority' => ['required', 'integer', 'min:0', 'max:100'],
            'position' => ['required', 'integer']
        ]);

        DB::update('UPDATE DARBUOTOJAS SET vardas = ?, pavarde = ?, darbo_stazas = ?, pareigos = ?, fk_TINKLASpavadinimas = ? WHERE id = ?', [
            $attributes['name'],
            $attributes['surname'],
            $attributes['seniority'],
            $attributes['position'],
            $request->network,
            $id
        ]);

        return redirect('employees');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM DARBUOTOJAS WHERE id = ?', [$id]);

        return redirect('employees');
    }
}
