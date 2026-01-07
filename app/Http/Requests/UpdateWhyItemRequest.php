<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWhyItemRequest extends FormRequest
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
            'items' => ['required', 'array'],
            'items.*.id' => ['required', 'integer', 'exists:why_items,id'],
            'items.*.title' => ['required', 'string', 'max:255'],
            'items.*.description' => ['required', 'string'],
            'items.*.icon_class' => ['required', 'string', 'max:255'],
            'items.*.sort_order' => ['nullable', 'integer', 'min:0'],
            'items.*.is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Data item wajib diisi.',
            'items.*.title.required' => 'Judul item wajib diisi.',
            'items.*.description.required' => 'Deskripsi item wajib diisi.',
            'items.*.icon_class.required' => 'Icon item wajib diisi.',
        ];
    }
}
