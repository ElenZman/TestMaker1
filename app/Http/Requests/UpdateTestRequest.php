<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $test =$this->route('test');
        if($this->user()->id!==$test->user_id){
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:1000',
            'user-id' => 'exists:users, id',
            'test_type_id' => 'exists:test_types, id',
            'subject_id'=>'exists:subjects,id',
            'questions' => 'array'
        ];
    }
}
