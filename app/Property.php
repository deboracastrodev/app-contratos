<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'property';

    protected $fillable = ['email_property', 'street', 'number', 'complement', 'neighborhood', 'city', 'state', 'status'];
}
