<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Collection;
use App\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function show_one($id){
        $product = Product::find($id);
        $main_product_image = Image::where('product_id', $id)->where('main_product_image', 1)->first();
        $additional_product_images = Image::where('product_id', $id)->where('main_product_image', 0)->get();
        
        $collection = Collection::where('id', $product->collection_id)->first();
        return view('product_view')->with('product', $product)
        ->with('collection', $collection)
        ->with('main_product_image', $main_product_image)
        ->with('additional_product_images', $additional_product_images);
    }

    public function show_create($id){
        $collections = Collection::all();
        return view('product_create')->with('collections', $collections)->with('autofill_id', $id);
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'product_image' => 'required|max:2000|image',
            'add_product_images.*' => 'max:2000|image',
            'description' => 'required',
            'availability' => 'required',
            'price' => 'required|regex:/^\d+\.{0,1}\d{2}$/',
        ]);

        $product = new Product;
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->collection_id = $request->collection;
        $product->availability = $request->availability;
        $product->price = $request->price;

        $product->save();

        $image = new Image;
        
        $path = $request->file('product_image')->store('public/img/uploaded/product_imgs');
        $image->file_path = $path;
        $image->url = str_replace('public', 'storage', $path);
        $image->collection_id = $request->collection;
        $image->product_id = $product->id;
        $image->main_product_image = 1;
        
        $image->save();

        if(!empty($request->add_product_images)){
            $files = $request->file('add_product_images');
            foreach($files as $file){
                $image = new Image;
                $path = $file->store('public/img/uploaded/product_imgs');
                $image->file_path = $path;
                $image->url = str_replace('public', 'storage', $path);
                $image->collection_id = $request->collection;
                $image->product_id = $product->id;
                $image->main_product_image = 0;
                $image->save();
            }
        }
       
        return Redirect::route('product_view', [ 'id' => $product->id ])->with('message', 'New product added');

    }

    public function edit($id){

        $product = Product::find($id);
        $main_product_image = Image::where('product_id', $id)->where('main_product_image', 1)->first();
        $additional_product_images = Image::where('product_id', $id)->where('main_product_image', 0)->get();
       
        $collections = Collection::all();
        return view('product_edit')
        ->with('product', $product)
        ->with('collections', $collections)
        ->with('main_product_image', $main_product_image)
        ->with('additional_product_images', $additional_product_images);
    }

    public function update(Request $request){

        $product = Product::find($request->id);
        $main_product_image = Image::where('product_id', $request->id)->where('main_product_image', 1)->first();
        $additional_product_images = Image::where('product_id', $request->id)->where('main_product_image', 0)->get();
        
        $request->validate([
            'name' => 'required',
            'product_image' => 'max:2000|image',
            'add_product_images.*' => 'max:2000|image',
            'description' => 'required',
            'collection' => 'required',
            'availability' => 'required',
            'price' => 'required|regex:/^\d+\.{0,1}\d{2}$/',
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'collection_id' => $request->collection,
            'availability' => $request->availability,
            'price' => $request->price
        ]);

        if($request->product_image){
            Storage::delete($main_product_image->file_path);
            $main_product_image->delete();
            $image = new Image;
            $path = $request->file('product_image')->store('public/img/uploaded/product_imgs');
            $image->file_path = $path;
            $image->url = str_replace('public', 'storage', $path);
            $image->collection_id = $request->collection;
            $image->product_id = $product->id;
            $image->main_product_image = 1;
            $image->save();
        }

        if(!empty($request->add_product_images)){
            $files = $request->file('add_product_images');
            foreach($files as $file){
                $image = new Image;
                $path = $file->store('public/img/uploaded/product_imgs');
                $image->file_path = $path;
                $image->url = str_replace('public', 'storage', $path);
                $image->collection_id = $request->collection;
                $image->product_id = $product->id;
                $image->main_product_image = 0;
                $image->save();
            }
        }
        return Redirect::route('product_view', [ 'id' => $request->id ])->with('message', 'Product updated');
    }

    public function delete_additional_image(Request $request){
       
        $image_to_delete = Image::where('id', $request->image_id)->first();
        Storage::delete($image_to_delete->file_path);
        $image_to_delete->delete();
        return Redirect::route('product_view', [ 'id' => $request->product_id ])->with('message', 'Image removed');
    }

    public function deleteProduct(){
    }
}
