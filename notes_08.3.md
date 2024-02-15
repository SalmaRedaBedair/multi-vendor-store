# define many to many relationship in pivot table in db
```php
public function up(): void
    {
        Schema::create('product_tag', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();

            $table->primary(['product_id','tag_id']);
        });
    }
```
# pluck
- convert object to array of keys and values
```php
public function create()
    {
        $parents = Category::all()->pluck('name','id');
    }
```
