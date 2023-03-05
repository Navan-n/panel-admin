<?php

namespace App\Http\Controllers\API\Magazine;

use App\Http\Controllers\Controller;
use App\Http\Requests\Magazine\StoreTagRequest;
use App\Http\Resources\Magazine\TagResource;
use App\Models\Magazine\Tag;
use Exception;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $tag = Tag::query();
        if ($request->only('search') && $request->only('col')) {
            $tag = $tag->where($request->get('col'), 'like', '%' . $request->get('search') . '%');
        }
        if ($request->only('sort')) {
            $tag = $tag->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $tag = $tag->orderBy('id', 'ASC');
        }
        $tag = $tag->paginate(15);
        return response()->json($tag, 200);
    }

    public function store(StoreTagRequest $request)
    {
        $input = $request->all();

        try {
            $input['createdBy'] = $request->user()->id;
            $tag = Tag::create($input);
            $response = [
                'success' => true,
                'data' => new TagResource($tag),
                'message' => 'tag success',
            ];
            return response()->json($response, 200);

        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);

            $code = $e->getCode();
            var_dump('Exception Code: ' . $code);

            $string = $e->__toString();
            var_dump('Exception String: ' . $string);

            exit;
        }
    }

    public function show($id)
    {
        $tag = Tag::find($id);
        try {
            if (!$tag == null) {
                $response = [
                    'success' => true,
                    'data' => new TagResource($tag),
                    'message' => 'show tags success',
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "not found",
                ];
                return response()->json($response, 401);
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);

            $code = $e->getCode();
            var_dump('Exception Code: ' . $code);

            $string = $e->__toString();
            var_dump('Exception String: ' . $string);

            exit;
        }
    }

    public function update(StoreTagRequest $request, Tag $tag)
    {
        $input = $request->all();
        try {
            $tag->slug = $input['slug'];
            $tag->title = $input['title'];
            $tag->hot = $input['hot'];
            $tag->meta_desc = $input['meta_desc'];
            $tag->body = $input['body'];
            $tag->createdBy = $request->user()->id;
            $tag->editedBy = $request->user()->id;
            $tag->save();

            $response = [
                'success' => true,
                'data' => new TagResource($tag),
                'message' => 'tag success',
            ];
            return response()->json($response, 200);
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);

            $code = $e->getCode();
            var_dump('Exception Code: ' . $code);

            $string = $e->__toString();
            var_dump('Exception String: ' . $string);

            exit;
        }

    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        try {
            $response = [
                'success' => true,
                'data' => new TagResource($tag),
                'message' => 'delete success',
            ];
            return response()->json($response, 200);
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: ' . $message);

            $code = $e->getCode();
            var_dump('Exception Code: ' . $code);

            $string = $e->__toString();
            var_dump('Exception String: ' . $string);

            exit;
        }
    }
}
