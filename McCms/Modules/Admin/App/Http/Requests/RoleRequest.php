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
            'ename'=>'required|unique:roles,ename,'.$id
        ];
    }


    public function messages()
    {
        return [
            'name.required'=>'角色名称不能为空',
            'name.unique'=>'角色名称已经存在',
            'ename.required'=>'角色描述不能为空',
            'ename.unique'=>'角色描述已经存在'
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
