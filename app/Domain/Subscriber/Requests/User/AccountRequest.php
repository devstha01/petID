<?php

namespace App\Domain\Subscriber\Requests\User;

use App\Cloudsa9\Constants\DBTable;
use App\Cloudsa9\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class AccountRequest
 * @package App\Domain\Subscriber\Requests\User
 */
class AccountRequest extends FormRequest implements IFormRequest
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
            'email' => 'required|string|email|max:255', Rule::unique(DBTable::USERS)->ignore(currentUser()->id),
            'phone' => 'required',
        ];
    }
}
