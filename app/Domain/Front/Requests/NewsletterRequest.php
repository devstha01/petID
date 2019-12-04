<?php

namespace App\Domain\Front\Requests;

use App\Cloudsa9\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NewsletterRequest
 * @package App\Domain\Admin\Requests\Auth
 */
class NewsletterRequest extends FormRequest implements IFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255',
        ];
    }
}
