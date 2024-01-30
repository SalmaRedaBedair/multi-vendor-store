# anonymous class
- class with no name i create object from it directly
- where is it in laravel?
  - in migration files
```php
return new class extends Migration // that is anonymous class 
{                                  // it was written as that before Laravel 9
    /**                            // class CreateCategoriesTable extends migration
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
```

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

# how to make uuid 
see those videos
[event & observer](https://youtu.be/7GUaH6BI_V0?si=IOK-fxpx6KY1avBf), 
[uuid](https://youtu.be/1XIMI5kOPuc?si=tj9SaxDzzpGMQyaF)
## advantages of using uuid
- it will be unique over same table, and also same database, and same server
## disadvantages
- size is larger
# when to use it
- when you use multiple databases 

# delete
- by default, it will be restricted

## restrict on delete
- prevent deletion if i have that row i want to delete as a foreign key on another row

## cascade on delete
- delete it and all related with it

## null on delete
- delete and if there any record related with it set its foreign key as null

# chaining
```php
$table->foreignId('parent_id')->nullable()->constrained('categories','id')->nullOnDelete();
```
- constrained return object of relation 
- nullable must be applied to object of column not relation so it come before constraint

# php artisan migrate:status
- will give me table of all migrations in db and their status if run or not
- every migration will take batch number

# batch
- collection of sql commands that are submitted together and executed as a group

# difference between rollback & rest & refresh & fresh
## rollback
- يتراجع عن اخر batch
## reset
- يتراجع عن جميع ال batches
- execute down only
## refresh 
- make rollback for all then migrate
- execute down the up
## fresh 
- drop tables, not execute down
- then execute up, make migrate

### important hint
- rollback mean execute down 
- migrate mean execute up

# MyISAM & InnoDB
- different engines
- reading of tables of MyISAM is rabid 
- InnoDB: its key is longer than MyISAM, so if i use email as unique attribute i should use InnoDB not MyISAM

# important definitions in model
- all of these properties are inherited from model class, i overwrite them here
```php
class Store extends model{
    use HasFactory;
    protected $connection='mysql'; // if not defined it will connect with default, which is configured in config file
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