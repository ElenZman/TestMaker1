<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreTestRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

   protected function prepareForValidation(){
    $this-> merge([
        'user_id'=>Auth::user()->id,
    ]);
   }
    public function rules()
    {
        return [
            'title' => 'required|string|max:1000',
            'user_id' => 'required|exists:App\Models\User,id',
            'test_type' => 'required|exists:test_types,id',
            'subject'=>'required|exists:subjects,id',
        ];
    }

    protected $messages = [
        'title.required' => 'Это поле является обязательным',
        'test_type'=> 'Это поле является обязательным',
        'subject.required' => 'Это поле является обязательным',
    ];
}
