<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'subject'     => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'files.*'     => 'nullable|file|max:10240',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'first_name.required'   => 'الاسم الأول مطلوب',
            'last_name.required'    => 'اللقب مطلوب',
            'email.required'        => 'البريد الإلكتروني مطلوب',
            'email.email'           => 'البريد الإلكتروني غير صحيح',
            'subject.required'      => 'الموضوع مطلوب',
            'description.required'  => 'الوصف مطلوب',
            'files.*.file'          => 'يجب أن تكون الملفات صحيحة',
            'files.*.max'           => 'حجم الملف لا يجب أن يتجاوز 10MB',
        ];
    }
}
