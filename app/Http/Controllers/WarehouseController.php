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

        return view('warehouse.show', compact('warehouse', 'suppliers', 'customers'));
    }

    public function edit($id)
    {
        $warehouse = DB::select('SELECT * FROM DIDMENA WHERE pavadinimas = ?', [$id])[0];
        $suppliers =  array_column(
            DB::select('SELECT pavadinimas FROM FABRIKAS'),
            'pavadinimas'
        );
        $customers =  array_column(
            DB::select('SELECT pavadinimas FROM TINKLAS'),
            'pavadinimas'
        );

        $activeSuppliers = array_column(
            DB::select('SELECT fk_FABRIKASpavadinimas FROM DIDMENA_FABRIKAS WHERE fk_DIDMENApavadinimas = ?', [$id]),
            'fk_FABRIKASpavadinimas'
        );
        $activeCustomers = array_column(
            DB::select('SELECT fk_TINKLASpavadinimas FROM DIDMENA_TINKLAS WHERE fk_DIDMENApavadinimas = ?', [$id]),
            'fk_TINKLASpavadinimas'
        );

        return view('warehouse.edit', compact(
            'warehouse',
            'suppliers',
            'customers',
            'activeSuppliers',
            'activeCustomers'
        ));
    }

    public function update(Request $request, $id)
    {
        $attributes = request()->validate([
            'country' => $this->validators,
            'address' => $this->validators
        ]);

        $this->cleanTables($id);
        foreach($request->customers as $customer)
        {
            DB::insert("INSERT INTO DIDMENA_TINKLAS (fk_DIDMENApavadinimas, fk_TINKLASpavadinimas) VALUES (?, ?)", [
                $id,
                $customer
            ]);
        }
        foreach($request->suppliers as $supplier)
        {
            DB::insert("INSERT INTO DIDMENA_FABRIKAS (fk_DIDMENApavadinimas, fk_FABRIKASpavadinimas) VALUES (?, ?)", [
                $id,
                $supplier
            ]);
        }

        DB::update('UPDATE DIDMENA SET salis = ?, adresas = ? WHERE pavadinimas = ?', [
            $attributes['country'],
            $attributes['address'],
            $id
        ]);

        return redirect("/warehouses/{$id}");
    }

    public function destroy($id)
    {
        $this->cleanTables($id);
        DB::delete('DELETE FROM DIDMENA WHERE pavadinimas = ?', [$id]);

        return redirect('/warehouses');
    }

    private function cleanTables($id)
    {
        DB::delete('DELETE FROM DIDMENA_FABRIKAS WHERE fk_DIDMENApavadinimas = ?', [$id]);
        DB::delete('DELETE FROM DIDMENA_TINKLAS WHERE fk_DIDMENApavadinimas = ?', [$id]);
    }
}
