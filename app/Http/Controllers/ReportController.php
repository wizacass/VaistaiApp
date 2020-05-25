<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $networks = DB::select('SELECT TINKLAS.pavadinimas FROM TINKLAS');

        return view('report.index', compact('networks'));
    }

    public function show(Request $request)
    {
        $attributes = request()->validate([
            'network' => ['required'],
            'revenue' => ['nullable', 'integer', 'min:0'],
            'seniority' => ['nullable', 'integer', 'min:0']
        ]);

        $network = $attributes['network'];

        // $pharmacies = DB::select('SELECT * FROM VAISTINE LEFT JOIN DARBUOTOJAS ON DARBUOTOJAS.fk_VAISTINEfilialo_id = VAISTINE.filialo_id LEFT JOIN KASA ON KASA.fk_VAISTINEfilialo_id = VAISTINE.filialo_id INNER JOIN Vaistininko_Pareigos ON DARBUOTOJAS.pareigos = Vaistininko_Pareigos.id_Vaistininko_Pareigos WHERE VAISTINE.fk_TINKLASpavadinimas = ? AND VAISTINE.apyvarta >= ? AND VAISTINE.apyvarta <= ? GROUP BY VAISTINE.filialo_id ORDER BY VAISTINE.apyvarta DESC', [$network, $attributes['from'], $attributes['to']]);

        $employees = DB::select('SELECT v.filialo_id AS PharmacyID, d.id AS EmployeeID, d.vardas AS Name, d.pavarde AS Surname, vp.name AS Positon, d.darbo_stazas AS Seniority, k.modelis AS Register FROM VAISTINE v LEFT JOIN DARBUOTOJAS d ON d.fk_VAISTINEfilialo_id = v.filialo_id LEFT JOIN KASA k ON k.id_KASA = d.fk_KASAid_KASA INNER JOIN Vaistininko_Pareigos vp ON d.pareigos = vp.id_Vaistininko_Pareigos WHERE v.fk_TINKLASpavadinimas = ? AND v.apyvarta >= IFNULL(?, 0) AND d.darbo_stazas >= IFNULL(?, 0) ORDER BY v.filialo_id, d.darbo_stazas DESC', [$network, $attributes['revenue'], $attributes['seniority']]);

        dd($employees);

        return view('report.show', compact('network'));
    }
}
