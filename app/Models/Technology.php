<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Projectt;

class Technology extends Model
{
    use HasFactory;

    public function projectts(){
        return $this->belongsToMany(Projectt::class);

    }
}
