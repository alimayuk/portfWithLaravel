<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use App\Models\create_settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateSettingsController extends Controller
{
    public function show()
    {
        $settings = create_settings::first();
        return view("admin.settings.update", compact("settings"));
    }
    public function update(SettingsRequest $request)
    {
        $settings = create_settings::first();

        $settings->logo = $request->logo;
        $settings->footerText = $request->footerText;
        $settings->aboutText = $request->aboutText;

        if ($request->feature_cat_is_active)
            $settings->feature_cat_is_active = 1;
        else
            $settings->feature_cat_is_active = 0;


        
        if(!is_null($request->category_default_image))
        $settings->category_default_image = $this->imageUpload($request, "category_default_image", $settings->category_default_image);
        if(!is_null($request->article_default_image))
        $settings->article_default_image = $this->imageUpload($request, "article_default_image", $settings->article_default_image);
        
        $settings->save();
        alert()->success("Başarılı", "Ayarlar Güncellendi !")->showConfirmButton("Tamam", "#445334");
        return redirect()->route("settings");
    }

    public function imageUpload(Request $request,string $imageName , $oldImagePath): string
    {
        
        $imageFile = $request->file($imageName); //clientten gelen imageyi aldık.
        $originalName = $imageFile->getClientOriginalName(); // noktadan önce olanı alır ve değişkene atar
        $originalExtension = $imageFile->getClientOriginalExtension();
        $explodoName = explode(".", $originalName)[0];
        $fileName = Str::slug($explodoName) . "." . $originalExtension;
        $folder = "settings";
        $publicPath = "Storage/" . $folder;
        
        // resimin kaldırılması
        if (file_exists(public_path($oldImagePath))) {
            File::delete(public_path($oldImagePath));
        }

        $imageFile->storeAs($folder, $fileName);
        return $publicPath . "/" . $fileName;
    }
}
