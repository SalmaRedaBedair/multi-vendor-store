# query builder & ORM & created_at, updated_at
- if you don't add values for created_at and updated_st
  - ORM created_at, updated_at will have values
  - but query builder not, there values will be null

```php
DB::table('users')->insert([
'name'=>'salma'
]); // created_at & updated_at will be null

User::create([
'name'=>'salma'
]); // created_at & updated_at will have values
```

# tables with no models
- sometimes i have tables in database which doesn't have models 
- to access them i use db facade `db::table('table_name')`