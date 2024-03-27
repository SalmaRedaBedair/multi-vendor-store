# Eloquent: Api Resource
- we create it to make new style for return response
```
php artisan make:resource ProductResource 
```
```php
public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>[
                'normal'=>$this->price,
                'compare'=>$this->compare_price
            ],
            'description'=>$this->description,
            'image'=>$this->image_url,
            'relations'=>[
                'category'=>[
                    'id'=>$this->category->id,
                    'name'=>$this->category->name
                ],
                'store'=>[
                    'id'=>$this->store->id,
                    'name'=>$this->store->name
                ]
            ],

        ];
    }
```