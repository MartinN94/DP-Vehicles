<?php

namespace App\Models;

use App\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Http\Request;

class Vehicle extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SearchTrait;

    protected $fillable = ['user_id', 'price', 'currency', 'price_type', 'sold', 'arriving', 'available','year_id','make_id', 'type_id', 'sku_id', 'store_id', 'description', 'category_id'];
    

    public function year(){
        return $this->belongsTo(Year::class, 'year_id', 'id');
    }

    public function maker(){
        return $this->belongsTo(Make::class, 'make_id', 'id');
    }

    public function model(){
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function sku(){
        return $this->belongsTo(Sku::class, 'sku_id', 'id');
    }

    public function store(){
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function features(){
        return $this->belongsToMany(Optional::class);
    }

    public function saveImages(Request $request)
    {
        $images = $request->validate([
            'images.*' => 'nullable|max:10240',
            'images' => 'required|max:5'
          
        ]);
  
        foreach ($request->file('images') ?? [] as $i => $images) {

                $this->media()->whereCollectionName('images')->where('custom_properties->index', $i)->forceDelete();
                $this->addMedia($images)->withCustomProperties(['index' => $i])->toMediaCollection('images');
        }

        return $this;
    }

}
