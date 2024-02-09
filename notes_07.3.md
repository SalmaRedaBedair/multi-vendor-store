# route model binding & soft delete
- can't be used with restore because, route model binding find the element using `findorfail` every model has default global scope which add `when deleted_at is null` to each query
- 
```php
public function restore(Request $request, $id)
    { // here i can't use route model binding (Category $category) because it is deleted
        $category = Category::onlyTrashed()->findorfail($id); // you should use only trashed, if not used it will search on not deleted only 
        // $category = Category::findorfail($id); xxxxx not work
        $category->restore();
        $categories = Category::onlyTrashed()->paginate();
        return redirect()->route('categories.trash', compact('categories'))->with('success', 'category restored successfully.');
    }
```

# order of routes is very important take care of it or use regex on routes
