<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           "title"=> ["required","max:255"],
           "slug"=> ["max:255"],
           "description"=>["max:255"],
           "seo_keywords"=>["max:255"],
           "seo_description"=>["max:255"],
           "image" =>["image","mimetypes:image/jpeg,image/png,image/jpg","max:2048","nullable"],
        ];
    }

    public function messages(){
        return [
            "title.required"=> "kategori adı koymak zorunludur",
            "title.max"=> "Kategori adı en fazla 255 karakter koymak zorunludur",
            "description.max"=> "description en fazla 255 karakter koymak zorunludur",
            "seo_keywords.max"=> "seo_keywords en fazla 255 karakter koymak zorunludur",
            "seo_description.max"=> "seo_descriptionen fazla 255 karakter koymak zorunludur",
        ];
    }
}
