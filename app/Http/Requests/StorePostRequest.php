<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() // what i can do in website
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
            'title'=>['required','min:3',
            Rule::unique('posts', 'title')->ignore($this->post)
            ],
            'description'=>['required','min:10'],
            'post_creator'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Title field is required',
            'title.unique'=>"Title already exists before,Please enter another one",
            'description.required'=>'Description field is required',
            'post_creator.required'=>'post creator field is required'
        ];
    }
}
