<?php

namespace App\Domain\Api\V1\Requests\Auth;

use App\Cloudsa9\Constants\DBTable;
use App\Cloudsa9\Contracts\IFormRequest;
use Dingo\Api\Http\FormRequest;

/**
 * Class RegisterRequest
 * @package App\Domain\Api\Requests\Auth
 */
class RegisterRequest extends FormRequest implements IFormRequest
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
//            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
