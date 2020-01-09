<?php

namespace App\Domain\Admin\Requests\Subscriber;

use App\Cloudsa9\Constants\DBTable;
use App\Cloudsa9\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;

/**
 * Class SubscriberCreateRequest
 * @package App\Domain\Subscriber\Requests\User
 */
class SubscriberCreateRequest extends FormRequest implements IFormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . DBTable::USERS,
            // 'phone' => 'required|string',
            'password' => 'required|confirmed|min:6',
            // 'account_type' => 'required',
            // 'status' => 'required',

            // 'contact_name' => 'required|string|max:255',
            // 'contact_email' => 'required|string|email|max:255',
            'contact_phone1' => 'required',
           
//            'contact_address1' => 'required|string|max:255',
//            'contact_city' => 'required|string|max:255',
//            'contact_state' => 'required|string|max:255',
//            'contact_zip' => 'required|string|max:255',
            'contact_reward' => 'required',
        ];
    }
}
