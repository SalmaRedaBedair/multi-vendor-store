<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;
use App\Models\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = Request();

        // select a.*, b.name as parent_id
        // from categories as a
        // left join categories as b
        // on a.parent_id=b.id
        // order by a.name
        $categories = Category::with('parent')
        // ->select('categories.*')
        // ->selectRaw('(select count(*) from products where category_id=categories_id) as products_count')
        ->withCount('products')
        ->filter($request->query())
            // ->leftjoin('categories as parent', 'categories.parent_id', 'parent.id')
            // ->select([
            //     'categories.*',
            //     'parent.name as parent_name'
            // ])
            ->orderBy('categories.name')
            ->paginate();

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all()->pluck('name','id');
        $category = new Category();
        return view('dashboard.categories.create', compact(['parents', 'category']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // $request->validate(Category::rules());

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except('image');

        $data['image'] = $this->uploadImage($request);

        $category = Category::create($data);

        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = Category::findorfail($id);
        // SELECT * from categories whrere `id` <> $id and (parent_id is null or parent_id <> $parent_id)
        // to write that () i must use grouping over where
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) { // we use that use to can use $id over closure function, i can't write that function($query,$id)
                $query->wherenull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get();
        return view('dashboard.categories.edit', compact(['category', 'parents']));
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.index')
                ->with('info', 'Record not found!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        try {
            $category = Category::findorfail($id);
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.index')->with('info', 'Category not found!');
        }


        // $request->validate(Category::rules());

        $old_image = $category->image;

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request);

            // Delete the old image only if the new image is successfully uploaded
            if ($old_image) {
                Storage::disk('public')->delete($old_image);
            }
        }

        $category->update($data);

        return Redirect::route('dashboard.categories.index')->with('success', 'Category updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Category = Category::findorfail($id);
        $Category->delete();

        return Redirect::route('dashboard.categories.index')
            ->with('success', 'Category deleted!');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads', 'public');
        return $path;
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore(Request $request, $id)
    { // here i can't use route model bindig (Category $category) because it is deleted
        $category = Category::onlyTrashed()->findorfail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')->with('success', 'category restored successfully.');
    }
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findorfail($id);
        $category->forceDelete();

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->route('dashboard.categories.trash')->with('success', 'category deleted forever.');
    }
}

