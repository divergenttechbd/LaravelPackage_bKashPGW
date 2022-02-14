<?php

namespace Divergent\Bkash\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BkashPaymentIDRequest extends FormRequest
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
            'paymentID' => [  
                'required',              
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/'
            ],
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
            "paymentID.required" => "Please enter paymentID",
            "paymentID.min" => "The paymentID has to have at least :min characters.",
            'paymentID.regex' => 'The paymentID must contain both UPPERCASE character and numeric value.',
        ];
    }
}
