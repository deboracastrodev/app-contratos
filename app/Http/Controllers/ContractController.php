<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\ContractRequest;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::all()->toArray();
        return array_reverse($contracts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request)
    {
        $request->validate();

        $contract = new Contract([
            'name' => $request->input('name'),
            'type_person' => $request->input('type_person'),
            'email_contract' => $request->input('email_contract'),
            'document' => $request->input('document'),
            'property_id' => $request->input('property_id'),
            'uuid' => (string) Str::uuid(),
            ]);

        $contract->save();
        
        return response()->json('Contrato cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  integer/string  $id 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = Contract::find($id);
        return response()->json($contract);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer/string  $id 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = Contract::find($id);
        $properties = Property::all();

        return response()->json(['contract' => $contract, 'properties' =>  $properties]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer/string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contract = Contract::find($id);
        $contract->update($request->all());

        return response()->json('Contrato editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer/string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
    }
}
