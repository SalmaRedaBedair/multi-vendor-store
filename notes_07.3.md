# route model binding & soft delete
- can't be used with restore because that element is deleted so it will see not found

```php
public function restore(Request $request, $id)
    { // here i can't use route model bindig (Category $category) because it is deleted
        $category = Category::onlyTrashed()->findorfail($id); // you should use only trashed, if not used it will search on not deleted only 
        // $category = Category::findorfail($id); xxxxx not work
        $category->restore();
        $categories = Category::onlyTrashed()->paginate();
        return redirect()->route('categories.trash', compact('categories'))->with('success', 'category restored successfully.');
    }
```

# order of routes is very imporant take care of it or use regex on routes
