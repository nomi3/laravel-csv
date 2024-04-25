<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInsuredRequest;
use App\Http\Requests\UpdateInsuredRequest;
use App\Usecases\Insured\Index;
use App\Usecases\Insured\Store;

class InsuredController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        Index $usecase
    ) {
        return view('insureds.index', [
            'insureds' => $usecase(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('insureds.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreInsuredRequest $request,
        Store $usecase
    ) {
        $usecase($request->file('csv_file'));

        return redirect()->route('insureds.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insured $insured)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insured $insured)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInsuredRequest $request, Insured $insured)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insured $insured)
    {
        //
    }
}
