<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'm_customer';
    protected $primaryKey = 'cust_id';
    public $timestamps = false;
}
