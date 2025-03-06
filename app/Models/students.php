<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Students extends Model
{
    use HasFactory;

    protected $table = 'students'; // Explicitly define the table name
    protected $fillable = ['name', 'age', 'gender', 'address'];
    
    // protected $fillable = [
    //     'name',
    //     'age',
    //     'gender',
    //     'address',
    // ];
}