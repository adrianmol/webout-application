<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesDashboardController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage') ?? 25;

        $categories = Category::paginate($perPage)->setPath('categories');

        return view('pages.category.index', ['categories' => $categories]);
    }
}
