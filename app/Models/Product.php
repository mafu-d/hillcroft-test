<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Watson\Validating\ValidatingTrait;

class Product extends Model
{
    use HasFactory;
    use ValidatingTrait;

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

    protected $rules = [
        'code' => ['required', 'string'],
        'name' => ['required', 'string'],
        'price_ex_vat' => ['required', 'numeric'],
        'price_inc_vat' => ['required', 'numeric'],
        'stock' => ['required', 'integer'],
        'short_description' => ['string'],
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
