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

    public function show($id)
    {
        $factory = DB::select('SELECT * FROM FABRIKAS WHERE pavadinimas = ?', [$id])[0];
        $customers = DB::select('SELECT fk_DIDMENApavadinimas FROM DIDMENA_FABRIKAS WHERE fk_FABRIKASpavadinimas = ? ', [$id]);

        return view('factory.show', compact('factory', 'customers'));
    }

    public function edit($id)
    {
        $factory = DB::select('SELECT * FROM FABRIKAS WHERE pavadinimas = ?', [$id])[0];
        $customers = DB::select('SELECT pavadinimas FROM DIDMENA');
        $activeCustomers = $this->getActiveCustomerNames($id);

        return view('factory.edit', compact('factory', 'customers', 'activeCustomers'));
    }

    public function update(Request $request, $id)
    {
        $attributes = request()->validate([
            'country' => $this->validators,
            'email' => ['nullable', 'email', 'max:255']
        ]);

        $this->cleanCustomers($id);
        foreach($request->customers as $customer)
        {
            DB::insert("INSERT INTO DIDMENA_FABRIKAS (fk_DIDMENApavadinimas, fk_FABRIKASpavadinimas) VALUES (?, ?)", [
                $customer,
                $id
            ]);
        }

        DB::update('UPDATE FABRIKAS SET salis = ?, el_pastas = ? WHERE pavadinimas = ?', [
            $attributes['country'],
            $attributes['email'],
            $id
        ]);

        return redirect("factories/$id");
    }

    public function destroy($id)
    {
        $this->cleanCustomers($id);
        DB::delete('DELETE FROM FABRIKAS WHERE pavadinimas = ?', [$id]);

        return redirect('factories');
    }

    private function getActiveCustomerNames($id)
    {
        $names = [];
        $customers = DB::select('SELECT fk_DIDMENApavadinimas FROM DIDMENA_FABRIKAS WHERE fk_FABRIKASpavadinimas = ?', [$id]);
        foreach ($customers as $customer)
        {
            array_push($names, $customer->fk_DIDMENApavadinimas);
        }
        return $names;
    }

    private function cleanCustomers($id)
    {
        DB::delete('DELETE FROM DIDMENA_FABRIKAS WHERE fk_FABRIKASpavadinimas = ?', [$id]);
    }
}
