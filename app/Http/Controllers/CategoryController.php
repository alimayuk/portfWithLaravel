<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStore;
use App\Models\Category;
use App\Models\create_settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all()->reverse();
        $settings = create_settings::first();
        return view("admin.category.list", compact("categories","settings"));
    }

    public function changeStatus(Request $request)
    {
        $request->validate(['id' => ["required", "integer"]]);
        $categoryID = $request->id;
        $category = Category::where("id", $categoryID)->first();
        $category->status = !$category->status;
        $category->save();
        alert('Başarılı', 'Güncelleme Başarılı', 'success');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $request->validate(['id' => ["required", "integer"]]);
        $categoryID = $request->id;
        $category = Category::where('id', $categoryID)->first();
        if (!is_null($category->image)) {

            // resimin kaldırılması
            if (file_exists(public_path($category->image))) {
                File::delete(public_path($category->image));
            }
        }
        $category->delete();
        alert('Başarılı', 'Silme İşlemi Başarılı', 'success');
        return redirect()->back();
    }

    public function create()
    {
        $categories = Category::all();
        return view("admin.category.create-update", compact("categories"));
    }

    public function store(CategoryStore $request)
    {

        if (!is_null($request->image)) {
            $imageFile = $request->file("image");
            $originalName = $imageFile->getClientOriginalName();
            $originalExtension = $imageFile->getClientOriginalExtension();
            $explodeName = explode(".", $originalName)[0];
            $fileName = Str::slug($explodeName) . "." . $originalExtension;

            $folder = "categories";
            $publicPath = "storage/" . $folder;

            if (file_exists(public_path($publicPath . "/" . $fileName))) {
                return redirect()->back()->withErrors(["image" => "Aynı görsel daha önceden yüklenmiştir."]);
            }
        }

        $data = $request->except("_token");
        $slug = $data['slug'] ?? $data['title'];
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
        if (!is_null($request->image)) {
            $data['image'] = $publicPath . "/" . $fileName;
        }

        if (is_null($request->title)){
            return redirect()->back()->withErrors(["Hata"=> "* ile işaretlenmiş olan alanları doldurun"]);
        }
        $data["user_id"] = auth()->id();
        Category::create($data);

        if (!is_null($request->image)) {
            $imageFile->storeAs($folder, $fileName, "public");
        }

        alert()->success("Başarılı", "Kategori oluşturma işlemi başarılı")->showConfirmButton("Tamam")->autoClose(5000);
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $categories = Category::all();
        $categoryID = $request->id;
        $category = Category::where("id", $categoryID)->first();
        if (!$category) {
            alert()->error("İşlem Başarısız", 'Böyle Bir Kategori Yok');
            return redirect()->back();
        }
        return view('admin.category.create-update', compact('categories', 'category'));
    }

    public function update(CategoryStore $request)
    {
        $slug = Str::slug($request->title);
        $slugCheck = $this->slugCheck($slug);

        $category = Category::find($request->id);

        $category->title = $request->title;

        if ((!is_null($slugCheck) && $slugCheck->id == $category->id) || is_null($slugCheck)) {
            $category->slug = $slug;
        } else if (!is_null($slugCheck) && $slugCheck->id != $category->id) {
            $category->slug = Str::slug($slug . time());
        } else {
            $category->slug = Str::slug($slug . time());
        }

        $category->description = $request->description;
        $category->status = $request->status ? 1 : 0;
        $category->seo_description = $request->seo_description;
        $category->seo_keywords = $request->seo_keywords;
        // $category->user_id = random_int(1,10);

        if (!is_null($request->image)) {
            $imageFile = $request->file("image"); //clientten gelen imageyi aldık.
            $originalName = $imageFile->getClientOriginalName(); // noktadan önce olanı alır ve değişkene atar
            $originalExtension = $imageFile->getClientOriginalExtension();
            $explodoName = explode(".", $originalName)[0];
            $fileName = Str::slug($explodoName) . "." . $originalExtension;
            $folder = "categories";
            $publicPath = "Storage/" . $folder;

            if (file_exists(public_path($publicPath . "/" . $fileName))) {
                return redirect()->back()->withErrors(['image' => "görsel daha önceden yüklenmiştir."]);
            }



            // resimin kaldırılması
            if (file_exists(public_path($category->image))) {
                File::delete(public_path($category->image));
            }
            $category->image = $publicPath . "/" . $fileName;
            $imageFile->storeAs($folder, $fileName);
        }

        $category->save();
        alert()->success("Başarılı", "Kategori Güncellendi !")->showConfirmButton("Tamam", "#445334");
        return redirect()->route("category.index");
    }
    public function slugCheck(string $text)
    {
        return Category::where("slug", $text)->first();
    }
}
