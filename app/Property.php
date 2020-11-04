<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    const CONTRATADA = 'S';
    const NAO_CONTRATADA = 'N';

    protected $table = 'property';
    protected $hidden = ["deleted_at"];

	protected $dates = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
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

    public function contract()
    {
        return $this->hasOne('App\Contract');
    }
}
