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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . DBTable::USERS,
            'phone' => 'required|string',
            'password' => 'required|confirmed|min:6',
            'account_type' => 'required',
            'status' => 'required',

            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|string|email|max:255',
            'contact_phone1' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!empty($value) && (Input::get('contact_phone2') == $value || Input::get('contact_phone3') == $value || Input::get('contact_phone4') == $value)) {
                        return $fail('The secondary phone number 1 must be different.');
                    }
                    return true;
                }
            ],
            'contact_phone2' => [
                function ($attribute, $value, $fail) {
                    if (!empty($value) && (Input::get('contact_phone1') == $value || Input::get('contact_phone3') == $value || Input::get('contact_phone4') == $value)) {
                        return $fail('The secondary phone number 2 must be different.');
                    }
                    return true;
                }
            ],
            'contact_phone3' => [
                function ($attribute, $value, $fail) {
                    if (!empty($value) && (Input::get('contact_phone1') == $value || Input::get('contact_phone2') == $value || Input::get('contact_phone4') == $value)) {
                        return $fail('The secondary phone number 3 must be different.');
                    }
                    return true;
                }
            ],
            'contact_phone4' => [
                function ($attribute, $value, $fail) {
                    if (!empty($value) && (Input::get('contact_phone1') == $value || Input::get('contact_phone2') == $value || Input::get('contact_phone3') == $value)) {
                        return $fail('The secondary phone number 4 must be different.');
                    }
                    return true;
                }
            ],
//            'contact_address1' => 'required|string|max:255',
//            'contact_city' => 'required|string|max:255',
//            'contact_state' => 'required|string|max:255',
//            'contact_zip' => 'required|string|max:255',
            'contact_reward' => 'required',
        ];
    }
}
