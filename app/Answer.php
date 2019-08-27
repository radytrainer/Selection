<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function candidates()
    {
        return $this->belongsToMany(Candidate::class);
    }
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
