<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contract';

    protected $fillable = ['type_person', 'name', 'email_contract', 'document'];
}
