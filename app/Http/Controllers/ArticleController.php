<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Image;
use Illuminate\Support\Facades\Redirect;

class ArticleController extends Controller
{
    public function show_all(){
        $articles = Article::all()->sortByDesc('created_at')->take(5);
        $article_images = Image::where('main_article_image', 1)->get();
        return view('article_list')->with('articles', $articles)->with('article_images', $article_images);
    }

    public function showCreate(){
        return view('article_create');
    }
    
    public function find($id){
        $article = Article::where('id', $id)->first();
        $article_image = Image::where('article_id', $id)->first();
        return view('article_edit')->with('article', $article)->with('article_image', $article_image);
    }

    public function create(Request $request){
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'featured_image' => 'image|max:2000'
        ]);
        
        $article = new Article;

        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();

        if($request->featured_image){
            $image = new Image;
            $path = $request->file('featured_image')->store('public/img/uploaded/article_imgs');
            $image->file_path = str_replace("public", "storage", $path);
            $image->main_article_image = 1;
            $image->article_id = $article->id;
            $image->save();
        }
        return Redirect::route('news')->with('message', 'News story created');
    }

    public function update(Request $request){

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'featured_image' => 'image|max:2000'
        ]);
        Article::where('id', $request->id)->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        if($request->featured_image){
            $image_to_delete = Image::where('article_id', $request->id)->first();
            Storage::delete($image_to_delete->filepath);
            $image_to_delete->delete();

            $image = new Image;
            $path = $request->file('featured_image')->store('public/img/uploaded/article_imgs');
            $image->file_path = str_replace("public", "storage", $path);
            $image->main_article_image = 1;
            $image->article_id = $request->id;
            $image->save();
        }
        return Redirect::route('news_edit', ['id' => $request->id])->with('message', 'News story updated');

    }

    public function delete(Request $request){
        Article::where('id', $request->id)->delete();
        return Redirect::route('news')->with('message', 'News story deleted');
    }
}
