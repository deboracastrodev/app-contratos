<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    const PESSOA_FISICA = 'F';
    const PESSOA_JURIDICA = 'J';
    
    protected $table = 'contract';

    protected $fillable = ['type_person', 
        'name', 
        'email_contract', 
        'property_id', 
        'document',
        'uuid'
    ];
}
