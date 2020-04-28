<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    private $nameValidators = ['required', 'min:3', 'max:255'];

    public function index()
    {
        $pharmacies = DB::select('SELECT * FROM VAISTINE');

        return view('pharmacy.index', compact('pharmacies'));
    }

    public function create()
    {
        $networks = DB::select('SELECT TINKLAS.pavadinimas FROM TINKLAS');
        $positions = DB::select('SELECT * FROM Vaistininko_Pareigos');

        return view('pharmacy.create', compact('networks', 'positions'));
    }

    public function store(Request $request)
    {
        $employeeAdded =
            $request->e_name != NULL ||
            $request->e_surname != NULL ||
            $request->e_exp != NULL;

        if($employeeAdded)
        {
            $attributes = request()->validate([
                'address' => $this->nameValidators,
                'e_name' => $this->nameValidators,
                'e_surname' => $this->nameValidators,
                'e_exp' => ['required', 'integer', 'min:0', 'max:100'],
                'e_position' => ['required', 'integer']
            ]);
        }
        else
        {
            $attributes = request()->validate([
                'address' => $this->nameValidators
            ]);
        }

        DB::insert('INSERT INTO VAISTINE (darbuotoju_skaicius, adresas, yraGamybine, telefonas, apyvarta, fk_TINKLASpavadinimas) VALUES (?, ?, ?, ?, ?, ?)', [
            0,
            $attributes['address'],
            $request->has('manufacturing'),
            $request->phone,
            0,
            $request->network
        ]);

        DB::update('UPDATE TINKLAS SET vaistiniu_skaicius = vaistiniu_skaicius + 1 WHERE pavadinimas = ?', [$request->network]);

        if($employeeAdded)
        {
            $id = DB::select('SELECT LAST_INSERT_ID()')[0]->{'LAST_INSERT_ID()'};
            DB::insert('INSERT INTO DARBUOTOJAS (vardas, pavarde, darbo_stazas, pareigos, fk_TINKLASpavadinimas, fk_VAISTINEfilialo_id) VALUES (?, ?, ?, ?, ?, ?)', [
                $attributes['e_name'],
                $attributes['e_surname'],
                $attributes['e_exp'],
                $attributes['e_position'],
                $request->network,
                $id
            ]);
        }

        return redirect('/pharmacies');
    }

    public function show($id)
    {
        $pharmacy = DB::select('SELECT * FROM VAISTINE WHERE filialo_id = ?', [$id])[0];
        $employees = DB::select('SELECT DARBUOTOJAS.vardas, DARBUOTOJAS.pavarde, DARBUOTOJAS.darbo_stazas, Vaistininko_Pareigos.name FROM DARBUOTOJAS INNER JOIN Vaistininko_Pareigos ON DARBUOTOJAS.pareigos = Vaistininko_Pareigos.id_Vaistininko_Pareigos WHERE DARBUOTOJAS.fk_VAISTINEfilialo_id = ?', [$pharmacy->filialo_id]);

        $registers = DB::select('SELECT * FROM KASA WHERE fk_VAISTINEfilialo_id = ?', [$pharmacy->filialo_id]);
        $drugs = DB::select('SELECT * FROM VAISTAS WHERE fk_VAISTINEfilialo_id = ?', [$pharmacy->filialo_id]);

        return view('pharmacy.show', compact('pharmacy', 'employees', 'registers', 'drugs'));
    }

    public function edit($id)
    {
        $pharmacy = DB::select('SELECT * FROM VAISTINE WHERE filialo_id = ?', [$id])[0];

        return view('pharmacy.edit', compact('pharmacy'));
    }

    public function update(Request $request, $id)
    {
        $attributes = request()->validate([
            'address' => $this->nameValidators
        ]);

        DB::update('UPDATE VAISTINE SET adresas = ?, telefonas = ? WHERE filialo_id = ?', [
            $attributes['address'],
            $request->phone,
            $id
        ]);

        return redirect('/pharmacies');
    }

    public function destroy($id)
    {
        $network = DB::select('SELECT fk_TINKLASpavadinimas FROM VAISTINE WHERE filialo_id = ?', [$id])[0]->fk_TINKLASpavadinimas;

        DB::update('UPDATE DARBUOTOJAS SET fk_TINKLASpavadinimas = ?, fk_VAISTINEfilialo_id = ? WHERE fk_VAISTINEfilialo_id = ?', [
            NULL,
            NULL,
            $id
        ]);

        DB::delete('DELETE FROM VAISTINE WHERE filialo_id = ?', [$id]);
        if($network != NULL)
        {
            DB::update('UPDATE TINKLAS SET vaistiniu_skaicius = vaistiniu_skaicius - 1 WHERE pavadinimas = ?', [$network]);
        }

        return redirect('/pharmacies');
    }
}
