<?php 
 
namespace App\Models; 
 
use Illuminate\Database\Eloquent\Model; 
 
class ProductGallery extends Model 
{ 
    protected $fillable = [ 
        'photos', 'products_id' 
    ]; 
 
    protected $hidden = [ 
        // You can specify any attributes here that should be hidden when the model is converted to an array or JSON. 
    ]; 
 
    /** 
     * Define the relationship between ProductGallery and Product. 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo 
     */ 
    public function product() 
    { 
        return $this->belongsTo(Product::class, 'products_id', 'id'); 
    } 
}