<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreCategoryRequest;
use App\Http\Resources\Shop\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
    $category = Category::query();
        if ($request->only('search')&&$request->only('col')) {
            $search = explode(' ' , $request->get('search'));
            $col = $request->get('col');
            $category = $category->where(function($q) use ($col , $search){
               foreach ($search as $val){
                   $q->orWhere($col , 'like' , '%' . $val . '%');
               }
            });
        }
        if ($request->only('sort')){
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
            $input['editedBy'] = $request->user()->id;
            $category= Category::create($input);
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
                  'data'=>new CategoryResource($category),
                  'message' => 'show category success'
                ];
                return response()->json($response, 200);
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
    public function update(StoreCategoryRequest $request, $id)
    {
        try {
            $input = $request->all();
            $category = Category::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update category success',
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
