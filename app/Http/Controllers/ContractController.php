<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    public function store(Request $request)
    {
        $validators = [
            'name' => 'required|string',
            'type_person' => 'required|string',
            'property_id' => [
                'required',
                'integer',
                'exists:property,id',
            ],
            'email_contract' => 'required|email|min:3|max:140',
            'document' => $request->input('type_person') && $request->input('type_person') == 'F' ? 'required|string|min:11|max:11' : 'required|string|min:14:max:14',
        ];

        $request->validate($validators);

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
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
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
