# id in migration
```php
$table->id();
// is equal to
$table->bigInteger('id')->unsigned()->autoIncrement()->primary();
// is equal to
$table->unsignedBigInteger('id')->autoIncrement()->primary();
// is equal to
$table->bigIncrements('id')->primary();
```

# delete
- by default it will be restrict
## restrict on delete
- prevent deletion if i have that row i want to delete as a foriegn key on another row

## cascade on delete
- delete it and all related with it

## null on delete
- delete and if there any record related with it set its foriegn key as null

# chaining
```php
$table->foreignId('parent_id')->nullable()->constrained('categories','id')->nullOnDelete();
```
- constrained return object of relation 
- nullable must be applied to object of column not relation so it come before constriant

# php artisan migrate:status
- will give me table of all migrations in db and their status if runned or not
- every migration will take batch number

# important definations in model
- all of these properties are inherited from model class, i overwrite them here
```php
class Store extends model{
    use HasFactory;
    protected $connection='mysql'; // if not defined it will connect with default
    protected $table='stores'; // if i don't write with standard
    protected $primaryKey='id'; // if primary key is not id
    public $increment=true;
    public $timestaps =false; // if i want to remove timestamps columns from tables in db
    protected $keyType='string'; // if i change type of primary key, if not int

    // if i want to change name of created at and updated at columns   
    const CREATED_AT='created_at';
    const UPDATED_AT='updated_at';
}
```