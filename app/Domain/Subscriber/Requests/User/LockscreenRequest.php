<?php

namespace App\Domain\Subscriber\Requests\User;

use App\Cloudsa9\Contracts\IFormRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LockscreenRequest
 * @package App\Domain\Subscriber\Requests\User
 */
class LockscreenRequest extends FormRequest implements IFormRequest
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
            'device' => 'required',
            'lockscreen_color' => 'required',
        ];
    }
}
