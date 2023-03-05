<?php

namespace App\Http\Controllers\API\Magazine;

use App\Http\Controllers\Controller;
use App\Http\Requests\Magazine\StoreCategoryRequest;
use App\Http\Resources\Magazine\CategoryResource;
use App\Models\Magazine\Category;
use Exception;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
       $category = Category::query();
        if ($request->only('search') && $request->only('col')) {
            $category = $category->where($request->get('col'), 'like', '%' . $request->get('search') . '%');
        }
       if($request->only('sort')){
           $category = $category->orderBy($request->get('sort'), $request->get('dir'));
       }else{
           $category = $category->orderBy('id', 'ASC');
       }
       $category = $category->paginate(15);
       return response()->json($category, 200);
    }
    public function store(StoreCategoryRequest $request)
    {
        $input = $request->all();

        try {
            $input['createdBy'] = $request->user()->id;
            $category = Category::create($input);
            $response = [
                'success'=>true,
                'data'=>new CategoryResource($category),
                'message'=>'category store success',
            ];
            return response()->json($response, 200);
        }catch (Exception $e) {
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
        $category = Category::find($id);
        try {
            if (!$category==null){
                $response = [
                    'success' => true,
                    'data' => new CategoryResource($category),
                    'message' => 'show category success',
                ];
                return response()->json($response,200);

            }else{
                $response = [
                  'success' => false,
                  'message' => 'category is not exist',
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
    public function update(StoreCategoryRequest $request, Category $category)
    {
        $input = $request->all();
        try {
            $category->title = $input['title'];
            $category->slug = $input['slug'];
            $category->order = $input['order'];
            $category->status = $input['status'];
            $category->meta_desc = $input['meta_desc'];
            $category->meta_title = $input['meta_title'];
            $category->description = $input['description'];
            $category->parent_id = $input['parent_id'];
            $category->createdBy = $request->user()->id;
            $category->editedBy = $request->user()->id;
            $category->save();

            $response = [
              'success' => true,
              'data' => new CategoryResource($category),
              'message' => 'category update success',
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
    public function destroy(Category $category)
    {
        $category->delete();
        try {
            $response = [
                'success' => true,
                'data' => new CategoryResource($category),
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
