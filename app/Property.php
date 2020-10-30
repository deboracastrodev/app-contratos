<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'property';

	protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
		'deleted_at' => 'datetime',
	];

    protected $fillable = [
        'email_property',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'status'
    ];
}
