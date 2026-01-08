<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model {
    public $timestamps = false;
    protected $fillable = ['category'];

    # relationships
    public function subcategories(): HasMany {
        return $this->hasMany(Subcategory::class, 'category_id');
    }
}
