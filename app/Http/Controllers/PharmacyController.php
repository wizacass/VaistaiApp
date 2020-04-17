<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmacies = DB::select('SELECT * FROM VAISTINE');

        return view('pharmacy.index', compact('pharmacies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('I register Pharmacies');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pharmacy = DB::select('SELECT * FROM VAISTINE WHERE filialo_id = ?', [$id])[0];
        $employees = DB::select('SELECT * FROM DARBUOTOJAS WHERE fk_VAISTINEfilialo_id = ?', [$pharmacy->filialo_id]);
        $registers = DB::select('SELECT * FROM KASA WHERE fk_VAISTINEfilialo_id = ?', [$pharmacy->filialo_id]);
        $drugs = DB::select('SELECT * FROM VAISTAS WHERE fk_VAISTINEfilialo_id = ?', [$pharmacy->filialo_id]);

        // dd($pharmacy, $employees, $registers, $drugs);

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
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
