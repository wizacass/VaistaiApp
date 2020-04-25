<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = DB::select('SELECT * FROM VAISTINE');

        return view('pharmacy.index', compact('pharmacies'));
    }

    public function create()
    {
        $networks = DB::select('SELECT TINKLAS.pavadinimas FROM TINKLAS');

        return view('pharmacy.create', compact('networks'));
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'address' => ['required', 'min:3', 'max:255'],
        ]);

        DB::insert('INSERT INTO VAISTINE (darbuotoju_skaicius, adresas, yraGamybine, telefonas, apyvarta, fk_TINKLASpavadinimas) VALUES (?, ?, ?, ?, ?, ?)', [
            0,
            $attributes['address'],
            $request->has('manufacturing'),
            $request->phone,
            0,
            $request->network
        ]);

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('I edit pharmacy!');
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
        DB::delete('DELETE FROM VAISTINE WHERE filialo_id = ?', [$id]);

        return redirect('/pharmacies');
    }
}
