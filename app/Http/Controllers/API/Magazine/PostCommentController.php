<?php

namespace App\Http\Controllers\API\Magazine;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostCommentRequest;
use App\Http\Resources\PostCommentResource;
use App\Models\Magazine\Comment;
use App\Models\Magazine\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostCommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::query();
        if ($request->only('sort')) {
            $comments = $comments->orderBy($request->get('sort'), $request->get('dir'));
        } else if ($request->only('search')) {
            $comment = Comment::query();
            $comment = $comment->where($request->get('col'), 'like', '%' . $request->get('search') . '%');
            $comment = $comment->paginate(15);
            return response()->json($comment, 200);
        } else {
            $comments = $comments->orderBy('id', 'ASC');
        }
        $comments = $comments->paginate(15);
        return response()->json($comments, 200);
    }

    public function store(StorePostCommentRequest $request)
    {

        try {
            $input = $request->all();
            $input['createdBy'] = $request->user()->id;
            $input['customer_id'] = $request->user()->id;
            $comment = Comment::create($input);
            $response = [
                'success' => true,
                'data' => new PostCommentResource($comment),
                'message' => 'store comment success',
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

    public function update(StorePostCommentRequest $request, Comment $comment)
    {
        $input = $request->all();
        try {
            $comment->post_id = $input['post_id'];
            $comment->name = $input['name'];
            $comment->email = $input['email'];
            $comment->body = $input['body'];
            $comment->like = $input['like'];
            $comment->dislike = $input['dislike'];
            $comment->is_answer = $input['is_answer'];
            $comment->status = $input['status'];
            $comment->customer_id = $request->user()->id;
            $comment->createdBy = $request->user()->id;
            $comment->editedBy = $request->user()->id;
            $comment->save();

            $response = [
                'success' => true,
                'data' => new PostCommentResource($comment),
                'message' => 'update comment success',
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
        $comment = Comment::find($id);
        try {
            if (!$comment == null) {
                $response = [
                    'success' => true,
                    'data' => new PostCommentResource($comment),
                    'message' => 'show comment success',
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "comment for show not found",
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

    public function like($id)
    {
        $comment = Comment::find($id);
        Comment::find($comment->id)->increment('like');
    }

    public function dislike($id)
    {
        $comment = Comment::find($id);
        Comment::find($comment->id)->increment('dislike');
    }


}
