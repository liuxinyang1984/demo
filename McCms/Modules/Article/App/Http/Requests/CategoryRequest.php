<?php

namespace Modules\Article\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('category')?$this->route('category')->id:0;
        return [
            'name'=>'required|unique:categories,name,'.$id,
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required'=>'栏目名称不能为空',
            'name.unique'=>'栏目名称已经存在'
        ];
    }
}
