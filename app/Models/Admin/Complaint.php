<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'slug',
        'email',
        'title',
        'description',
        'status',
    ];

    public function response() {
        return $this->hasOne(Response::class, 'complaint_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
