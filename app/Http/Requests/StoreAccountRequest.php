<?php

namespace App\Http\Requests;

use App\Events\AccountRegistered;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->isMethod('POST')) {
            return [
                'users_id' => 'required|exists:users,id',
                'account_types_id' => 'required',
                'balance' => 'sometimes|numeric'
            ];
        } else {
            return [
                'users_id' => 'sometimes|exists:users,id',
                'balance' => 'sometimes|numeric'
            ];
        }
    }

    protected function prepareForValidation()
    {
        event(new AccountRegistered());
        $this->merge([
            'users_id' => request('users_id'),
        ]);
    }
}
