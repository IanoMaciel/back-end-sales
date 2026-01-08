<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subcategory extends Model {
    public $timestamps = false;
    protected $fillable = ['subcategory', 'category_id'];

    # relationships
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
