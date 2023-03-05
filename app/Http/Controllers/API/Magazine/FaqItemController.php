<?php

namespace App\Http\Controllers\API\Magazine;

use App\Http\Controllers\Controller;
use App\Http\Requests\Magazine\StoreFaqItemRequest;
use App\Http\Resources\Magazine\FaqItemResource;
use App\Models\Magazine\FaqItem;
use Exception;
use Illuminate\Http\Request;

class FaqItemController extends Controller
{
    public function index(Request $request)
    {
        $faqitem = FaqItem::query();
        if ($request->only('search') && $request->only('col')) {
            $faqitem = $faqitem->where($request->get('col'), 'like', '%' . $request->get('search') . '%');
        }
        if ($request->only('sort')){
            $faqitem = $faqitem->orderBy($request->get('sort'), $request->get('dir'));
        }else{
            $faqitem = $faqitem->orderBy('id' , 'ASC');
        }
        $faqitem = $faqitem->paginate(15);
        return response()->json($faqitem, 200);
    }
    public function store(StoreFaqItemRequest $request)
    {

        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $faqitem = FaqItem::create($input);
            $response = [
                'success' => true,
                'data' => new FaqItemResource($faqitem),
                'message' => 'tag success',
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
        $faqitem = FaqItem::find($id);
        try {
            if (!$faqitem==null) {
                $response = [
                    'success' => true,
                    'data' => new FaqItemResource($faqitem),
                    'message' => 'pedram success',
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
}
