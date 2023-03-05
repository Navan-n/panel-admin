<?php

namespace App\Http\Controllers\API\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\StoreGiftOfferRequest;
use App\Http\Resources\Shop\GiftOfferResource;
use App\Models\GiftOffers;
use Exception;
use Illuminate\Http\Request;

class GiftOfferController extends Controller
{
    public function index(Request $request)
    {
        $gift = GiftOffers::query();
        if ($request->only('search')&&$request->only('col')) {
            $search = explode(' ' , $request->get('search'));
            $col = $request->get('col');
            $gift = $gift->where(function($q) use ($col , $search){
                foreach ($search as $val)
                {
                    $q->orWhere($col , 'like' , '%' . $val . '%');
                }
            });
        }
        if ($request->only('sort')) {
            $gift =$gift->orderBy($request->get('sort'), $request->get('dir'));
        }else{
            $gift = $gift->orderBy('id', 'ASC');
        }
        $gift = $gift->paginate(15);
        return response()->json($gift, 200);
    }
    public function store(StoreGiftOfferRequest $request)
    {
        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $gift = GiftOffers::create($input);
            $response = [
                'success'=>true,
                'data'=>new GiftOfferResource($gift),
                'message'=>'Gift Offers create success'
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
        $gift = GiftOffers::find($id);
        try {
            if (!$gift==null){
                $response = [
                    'success' => true,
                    'data'=>new GiftOfferResource($gift),
                    'message' => 'gift offer success'
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'gift offer is not exist',
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
    public function update(StoreGiftOfferRequest $request, $id)
    {
        try {
            $input = $request->all();
            $gift = GiftOffers::where('id', $id)->update($input);
            $response = [
                'success' => true,
                'message' => 'update gift offer success',
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
    public function destroy(GiftOffers $gift)
    {
        $gift->delete();
        try {
            $response = [
                'success' => true,
                'data' => new GiftOfferResource($gift),
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
