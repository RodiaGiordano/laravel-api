<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'description' => 'string',
            'url' => 'required|url',
            'cover_image' => 'image|max:1000|nullable'

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'il titolo è obbligatorio',
            'title.string' => 'il titolo non deve essee un numero',
            'title.max' => 'il titolo deve essere meno di 50 caratteri',
            'description.string' => 'la descrizione deve essere una stringa',
            'url.required' => 'l\'url è obbligatorio',
            'url.url' => 'inserire un url valido',
            'cover_image.image' => 'deve essere un immagine',
            'cover_image.max' => 'l\'immagine caricata è troppo grande'
        ];
    }
}