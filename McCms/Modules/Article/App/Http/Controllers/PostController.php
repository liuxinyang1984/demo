<?php

namespace Modules\Article\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Article\App\Models\Category;
use Modules\Article\App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd($tree);
        $cate = Category::all();
        $cate = $cate->pluck('name','id');
        $posts = Post::all();
        return view('article::post.index',compact('posts','cate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tree = Category::getAll();
        $post = null;
        return view('article::post.edit',compact('tree'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Post $post): RedirectResponse
    {
        if($post->create($request->all())){
            return redirect(route('article.post.index'))->with('success','新建文章成功');
        }else{
            return redirect(route('article.post.index'))->with('danger','新建文章失败');
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
    public function edit(Post $post)
    {
        $tree = Category::getAll();
        return view('article::post.edit',compact('post','tree'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        if($post->update($request->all())){
            return redirect(route('article.post.index'))->with('success','文章修改成功');
        }else{
            return back()->with('danger','新建修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function test(Request $request){
        dd($request->all());
    }
}
