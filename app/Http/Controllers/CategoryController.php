<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5);
        $totalCategories = Category::count();
        $activeCategories = Category::where('is_active' , true)->count();
        $inactiveCategories = Category::where('is_active' , false)->count();
        $parentCategories = Category::whereNull('parent_id')->count();

        return view('categories.index', compact('categories', 'totalCategories', 'activeCategories', 'inactiveCategories', 'parentCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('categories.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $xx = Storage::putFile('public/categories_images', $request->file('image'));

        $data['image'] = $xx;

        Category::create($data);

        flash()->options(["position" => "bottom-right"])->success('Category created successfully.');

        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('categories.edit',compact('category' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if($request->hasfile('image')){
            $request->validate(['image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
            Storage::delete($category->image);
            $xx = Storage::putFile('public/categories_images', $request->file('image'));
            $category->update(['image' => $xx]);
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug'.$category->id,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'is_active' => 'boolean'
        ]);

        $category->update($data);
        flash()->options(["position" => "bottom-right"])->success('Category updated successfully.');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Storage::delete($category->image);
        $category->delete();
        flash()->options(["position" => "bottom-right"])->success('Category deleted successfully.');
        return redirect()->route('admin.category.index');
    }
}
