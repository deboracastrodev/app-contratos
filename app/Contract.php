<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    const PESSOA_FISICA = 'F';
    const PESSOA_JURIDICA = 'J';
    
    protected $table = 'contract';

	protected $dates = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];

    protected $fillable = [
        'type_person', 
        'name', 
        'email_contract', 
        'property_id', 
        'document',
        'uuid'
    ];

    public function property()
    {
        return $this->belongsTo('App\Property', 'property_id', 'id');
    }

    public function parentable()
    {
        return $this->morphTo();
    }
}
