<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function report()
    {
        return $this->hasMany(Report::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function event()
    {
        return $this->hasMany(Event::class);
    }
}
