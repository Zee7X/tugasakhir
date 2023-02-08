<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakCuti extends Model
{
    use HasFactory;
    protected $table = 'hak_cuti';

    protected $fillable = [
        'id',
        'user_id',
        'hak_cuti',
        'created_at',
        'updated_at'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function ReportCuti(){
        return $this->hasmany(ReportCuti::class);
    }
}
