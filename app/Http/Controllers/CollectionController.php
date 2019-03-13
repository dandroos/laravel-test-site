<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use App\Product;
use App\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class CollectionController extends Controller
{
    public function show_all_collections(){
        $collections = Collection::all()->take(10);
        foreach($collections as $collection){
            $collection->image = Image::where('main_collection_image', 1)->where('collection_id', $collection->id)->first();
        }
        return view('collection_list')->with('collections', $collections);
    }

    public function show_create(){
        return view('collection_create');
    }

    public function show_one($id){
        $products = Product::where('collection_id', $id)->get();
        $product_images = Image::where('collection_id', $id)->where('main_product_image', 1)->get();
        $collection = Collection::where('id', $id)->first();
        return view('collection_view')->with('products', $products)->with('collection', $collection)->with('product_images', $product_images);
    }
    
    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'collection_image' => 'image|max:2000|required'
        ]);

        $collection = new Collection;
        $collection->name = $request->name;
        $collection->description = $request->description;
        $collection->save();

        $image = new Image;
        $path = $request->file('collection_image')->store('public/img/uploaded/collection_imgs');
        $image->file_path = $path;
        $image->url = str_replace('public', 'storage', $path);
        $image->collection_id = $collection->id;
        $image->main_collection_image = 1;
        $image->save();

        return Redirect::route('collections')->with('message', 'Collection created');
    }

    public function edit($id){
        $collection = Collection::where('id', $id)->first();
        $main_collection_image = Image::where('collection_id', $id)->where('main_collection_image', 1)->first();
        return view('collection_edit')->with('collection', $collection)->with('main_collection_image', $main_collection_image);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        Collection::where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if($request->collection_image){
            $request->validate([
            'collection_image' => 'image|max:2000|required'

            ]);

            $image_to_delete = Image::where('collection_id', $request->id)->where('main_collection_image', 1)->first();
            Storage::delete($image_to_delete->filepath);
            $image_to_delete->delete();
            
            $image = new Image;
            $path = $request->file('collection_image')->store('public/img/uploaded/collection_imgs');
            $image->file_path = $path;
            $image->url = str_replace('public', 'storage', $path);
            $image->collection_id = $request->id;
            $image->main_collection_image = 1;
            $image->save();
        }
        return Redirect::route('collection_edit', [ 'id' => $request->id])->with('message', 'Collection updated');
    }

    public function delete(Request $request){
        Collection::where('id', $request->id)->delete();
        return Redirect::route('collections')->with('message', 'Collection deleted');
    }
}
