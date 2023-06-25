<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanModel extends Model
{
    use HasFactory;
    protected $table = 'permohonan_cuti';

    protected $fillable = [
        'alasan_cuti',
        'tgl_mulai',
        'tgl_akhir',
        'alamat_cuti',
    ];

    public function user(){
        return $this->hasmany(User::class);
    }
}
