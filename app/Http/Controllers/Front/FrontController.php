<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\create_settings;
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
      $category = Category::query()->where("slug", $slug)->first();

      //tek sorguda hepsini alarak daha hızlı bir kullanım gerçekleşti
      $articles = Article::query()->where("status",1)->with(["category:id,title,slug", "user:id"])->whereHas("category", function ($query) use ($slug) {
         $query->where("slug", $slug);
      })->get();
      if (!$category || $category->status == 0) {
         abort(404);
      }
      return view("front.catArticleListPage", compact("articles", "category", "settings"));
   }

   public function articleDetail(Request $request, string $categorySlug, string $articleSlug ){
      
      $settings = create_settings::first();
      $articles = Article::query()->where( 'slug', $articleSlug)->with(["category:id,title,slug", "user:id"])->first();
      if (!$articles || $articles->status == 0 || $articles->category->slug != $categorySlug)  {
         abort(404);
      }
      return view("front.articleDetail", compact("settings","articles"));  
   }
}
