<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\SearchByFilters\FetchByFilters;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(): PostCollection
    {
        $perPage = $this->getPerPage();

        $query = FetchByFilters::apply(request(), new Post());

        $result = $query->paginate($perPage, ['*'], 'page', request('page'));

        return new PostCollection($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  request()
     *
     * @return void
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     *
     * @return void
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     *
     * @return void
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  request()
     * @param  \App\Models\Post  $post
     *
     * @return void
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     *
     * @return void
     */
    public function destroy(Post $post)
    {
        $post->delete();
    }
}
