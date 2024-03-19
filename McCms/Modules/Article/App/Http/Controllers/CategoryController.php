<?php

namespace Modules\Article\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Article\App\Http\Requests\CategoryRequest;
use Modules\Article\App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return "article\category";
        $categories = Category::all();
        $tree = Category::getAll();
        //dd($tree);
        // dd($tree);
        return view('article::category.index',compact('categories','tree'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request,Category $category): RedirectResponse
    {
        $category->fill($request->all());
        if($category->save()){
            return redirect(route('article.category.index'))->with('success','新建分类成功');
        }else{
            return redirect(route('article.category.index'))->with('danger','新建分类失败');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('article::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('article::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request,Category $category): RedirectResponse
    {
        if($category->update($request->all())){
            return redirect(route('article.category.index'))->with('success','修改分类成功');
        }else{
            return redirect(route('article.category.index'))->with('danger','修改分类失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->hasChild()){
            return redirect(route('article.category.index'))->with('warning','有子分类未删除');
        }
        if($category->delete()){
            return redirect(route('article.category.index'))->with('success','删除分类成功');
        }else{
            return redirect(route('article.category.index'))->with('danger','删除分类失败');
        }
    }
}
