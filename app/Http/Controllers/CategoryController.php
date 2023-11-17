<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;

class CategoryController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = User::where('email', 'testuser@test.com')->with('categories.documents')->first();

        if ($this->user) {
            Auth::login($this->user);
        }
    }

    public function list()
    {
        $categories = Category::where('parent_id', null)->get();

        return view('index', compact('categories'));
    }
}
