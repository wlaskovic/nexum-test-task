<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    public $fillable = ['name', 'parent_id'];

    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'category_id', 'id');
    }

    public function hasPermission(): HasOne
    {
        return $this->hasOne(CategoryUserPermission::class, 'category_id')
            ->where('user_id', auth()->id());
    }
}
