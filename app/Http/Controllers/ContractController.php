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
        $contracts = Contract::with('property')->get()->toArray();
        return $contracts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContractRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequest $request)
    {
        $contract = new Contract([
            'name' => $request->name,
            'type_person' => $request->type_person,
            'email_contract' => $request->email_contract,
            'document' => $request->document,
            'property_id' => $request->property_id,
            'uuid' => (string) Str::uuid(),
            ]);

        $contract->save();

        //change status of the property
        $property = Property::find($request->property_id);
        $property->status = 'S';
        $property->save();
        
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
     * @param  ContractRequest $request
     * @param  integer/string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContractRequest $request, $id)
    {
        $contract = Contract::findOrFail($id);

        //change status of the old property
        $property = $contract->property;
        $property->status = 'N';
        $property->save();

        //save contract's update
        $contract->update($request->all());

        //change status of the current property
        $propertyNew = $contract->property;
        $propertyNew->status = 'S';
        $propertyNew->save();

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
        $contract = Contract::findOrFail($id);

        //change status of the current proprety before delete the contract
        $property = $contract->property;
        $property->status = 'N';
        $property->save();

        $contract->delete();
    }
}
