<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool { return true; }
public function rules(): array {
    return [
        'title'            => ['required','string','max:255'],
        'author'           => ['required','string','max:255'],
        'category'         => ['nullable','string','max:255'],
        'total_copies'     => ['required','integer','min:0'],
        'available_copies' => ['required','integer','min:0','lte:total_copies'],
    ];
}


}
