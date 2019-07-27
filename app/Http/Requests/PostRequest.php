<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $post = request()->route()->parameter('post');

        //If create new post, just use this rule
        $slug_rule = 'nullable|unique:posts,slug';
        //Edit, only edit has post id and we need to 'skip' it
        if($post){
          $slug_rule .= ','.$post->id;
        }
        return [
            'title' => 'required',
            'body' => 'nullable|min:10',
            //Apply the rule
            'slug' => $slug_rule,
            'cover_img' => 'image|nullable|max:20000'
        ];
    }
}
