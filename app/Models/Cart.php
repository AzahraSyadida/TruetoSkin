<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'products_id', 'users_id'
    ];

    protected $hidden = [
        // You can specify any attributes here that should be hidden when the model is converted to an array or JSON.
    ];

    /**
     * Define the relationship between Cart and Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }

    /**
     * Define the relationship between Cart and User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id','id');
    }
}
