<?php

namespace App\Http\Controllers\API\Magazine;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Resources\FaqResource;
use App\Models\Magazine\Faq;
use Exception;
use Illuminate\Http\Request;


class FaqController extends Controller
{
    public function index(Request $request)
    {
       $faq = Faq::query();
        if ($request->only('search') && $request->only('col')) {
            $faq = $faq->where($request->get('col'), 'like', '%' . $request->get('search') . '%');
        }
       if ($request->only('sort')){
           $faq = $faq->orderBy($request->get('sort'), $request->get('dir'));
       }else{
           $faq = $faq->orderBy('id', 'ASC');
       }
       $faq = $faq->paginate(15);
       return response()->json($faq, 200);

    }
    public function store(StoreFaqRequest $request)
    {

        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $tag = Faq::create($input);
            $response = [
                'success' => true,
                'data' => new FaqResource($tag),
                'message' => 'faq store success',
            ];
            return response()->json($response, 200);

        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);

            $code = $e->getCode();
            var_dump('Exception Code: '. $code);

            $string = $e->__toString();
            var_dump('Exception String: '. $string);

            exit;
        }
    }
    public function show($id)
    {
        $tag = Faq::find($id);
        try {
            if (!$tag==null) {
                $response = [
                    'success' => true,
                    'data' => new FaqResource($tag),
                    'message' => 'faq show success',
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
    public function update(StoreFaqRequest $request, Faq $faq)
    {
        $input = $request->all();
        try {
            $faq->slug = $input['slug'];
            $faq->title = $input['title'];
            $faq->createdBy = $request->user()->id;
            $faq->editedBy = $request->user()->id;
            $faq->save();

            $response = [
                'success' => true,
                'data' => new FaqResource($faq),
                'message' => 'faq update success',
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
    public function destroy(Faq $faq)
    {
        $faq->delete();
        try {
            $response = [
                'success' => true,
                'data' => new FaqResource($faq),
                'message' => 'faq delete success',
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
