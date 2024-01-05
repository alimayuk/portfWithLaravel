<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\create_settings;
use App\Models\Gallery;
use Illuminate\Http\Request;

class FrontController extends Controller
{
   public function home()
   {
      $settings = create_settings::first();
      $categories = Category::query()->where("status", 1)->get();
      $articles = Article::query()->where("feature_status",1)->get();
      return view('front.homePage', compact('settings', 'categories',"articles"));
   }
   public function pageCategory(Request $request){
      $settings = create_settings::first();
      $categories = Category::query()->where("status", 1)->get();
      $articles = Article::query()->where("feature_status",1)->get();
      return view('front.pageCategory', compact('settings', 'categories',"articles"));
   }
   public function category(Request $request, string $slug)
   {

      // with ile sorug atmadığımızda performans olarak kötü etkileniyor
      $settings = create_settings::first();
      // $category = Category::query()->with(["user", "articles", "articlesActive"])->where('slug', $slug)->first();
      // $articles = $category->articlesActive()->paginate(1);
      $category = Category::query()->where("slug", $slug)->firstOrFail();

      //tek sorguda hepsini alarak daha hızlı bir kullanım gerçekleşti
      $articles = Article::query()->where("status",1)->with(["category:id,title,slug", "user:id"])->whereHas("category", function ($query) use ($slug) {
         $query->where("slug", $slug);
      })->get();
      if ($category->status == 0)
         abort(404);

      return view("front.catArticleListPage", compact("articles", "category", "settings"));
   }
   public function articleDetail(Request $request, string $categorySlug, string $articleSlug ){
      
      $settings = create_settings::first();
      $articles = Article::query()->where( 'slug', $articleSlug)->with(["category:id,title,slug", "user:id"])->firstOrFail();
      $visitedArticles = $request->session()->get('visited_articles', []);
      if (!in_array($articles->id, $visitedArticles)) {
         $articles->increment('view_count');
         $articles->save();

         $visitedArticles[] = $articles->id;
         $request->session()->put('visited_articles', $visitedArticles);
     }

      if ($articles->category->slug != $categorySlug)  {
         abort(404);
      }

      return view("front.articleDetail", compact("settings","articles"));  
   }

   public function articles(Request $request){
      $settings = create_settings::first();
      $articles = Article::query()->where("status",1)->with(["category:id,slug","user:id"])->get();

      return view("front.blogPage", compact("settings","articles"));
   }

   public function about(Request $request){
      $settings = create_settings::first();
      return view("front.aboutPage", compact("settings"));
   }

   public function contact(Request $request){
      $settings = create_settings::first();
      return view("front.contactPage", compact("settings"));
   }
   public function gallery(Request $request){
      $settings = create_settings::first();
      $gallery = Gallery::all();

      return view("front.gallery", compact("settings","gallery"));
   }
}
