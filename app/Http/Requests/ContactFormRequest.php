<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:120',
            'email'   => 'required|email:rfc,dns|max:180',
            'phone'   => 'nullable|string|max:40',
            'subject' => 'required|string|max:160',
            'message' => 'required|string|max:5000',
            'website' => 'nullable|string|max:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'الاسم مطلوب.',
            'email.required'   => 'البريد الإلكتروني مطلوب.',
            'email.email'      => 'البريد الإلكتروني غير صحيح.',
            'subject.required' => 'الموضوع مطلوب.',
            'message.required' => 'الرسالة مطلوبة.',
            'message.max'      => 'الرسالة طويلة جدًا (الحد الأقصى 5000 حرف).',
        ];
    }
}
