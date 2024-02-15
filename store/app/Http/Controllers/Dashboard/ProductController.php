<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::with(['category','store'])->paginate();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product= new Product();
        $categories=Category::all()->pluck('name','id');
        $tags=$product->tags;
        return view('dashboard.products.create',compact(['product','tags','categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories=Category::all()->pluck('name','id');
        $tags=implode(',',$product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit', compact(['product','categories','tags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tags'));

        $tags = explode(',', $request->post('tags'));

        $tag_ids=[];

        $saved_tags=Tag::all();

        if(!empty($tags)){
            foreach($tags as $item)
            {
                $slug=Str::slug($item);
                $tag=$saved_tags->where('slug',$slug)->first();
                if(!$tag){
                    $tag=Tag::create([
                        'name'=>$item,
                        'slug'=>$slug
                    ]);
                }

                $tag_ids[]=$tag->id;
            }
        }

        $product->tags()->sync($tag_ids); // use to add relation many to many

        return redirect()->route('dashboard.products.index')->with('success','Product updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
