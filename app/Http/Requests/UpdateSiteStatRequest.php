<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteStatRequest extends FormRequest
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
            'stats' => ['required', 'array'],
            'stats.*.id' => ['required', 'integer', 'exists:site_stats,id'],
            'stats.*.label' => ['required', 'string', 'max:255'],
            'stats.*.value' => ['required', 'integer', 'min:0'],
            'stats.*.sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'stats.required' => 'Data statistik wajib diisi.',
            'stats.*.label.required' => 'Label statistik wajib diisi.',
            'stats.*.value.required' => 'Nilai statistik wajib diisi.',
        ];
    }
}
