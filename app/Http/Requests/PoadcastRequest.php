<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoadcastRequest extends FormRequest
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
            'title' => 'required|string|max:255',  
            'description' => 'required|string',  
            'audio_file' => 'required|file|mimes:m4a,mp3,wav|max:10240',  
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ];
    }
}
