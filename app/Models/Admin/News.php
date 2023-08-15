<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'image',
        'sector'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sector()
    {
        if ($this->sector == 1) {
            return 'Penegakan Peraturan Perundang Undangan Daerah';
        }
    }
}
