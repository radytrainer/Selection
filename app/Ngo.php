<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ngo extends Model
{
    protected $fillable =['name'];

    public function candidate()
    {
        return $this->hasMany(Ngo::class);
    }

}
