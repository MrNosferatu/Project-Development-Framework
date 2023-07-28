<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'no_telp',
        'alamat',
        'npwp',
        'bidang_usaha',
        'nama_pemilik',
        'no_telp_pemilik',
        'image',
    ];
}
