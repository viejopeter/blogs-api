<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(): JsonResponse
    {
        $blogs = Blog::where('user_id','2')->get();

        return response()->json($blogs);
    }

    public function store(Request $request): JsonResponse
    {
        $this->validateRequest($request);

        $attributes = $request->only(['slug', 'title', 'short_description', 'description', 'user_id']);
        $blogs = Blog::create($attributes);

        return response()->json(['message'=>'success','result' => $blogs], 200);
    }

    public function show(Blog $blog): JsonResponse
    {
       return response()->json($blog);
    }

    public function update(Request $request, Blog $blog): JsonResponse
    {
        $this->validateRequest($request);

        $attributes = $request->only(['slug', 'title', 'short_description', 'description', 'user_id']);
        $blog->update($attributes);

        return response()->json(['message'=>'success'], 200);
    }

    public function destroy(Blog $blog): JsonResponse
    {
        $blog->delete();
        return response()->json(['message'=>'success'], 200);
    }
    private function validateRequest(Request $request){
        $request->validate([
            'slug' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'user_id' => 'required',
        ]);
    }
}
