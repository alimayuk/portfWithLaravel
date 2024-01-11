<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $gallery = Gallery::all();
        return view('admin.gallery.list', compact("gallery"));
    }
    public function create()
    {
        return view('admin.gallery.update');
    }

    public function store(Request $request)
    {
        $data = $request->except("_token");

        if (!is_null($request->image_path)) {
            $imageFile = $request->file("image_path");
            $originalName = $imageFile->getClientOriginalName();
            $originalExtension = $imageFile->getClientOriginalExtension();
            $explodeName = explode(".", $originalName)[0];
            $fileName = Str::slug($explodeName) . "." . $originalExtension;

            $folder = "gallery";
            $publicPath = "Storage/" . $folder;

            if (file_exists(public_path($publicPath . "/" . $fileName))) {
                return redirect()->back()->withErrors(["image" => "Aynı görsel daha önceden yüklenmiştir."]);
            }
        }

        if (!is_null($request->image_path)) {
            $data['image_path'] = $publicPath . "/" . $fileName;
        }
        if (is_null($request->title)) {
            return redirect()->back()->withErrors(["Hata" => "* ile işaretlenmiş olan alanları doldurun"]);
        }
        Gallery::create($data);
        if (!is_null($request->image_path)) {
            $imageFile->storeAs($folder, $fileName, "public");
        }
        alert()->success("Başarılı", "Görsel yükleme işlemi başarılı")->showConfirmButton("Tamam")->autoClose(5000);
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $gallery = Gallery::where("id", $request->id)->first();
        return view("admin.gallery.update", compact('gallery'));
    }

    public function update(Request $request)
    {

        $data = $request->except("_token");

        if (!is_null($request->image_path)) {
            $imageFile = $request->file("image_path"); //clientten gelen imageyi aldık.
            $originalName = $imageFile->getClientOriginalName(); // noktadan önce olanı alır ve değişkene atar
            $originalExtension = $imageFile->getClientOriginalExtension();
            $explodoName = explode(".", $originalName)[0];
            $fileName = Str::slug($explodoName) . "." . $originalExtension;
            $folder = "gallery";
            $publicPath = "Storage/" . $folder;

            if (file_exists(public_path($publicPath . "/" . $fileName))) {
                return redirect()->back()->withErrors(['image' => "görsel daha önceden yüklenmiştir."]);
            }
            $data['image_path'] = $publicPath . "/" . $fileName;
        }

        $galleryQuery = Gallery::query()->where("id", $request->id);

        $galleryFind = $galleryQuery->first();

        $galleryQuery->update($data);


        if (!is_null($request->image_path)) {

            // resimin kaldırılması
            if (file_exists(public_path($galleryFind->image_path))) {
                File::delete(public_path($galleryFind->image_path));
            }

            $imageFile->storeAs($folder, $fileName, "public");
        }
        alert()->success("başarılı", "görsel güncelleme işlemi başarılı")->showConfirmButton("TAMAM")->autoClose(5000);
        return redirect()->route("gallery.index");
    }
    public function delete(Request $request)
    {
        $galleryID = $request->id;
        $gallery = Gallery::where("id", $galleryID)->first();
        // resimin kaldırılması
        if (file_exists(public_path($gallery->image_path))) {
            File::delete(public_path($gallery->image_path));
        }
        $gallery->delete();
        alert('Başarılı', 'Silme İşlemi Başarılı', 'success');
        return redirect()->back();
    }
}
