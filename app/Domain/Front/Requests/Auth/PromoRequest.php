<?php

namespace App\Domain\Front\Requests\Auth;

use App\Cloudsa9\Constants\DBTable;
use App\Cloudsa9\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PromoRequest
 * @package App\Domain\Admin\Requests\Auth
 */
class PromoRequest extends FormRequest implements IFormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . DBTable::USERS,
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
