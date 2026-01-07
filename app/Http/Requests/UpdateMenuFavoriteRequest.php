<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuFavoriteRequest extends FormRequest
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
            'menu_item_ids' => ['nullable', 'array'],
            'menu_item_ids.*' => ['integer', 'exists:menu_items,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'menu_item_ids.array' => 'Daftar menu favorit tidak valid.',
            'menu_item_ids.*.exists' => 'Menu favorit yang dipilih tidak ditemukan.',
        ];
    }
}
