<?php

namespace App\Http\Requests\UserGifs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserGifRequest extends FormRequest
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
            'gif_id' => [
                'required',
                'integer',
                Rule::unique('user_gifs', 'gif_id')
                    ->where('user_id', $this->input('user_id'))
                    ->where('gif_id', $this->input('gif_id')),
            ],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'alias' => ['required', 'string', 'unique:user_gifs,alias'],
        ];
    }
    
    public function messages(): array
    {
        return [
            'gif_id.unique' => 'The gif_id for selected user already exists.',
        ];
    }
}
