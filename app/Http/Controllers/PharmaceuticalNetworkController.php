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

    public function show($id)
    {
        $network = DB::select('SELECT * FROM TINKLAS WHERE pavadinimas = ?', [$id])[0];
        $pharmacies = DB::select('SELECT filialo_id, adresas FROM VAISTINE WHERE fk_TINKLASpavadinimas = ?', [$id]);
        if(count($pharmacies) != $network->vaistiniu_skaicius)
        {
            DB::update('UPDATE TINKLAS SET vaistiniu_skaicius = ? WHERE pavadinimas = ?', [
                count($pharmacies),
                $id
                ]);
            $network->vaistiniu_skaicius = count($pharmacies);
        }
        $suppliers = array_column(
            DB::select('SELECT fk_DIDMENApavadinimas FROM DIDMENA_TINKLAS WHERE fk_TINKLASpavadinimas = ?', [$id]),
            'fk_DIDMENApavadinimas'
        );

        // dd($network, $pharmacies, $suppliers);

        return view('ph_network.show', compact('network', 'pharmacies', 'suppliers'));
    }

    public function edit($id)
    {
        $network = DB::select('SELECT * FROM TINKLAS WHERE pavadinimas = ?', [$id])[0];
        $suppliers = array_column(
            DB::select('SELECT pavadinimas FROM DIDMENA'),
            'pavadinimas'
        );
        $activeSuppliers = array_column(
            DB::select('SELECT fk_DIDMENApavadinimas FROM DIDMENA_TINKLAS WHERE fk_TINKLASpavadinimas = ?', [$id]),
            'fk_DIDMENApavadinimas'
        );

        // dd($suppliers, $activeSuppliers);

        return view('ph_network.edit', compact('network', 'suppliers', 'activeSuppliers'));
    }

    public function update(Request $request, $id)
    {
        //  dd($request);

        $attributes = request()->validate([
            'year' => ['required', 'integer', 'min:1900', 'max:2020']
        ]);

        $this->cleanSuppliers($id);
        if($request->has('suppliers'))
        {
            foreach($request->suppliers as $supplier)
            {
                DB::insert("INSERT INTO DIDMENA_TINKLAS (fk_DIDMENApavadinimas, fk_TINKLASpavadinimas) VALUES (?, ?)", [
                    $supplier,
                    $id
                ]);
            }
        }

        DB::update('UPDATE TINKLAS SET ikurimo_metai = ? WHERE pavadinimas = ?', [
            $attributes['year'],
            $id
        ]);

        return redirect("/networks/{$id}");
    }

    public function destroy($id)
    {
        $this->cleanSuppliers($id);
        DB::delete('DELETE FROM TINKLAS WHERE pavadinimas = ?', [$id]);

        return redirect('/networks');
    }

    private function cleanSuppliers($id)
    {
        DB::delete('DELETE FROM DIDMENA_TINKLAS WHERE fk_TINKLASpavadinimas = ?', [$id]);
    }
}
