<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function material()
    {
        return $this->hasMany(material::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($supplier) {
            $supplier->id_supplier = 'SUPP-' . str_pad(static::count() + 1, 3, '0', STR_PAD_LEFT);
        });
    }
}
