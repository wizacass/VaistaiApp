<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    private $validators = ['required', 'min:3', 'max:64'];

    public function index()
    {
        $positions = DB::select('SELECT * FROM Vaistininko_Pareigos');

        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'title' => $this->validators,
        ]);

        DB::insert('INSERT INTO Vaistininko_Pareigos (name) VALUES (?)', [
            $attributes['title']
        ]);

        return redirect('positions');
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

    public function update(Request $request, $id)
    {
        $attributes = request()->validate([
            'title' => $this->validators,
        ]);

        DB::update('UPDATE Vaistininko_Pareigos SET name = ? WHERE id_Vaistininko_Pareigos = ?', [
            $attributes['title'],
            $id
        ]);

        return redirect('positions');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM Vaistininko_Pareigos WHERE id_Vaistininko_Pareigos = ?', [$id]);

        return redirect('positions');
    }
}
