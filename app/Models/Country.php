<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_name', 
        'country_code', 
        'most_common', 
        "active"
    ];

    public function learners(){
        return $this->hasMany(Learner::class);
    }
}
