<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Complaint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id',
        'response',
        'user_id',
    ];

    // public function complaints(){
    //     return $this->belongsTo(Complaint::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
