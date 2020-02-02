<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BlogPosts extends FormRequest
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
    public function rules(Request $request)
    {
        if($this->method()=='PUT' or $this->method()=='PATCH'){
          if($request->publish==2){
            return [
              'title'=>'required|max:185|unique:posts,title,'.$this->post->id,
              'description'=>'required',
              'short_description'=>'required|max:200|min:100',
              'category'=>'required',
              'publist_time'=>'required|date',
              'image'=>'image|dimensions:width=800,height=550',
            ];
          }else {
            return[
              'title'=>'required|max:185|unique:posts,title,'.$this->post->id,
              'description'=>'required',
              'short_description'=>'required|max:200|min:100',
              'category'=>'required',
              'image'=>'image|dimensions:width=800,height=550',
            ];
          }
        }else{
          if($request->publish==2){
            return [
              'title'=>'required|unique:posts|max:185',
              'description'=>'required',
              'short_description'=>'required|max:200|min:100',
              'category'=>'required',
              'publist_time'=>'required|date',
              'image'=>'required|image|dimensions:width=800,height=550',
            ];
          }else {
            return[
              'title'=>'required|unique:posts|max:185',
              'description'=>'required',
              'short_description'=>'required|max:200|min:100',
              'category'=>'required',
              'image'=>'required|image|dimensions:width=800,height=550',
            ];
          }
        }
    }

    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array
 */
    public function messages()
    {
        return [
            'image.dimensions' => 'Image width=800px & height=550px',

        ];
    }
}
