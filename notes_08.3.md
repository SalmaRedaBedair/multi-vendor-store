# add relation many to many
```php
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tags'));

        $tags=explode(',', $request->post('tags'));
        $tag_ids=[];

        foreach($tags as $t_name)
        {
            $slug=Str::slug($t_name);
            $tag=Tag::where('slug',$slug);
            if(!$tag){
                $tag=Tag::create([
                    'name'=>$t_name,
                    'slug'=>$slug
                ]);
            }

            $tag_ids[]=$tag->id;
        }

        $product->tags()->sync($tag_ids); // use to add relation many to many

        return redirect()->route('categories.index')->with('success','Product updated.');
    }
```

# collection
- we use it instead of using quiries in data base many times 
```php
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tags'));

        $tags=explode(',', $request->post('tags'));
        $tag_ids=[];

        $saved_tags=Tag::all();

        foreach($tags as $t_name)
        {
            $slug=Str::slug($t_name);
            $tag=$saved_tags->where('slug',$slug)->first();
            // that replace that 
            // $tage=Tag::where('slug',$slug)->first();
            if(!$tag){
                $tag=Tag::create([
                    'name'=>$t_name,
                    'slug'=>$slug
                ]);
            }

            $tag_ids[]=$tag->id;
        }

        $product->tags()->sync($tag_ids); // use to add relation many to many

        return redirect()->route('products.index')->with('success','Product updated.');
    }
```