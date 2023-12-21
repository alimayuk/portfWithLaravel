<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(){
        $categories = Category::all();
        $users = User::all();
        $articles = Article::all()->reverse();
        return view("admin.article.list",compact("articles","categories","users"));
    }
    public function create(){
        $categories = Category::all();
        return view("admin.article.create-update",compact("categories"));
    }

    public function edit(Request $request, int $articleID){
        $categories = Category::all();
        $users = User::all();
        $article = Article::query()->where("id", $articleID)->first();

        if (is_null($article)) {
            $statusText = "Makale bulunamadı";
            alert()->error("Hata", $statusText)->showConfirmButton("Tamam")->autoClose(5000);
            return redirect()->route("article.index");
        }

        return view("admin.article.create-update", compact("article", "categories", "users"));
    }

    public function store(Request $request){
        if(!is_null($request->image)){
            $imageFile = $request->file("image"); //clientten gelen imageyi aldık.
        $originalName = $imageFile->getClientOriginalName(); // noktadan önce olanı alır ve değişkene atar
        $originalExtension = $imageFile->getClientOriginalExtension();
        $explodoName = explode(".", $originalName)[0];
        $fileName = Str::slug($explodoName) . "." . $originalExtension;
        $folder = "articles";
        $publicPath = "Storage/" . $folder;
        if (file_exists(public_path($publicPath . "/" . $fileName))) {
            return redirect()->back()->withErrors(['image' => "görsel daha önceden yüklenmiştir."]);
        }
        }

        $data = $request->except("_token");
        $slug = $data['slug'] ?? $data['title'];  // datanın slugu varsa onu al yoksa title al
        $slug = Str::slug($slug);
        $slugTitle = Str::slug($data['title']);
        $checkSlug = $this->slugCheck($slug);
        if (!is_null($checkSlug)) {
            $checkTitleSlug = $this->slugCheck($slugTitle);

            if (!is_null($checkTitleSlug)) {
                $slug = Str::slug($slug . time());
            } else {
                $slug = $slugTitle;
            }
        }

        $data['slug'] = $slug;
        if(!is_null($request->image)){
            $data['image'] = $publicPath . "/" . $fileName;
        }

        if (is_null($request->description) || is_null($request->title) || is_null($request->category_id)) {
            return redirect()->back()->withErrors(["Hata"=> "* ile işaretlenmiş olan alanları doldurun"]);
        }
        
        $data["user_id"] = auth()->id();
        Article::create($data);

        if(!is_null($request->image)){
            $imageFile->storeAs($folder, $fileName, "public");
        }

        alert()->success("başarılı", "makala yükleme işlemi başarılı")->showConfirmButton("TAMAM")->autoClose(5000);
        return redirect()->back();

    }

    public function update(ArticleRequest $request){
        $data = $request->except("_token");
        $slug = $data['slug'] ?? $data['title'];  // datanın slugu varsa onu al yoksa title al
        $slug = Str::slug($slug);
        $slugTitle = Str::slug($data['title']);
        $checkSlug = $this->slugCheck($slug);
        $data['slug'] = $slug;
        if (!is_null($checkSlug)) {
            $checkTitleSlug = $this->slugCheck($slugTitle);

            if (!is_null($checkTitleSlug)) {
                $slug = Str::slug($slug . time());
            } else {
                $slug = $slugTitle;
            }
        }

        if (!is_null($request->image)) {
            $imageFile = $request->file("image"); //clientten gelen imageyi aldık.
            $originalName = $imageFile->getClientOriginalName(); // noktadan önce olanı alır ve değişkene atar
            $originalExtension = $imageFile->getClientOriginalExtension();
            $explodoName = explode(".", $originalName)[0];
            $fileName = Str::slug($explodoName) . "." . $originalExtension;
            $folder = "articles";
            $publicPath = "Storage/" . $folder;

            if (file_exists(public_path($publicPath . "/" . $fileName))) {
                return redirect()->back()->withErrors(['image' => "görsel daha önceden yüklenmiştir."]);
            }
            $data['image'] = $publicPath . "/" . $fileName;
        }
        $data["user_id"] = auth()->id();



        $articleQuery = Article::query()->where("id", $request->id);

        $articleFind = $articleQuery->first();

        $articleQuery->update($data);


        if (!is_null($request->image)) {

            // resimin kaldırılması
            if (file_exists(public_path($articleFind->image))) {
                File::delete(public_path($articleFind->image));
            }

            $imageFile->storeAs($folder, $fileName, "public");
        }
        alert()->success("başarılı", "makala güncelleme işlemi başarılı")->showConfirmButton("TAMAM")->autoClose(5000);
        return redirect()->route("article.index");
    }
    public function changeStatus(Request $request){
        $request->validate(['id' => ["required", "integer"]]);
        $articleID = $request->id;
        $article = Article::where("id",$articleID)->first();
        $article->status = !$article->status;
        $article->save();
        alert('Başarılı', "Değişikli Başarılı","success");
        return redirect()->back();
    }
    public function changeFeatureStatus(Request $request){
        $request->validate(['id' => ["required", "integer"]]);
        $articleID = $request->id;
        $article = Article::where("id",$articleID)->first();
        $article->feature_status = !$article->feature_status;
        $article->save();
        alert('Başarılı', "Değişikli Başarılı","success");
        return redirect()->back();
    }

    public function slugCheck(string $text)
    {
        return Article::where("slug", $text)->first();
    }
}
