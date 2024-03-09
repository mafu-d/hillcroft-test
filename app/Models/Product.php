<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'price_ex_vat',
        'price_inc_vat',
        'stock',
        'short_description',
    ];

    protected $primaryKey = 'code';

    protected $keyType = 'string';

    public $incrementing = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
