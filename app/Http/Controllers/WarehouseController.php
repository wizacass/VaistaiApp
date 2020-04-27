<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    private $validators = ['required', 'min:3', 'max:255'];

    public function index()
    {
        $warehouses = DB::select('SELECT * FROM DIDMENA');

        return view('warehouse.index', compact('warehouses'));
    }

    public function create()
    {
        return view('warehouse.create');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => $this->validators,
            'country' => $this->validators,
            'address' => $this->validators
        ]);

        DB::insert('INSERT INTO DIDMENA (pavadinimas, salis, adresas) VALUES (?, ?, ?)', [
            $attributes['name'],
            $attributes['country'],
            $attributes['address']
        ]);

        return redirect('/warehouses');
    }

    public function show($id)
    {
        $warehouse = DB::select('SELECT * FROM DIDMENA WHERE pavadinimas = ?', [$id])[0];
        $suppliers = array_column(
            DB::select('SELECT fk_FABRIKASpavadinimas FROM DIDMENA_FABRIKAS WHERE fk_DIDMENApavadinimas = ?', [$id]),
            'fk_FABRIKASpavadinimas'
        );
        $customers = array_column(
            DB::select('SELECT fk_TINKLASpavadinimas FROM DIDMENA_TINKLAS WHERE fk_DIDMENApavadinimas = ?', [$id]),
            'fk_TINKLASpavadinimas'
        );

        // dd($warehouse, $suppliers, $customers);

        return view('warehouse.show', compact('warehouse', 'suppliers', 'customers'));
    }

    public function edit($id)
    {
        $warehouse = DB::select('SELECT * FROM DIDMENA WHERE pavadinimas = ?', [$id])[0];

        return view('warehouse.edit', compact('warehouse'));
    }

    public function update(Request $request, $id)
    {
        $attributes = request()->validate([
            'country' => $this->validators,
            'address' => $this->validators
        ]);

        DB::update('UPDATE DIDMENA SET salis = ?, adresas = ? WHERE pavadinimas = ?', [
            $attributes['country'],
            $attributes['address'],
            $id
        ]);

        return redirect('/warehouses');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM DIDMENA WHERE pavadinimas = ?', [$id]);

        return redirect('/warehouses');
    }
}
