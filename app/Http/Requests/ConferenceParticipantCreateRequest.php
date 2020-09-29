<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ConferenceParticipantCreateRequest extends FormRequest
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
        $rules = [
            'participant.first_name'    => 'string|required|min:2|max:200',
            'participant.last_name'     => 'string|min:2|max:200',
            'participant.email_address' => 'required|email:rfc,dns',
            'participant.phone_number'  => 'required|integer',
            'participant.department_id' => 'required',
            'lecture.title'             => 'required_if:with_lecture,on',
            'lecture.description'       => 'required_if:with_lecture,on',
        ];
        return $rules;
    }
}
