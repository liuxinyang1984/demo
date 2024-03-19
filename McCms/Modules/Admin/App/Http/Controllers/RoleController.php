<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\App\Http\Requests\RoleRequest;
use PhpParser\Node\Stmt\TryCatch;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();
        return view('admin::role.role',compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        try{
            Role::create([
                'name'=>$request->name,
                'cname'=>$request->cname
            ]);
        }catch(\Exception $e){
            dd($e->getMessage());
        }
        session()->flash('success','角色添加成功');
        return back();
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin::show');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request,Role $role): RedirectResponse
    {
        $role->update([
            'name'=>$request->name,
            'cname'=>$request->cname
        ]);
        session()->flash('success','修改成功');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if($role->delete()){
            return back()->with('success','删除成功');
        }else{
            return back()->with('danger','删除失败');
        }
    }


    public function permission(Role $role){
        $permissions = Permission::get();
        return view('admin::role.permission',compact('permissions','role'));
    }
    public function updatePermission(Request $request,Role $role){
        $role->syncPermissions($request->permission);
        session()->flash('success','修改权限成功');
        return redirect(route('admin.role.index'));
    }
}
