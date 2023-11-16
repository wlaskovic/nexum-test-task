<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public $document;
    public $version = 1;
    public $category_id;
    public $original_name;
    public $display_name;
    public $version_name;

    protected $fillable = [
        'category_id',
        'user_id',
        'original_name',
        'display_name',
        'version_name',
        'version',
    ];
}
