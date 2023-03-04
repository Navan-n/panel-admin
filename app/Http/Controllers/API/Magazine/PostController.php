<?php

namespace App\Http\Controllers\API\Magazine;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Magazine\Post;
use Exception;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $post = Post::query();
        if ($request->only('search') && $request->only('col')) {
            $post = $post->where($request->get('col'), 'like', '%' . $request->get('search') . '%');
        }
        if($request->only('sort')){
            $post = $post->orderBy($request->get('sort'), $request->get('dir'));
        }else{
            $post = $post->orderBy('id', 'ASC');
        }
        $post = $post->paginate(15);
        return response()->json($post , 200);
    }
    public function store(StorePostRequest $request)
    {

        try {
            $input = $request->all();
            $input['createdBy'] = $request->user()->id;
            $post = Post::create($input);
            $post->tags()->attach($request->tag_id);
            $post->categories()->attach($request->category_id);
            $response = [
                'success' => true,
                'data' => new PostResource($post),
                'message' => 'post store success'
            ];
        }catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
        return response()->json($response, 200);
    }
    public function show($id)
    {
        $post = Post::find($id);
        try {
            if (!$post==null){
                $response = [
                  'success' => true,
                  'data' => new PostResource($post),
                  'message' => 'show post success',
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => "not found",
                ];
                return response()->json($response, 401);
            }

        }catch (Exception $e){
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
    }
    public function update(StorePostRequest $request, Post $post)
    {
        $input = $request->all();
        try {
            $post->title = $input['title'];
            $post->meta_title = $input['meta_title'];
            $post->meta_desc = $input['meta_desc'];
            $post->abstracted = $input['abstracted'];
            $post->body = $input['body'];
            $post->slug = $input['slug'];
            $post->source = $input['source'];
            $post->source_link= $input['source_link'];
            $post->chief_select = $input['chief_select'];
            $post->embed = $input['embed'];
            $post->alt = $input['alt'];
            $post->type = $input['type'];
            $post->createdBy = $request->user()->id;
            $post->editedBy = $request->user()->id;
            $post->save();

            $response = [
                'success' => true,
                'data' => new PostResource($post),
                'message' => 'tag success',
            ];
            return response()->json($response, 200);
        }catch (Exception $e){
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
    }
    public function desttoy(Post $post)
    {
        $post->delete();
        try {
            $response = [
                'success' => true,
                'data' => new PostResource($post),
                'message' => 'delete success',
            ];
            return response()->json($response, 200);
        }catch (Exception $e){
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
    }
}
