<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCuti extends Model
{
    use HasFactory;
    protected $table = 'report_hak_cuti';
    protected $fillable = [
        'id',
        'user_id',
        'report_hak_cuti',
        'status',
        'created_at',
        'updated_at'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function HakCuti(){
        return $this->hasmany(HakCuti::class);
    }
}
