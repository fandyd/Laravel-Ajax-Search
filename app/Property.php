<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades;

class Property extends Model
{
    public function getColumnNames(){
        return Facades\Schema::getColumnListing('properties');
    }
}
