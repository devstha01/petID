<?php

namespace App\Domain\Api\V1\Requests\Subscriber;

use App\Cloudsa9\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

/**
 * Class ContactInfoRequest
 * @package App\Domain\Subscriber\Requests\User
 */
class ContactInfoRequest extends FormRequest implements IFormRequest
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
            'email' => 'required|string|email|max:255',
            'phone1'=>'required',
            // 'phone2'=>'required',
//             'phone1' => [
// //                'required',
//                 function ($attribute, $value, $fail) {
//                     if (!empty($value) && (Input::get('phone2') == $value || Input::get('phone3') == $value || Input::get('phone4') == $value)) {
//                         return $fail('The secondary phone number 1 must be different.');
//                     }
//                     return true;
//                 }
//             ],
//             'phone2' => [
//                 function ($attribute, $value, $fail) {
//                     if (!empty($value) && (Input::get('phone1') == $value || Input::get('phone3') == $value || Input::get('phone4') == $value)) {
//                         return $fail('The secondary phone number 2 must be different.');
//                     }
//                     return true;
//                 }
//             ],
//             'phone3' => [
//                 function ($attribute, $value, $fail) {
//                     if (!empty($value) && (Input::get('phone1') == $value || Input::get('phone2') == $value || Input::get('phone4') == $value)) {
//                         return $fail('The secondary phone number 3 must be different.');
//                     }
//                     return true;
//                 }
//             ],
//             'phone4' => [
//                 function ($attribute, $value, $fail) {
//                     if (!empty($value) && (Input::get('phone1') == $value || Input::get('phone2') == $value || Input::get('phone3') == $value)) {
//                         return $fail('The secondary phone number 4 must be different.');
//                     }
//                     return true;
//                 }
//             ],
            // 'reward' => 'required',
            // 'address1' => 'required',
            // 'address2'=> 'required',
            // 'city'=> 'required',
            // 'state'=>'required',
            // 'zip'=>'required',
            // 'country'=>'required'
        ];
    }
}
