<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;
use App\Property;
use App\Http\Requests\PropertyRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::all()->toArray();
        return array_reverse($properties);
    }

    public function getPropertiesByStatus()
    {
        $properties = Property::where('status', 'N')->get()->toArray();
        return array_reverse($properties);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PropertyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {        
        $parametros = [
            'street' => $request->street,
            'number' => $request->number,
            'complement' => $request->complement,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'status' => $request->status,
            'email_property' => $request->email_property
        ];

        $property = new Property($parametros);
        $property->save();

        return response()->json('Propriedade cadastrada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer/string  $id 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = Property::find($id);
        return response()->json($property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PropertyRequest $request
     * @param  integer/string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, $id)
    {
        $property = Property::findOrFail($id);
        $property->update($request->all());

        return response()->json('Propriedade editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer/string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $contract = Contract::where('property_id', $id)->first();
        if ($contract){
            $contract->delete();
        }
        $property->delete();
    }
}
