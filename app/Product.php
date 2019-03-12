<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'collection_id', 'availability', 'price', 'img_url', 'add_img_urls'];
}
