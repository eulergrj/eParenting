<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewHistory extends Model
{
    use HasFactory;


    public function rating(){
        return $this->belongsTo(Rating::class, 'ratings_id');
    }

    public function platform(){
        return $this->belongsTo(Platform::class, 'platforms_id');
    }
    
    public function member(){
        return $this->belongsTo(FamilyMember::class, 'family_member_id');
    }
    
    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function genres(){
        return $this->hasMany(Genre::class);
    }
}
