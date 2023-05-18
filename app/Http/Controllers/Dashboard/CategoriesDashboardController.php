<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

class CategoriesDashboardController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage') ?? 25;

        $categories = Category::paginate($perPage)->setPath('categories');

        return view('pages.category.index', [ 'categories' => $categories]);
    }
}
