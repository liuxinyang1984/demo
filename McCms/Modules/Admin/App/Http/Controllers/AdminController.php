<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = $this->getMenus();
        return view('admin::index',compact('menus'));
    }

    public function home(){
        return view('admin::home');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
    public function getMenus(){
        $menus =[
            [
                'title' => '首页',
                'icon'  => 'bi bi-house',
                'persission'    => 'permission',
                'url'           =>  '/admin/home'
            ],
            [
                'title' => '库存管理',
                'icon'  => 'bi bi-bar-chart-line',
                'persission'    => 'permission',
                'menus'         =>[
                    [
                        'title' => '产品管理',
                        'icon'  => 'bi bi-projector',
                        'persission'    => 'permission',
                        'url'           => "#"
                    ],
                    [
                        'title' => '配件管理',
                        'icon'  => 'bi bi-projector',
                        'persission'    => 'permission',
                        'url'           => "#"
                    ]
                ]
            ],
            [
                'title' => '库存设置',
                'icon'  => 'bi bi-gear',
                'persission'    => 'permission',
                'menus'         =>[
                    [
                        'title' => '产品设置',
                        'icon'  => 'bi bi-projector',
                        'persission'    => 'permission',
                        'url'           => "#"
                    ],
                    [
                        'title' => '配件设置',
                        'icon'  => 'bi bi-projector',
                        'persission'    => 'permission',
                        'url'           => "#"
                    ]
                ]
            ],
            [
                'title' => '文章管理',
                'icon'  => 'bi bi-book',
                'persission'    => 'permission',
                'menus'         =>[
                    [
                        'title' => '分类管理',
                        'icon'  => 'bi bi-projector',
                        'persission'    => 'permission',
                        'url'           => "/article/category"
                    ],
                ]
            ],
        ];

        return $menus;
    }
}
