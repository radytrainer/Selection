<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'Candidate_Name','province', 'grade', 'years','ngo_id','profile'
    ];


    public function answers()
    {
        return $this->belongsToMany(Answer::class);
    }
    public function ngos()
    {
        return $this->belongsTo(Ngo::class);
    }
    public $timestamps = false;

}
