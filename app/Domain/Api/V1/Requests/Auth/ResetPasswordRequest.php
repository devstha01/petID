<?php

namespace App\Domain\Api\V1\Requests\Auth;

use App\Cloudsa9\Constants\DBTable;
use App\Cloudsa9\Contracts\IFormRequest;
use Dingo\Api\Http\FormRequest;

/**
 * Class ResetPasswordRequest
 * @package App\Domain\Api\Requests\Auth
 */
class ResetPasswordRequest extends FormRequest implements IFormRequest
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
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'token' => 'required',
        ];
    }
}
