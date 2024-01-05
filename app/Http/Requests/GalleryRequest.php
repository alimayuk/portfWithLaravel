<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            "image" =>["image","mimetypes:image/jpeg,image/png,image/jpg,image/webp","max:2048","nullable"]
        ];
    }
    public function messages(){
        return [
            "title.required"=> "kategori adı koymak zorunludur",
            "title.max"=> "Kategori adı en fazla 255 karakter koymak zorunludur"
        ];
    }
}
