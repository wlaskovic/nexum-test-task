<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
use App\Models\User;

class Category extends Model
{
    use HasFactory;

    public $fillable = ['name', 'parent_id'];

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'category_id', 'id');
    }

    public function hasPermission()
    {
        return $this->hasOne(CategoryUserPermission::class, 'category_id')
            ->where('user_id', auth()->id());
    }
}
