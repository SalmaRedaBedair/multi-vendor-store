<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['parent_id', 'name', 'slug', 'description', 'image', 'status'];

    public function scopeActive(Builder $builder)
    {
        $builder->whereStatus('active');
    }

    public function scopeStatus(Builder $builder, $status)
    {
        $builder->whereStatus($status);
    }

    public function scopeFilter(Builder $builder, $filter)
    {
        $builder->when($filter['name'] ?? false, function ($builder, $value) {
            $builder->where('name', 'like', "%{$value}%");
        });
        $builder->when($filter['status'] ?? false, function ($builder, $value) {
            $builder->whereStatus($value);
        });
    }
    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                "unique:categories,name,$id",
                'filter:php,laravel,html,css'
            ],
            // that $id will be id of the current row
            // i pass it to tell him that unique is not applied for that record to work while update
            'parent_id' => 'nullable|int|exists:categories,id',
            'image' => 'image|max:1048576|dimensions:min_width=100,min_height=100',
            'status' => 'in:active,archived',
        ];
    }
    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','id')
        ->withDefault([
            'name' => 'Main Category'
        ]); // it will return empty object instead of null
    }

    public function childern()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
}
