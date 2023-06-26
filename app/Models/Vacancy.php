<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;
    protected $table = 'Vacancy';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'description',
        'qualification',
        'location',
        'type',
        'salary',
    ];
}
