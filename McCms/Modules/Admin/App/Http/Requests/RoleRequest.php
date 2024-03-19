<?php

namespace Modules\Admin\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $role = $this->route('role');
        $id = $role?$role->id:null;
        return [
            'name'=>'required|unique:roles,name,'.$id,
            'cname'=>'required|unique:roles,cname,'.$id
        ];
    }


    public function messages()
    {
        return [
            'name.required'=>'角色名称不能为空',
            'name.unique'=>'角色名称已经存在',
            'cname.required'=>'角色描述不能为空',
            'cname.unique'=>'角色描述已经存在'
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
