<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['file_path', 'url', 'collection_id', 'main_collection_image', 'product_id', 'main_product_image', 'marin_article_image', 'article_id'];
    //
}
