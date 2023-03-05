<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreSaleCategoryRequest;
use App\Http\Resources\Shop\SaleCategoryResource;
use App\Models\SaleCategory;
use Exception;
use Illuminate\Http\Request;

class SaleCategoryController extends Controller
{
    public function index(Request $request)
    {
        $sale = SaleCategory::query();
        if ($request->only('search')&&$request->only('col')) {
            $search = explode(' ' , $request->get('search'));
            $col = $request->get('col');
            $sale = $sale->where(function($q) use ($col , $search){
                foreach ($search as $val)
                {
                    $q->orWhere($col , 'like' , '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $sale =$sale->orderBy($request->get('sort'), $request->get('dir'));
        }else{
            $sale = $sale->orderBy('id', 'ASC');
        }
        $sale = $sale->paginate(15);
        return response()->json($sale, 200);
    }

    public function store(StoreSaleCategoryRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $sale = SaleCategory::create($input);
            $response = [
              'success'=>true,
              'data'=>new SaleCategoryResource($sale),
              'message'=>'sale category create success'
            ];
            return response()->json($response,200);
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
        $sale = SaleCategory::find($id);
        try {
            if (!$sale==null){
                $response = [
                    'success' => true,
                    'data'=>new SaleCategoryResource($sale),
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
    public function update(StoreSaleCategoryRequest $request, $id)
    {
        try {
            $input = $request->all();
            $sale = SaleCategory::where('id', $id)->update($input);
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
    public function destroy(SaleCategory $sale)
    {
        $sale->delete();
        try {
            $response = [
                'success' => true,
                'data' => new SaleCategoryResource($sale),
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
