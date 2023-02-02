<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Post::all(), 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file = $request->file('photo');
        $fileName = Str::random(50) . "." . $file->getClientOriginalExtension();
        $file->storeAS('public', $fileName);

        return response(Post::create([
          'name' => $request->name,
          'photo' => $fileName
      ]), 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      $file = $request->file('photo');
      $fileName = Str::random(50) . "." . $file->getClientOriginalExtension();
      $file->storeAS('public  ', $fileName);

      return response($post->update([
        'name' => $request->name,
        'photo' => $fileName
    ]), 203);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        return response([
            'state' => $post->delete(),
            'idUser' => $post->id,
            'infos' => 'post deleted'
        ]);
    }
}
