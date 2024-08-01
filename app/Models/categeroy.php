<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categeroy extends Model
{
    use HasFactory;

    public $table = 'categories';
    public $primarykey = 'id';
    public $timestemp = false;

    public function tattoos()
    {
        return $this->hasMany(tatttoo::class, 'id');
    }
    
}
