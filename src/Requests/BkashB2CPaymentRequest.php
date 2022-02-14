<?php

namespace Divergent\Bkash\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BkashB2CPaymentRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required|numeric',
            'receiverMSISDN' => 'required|digits:11|numeric'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'receiverMSISDN.numeric' => 'The receiverMSISDN must be a number.',
            'receiverMSISDN.digits' => 'The receiverMSISDN must be 11 digits.',
        ];
    }
}
