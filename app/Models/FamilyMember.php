<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    public function type(){
        return $this->belongsTo(FamilyMemberType::class, 'family_member_types_id');
    }
}
