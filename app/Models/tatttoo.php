<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class tatttoo extends Model
{
    use HasFactory;

    public $timestamps = false;
    public  $table = 'tattoos';
    // protected $primarykey = 't_id';
    // public  $fillable = ['c_id', 'image', 'is_popular', 'is_featured'];
    // public $fillable = ['tattoo_image', 'thumbnail', 'c_id', 'is_popular', 'is_featured'];
    public $fillable = [
        'c_id',
        'tattoo_image',
        'thumbnail',
        'is_popular',
        'is_featured',
    ];
    


    public function category()
    {
        return $this->belongsTo(categeroy::class, 'c_id');
    }
}
