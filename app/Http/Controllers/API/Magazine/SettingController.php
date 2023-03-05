<?php

namespace App\Http\Controllers\API\Magazine;

use App\Http\Controllers\Controller;
use App\Http\Requests\Magazine\StoreSettingRequrst;
use App\Http\Resources\Magazine\SettingResource;
use App\Models\Magazine\Setting;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
       $setting = Setting::query();
       if ($request->only('search') && $request->only('col')){
           $setting = $setting->where($request->get('col'), 'like', '%' . $request->get('search') . '%');
       }
       if($request->only('sort')){
           $setting = $setting->orderBy($request->get('sort') , $request->get('dir'));
       }else {
           $setting = $setting->orderBy('id' , 'ASC');
       }
       $setting = $setting->paginate(15);
       return response()->json($setting , 200);
    }


    public function store(StoreSettingRequrst $request)
    {
        $input = $request->all();
        try {
                $setting = Setting::create($input);
                $response = [
                    'success' => true,
                    'data' => new SettingResource($setting),
                    'message' => 'slider success',
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
        $setting = Setting::find($id);
            try {
                if (!$setting == null) {
                    $response = [
                        'success' => true,
                        'data' => new SettingResource($setting),
                        'message' => 'pedram success',
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
                var_dump('Exception Message: '. $message);

                $code = $e->getCode();
                var_dump('Exception Code: '. $code);

                $string = $e->__toString();
                var_dump('Exception String: '. $string);

                exit;
            }
        }
    public function update(StoreSettingRequrst $request, Setting $setting)
    {
        $input = $request->all();
        try {
            $setting->title = $input['title'];
            $setting->meta_title = $input['meta_title'];
            $setting->description = $input['description'];
            $setting->header_btn = $input['header_btn'];
            $setting->header_link= $input['header_link'];
            $setting->area_code= $input['area_code'];
            $setting->phone_number = $input['phone_number'];
            $setting->mag_home_desc= $input['mag_home_desc'];
            $setting->mag_video_desc= $input['mag_video_desc'];
            $setting->save();

            $response = [
                'success' => true,
                'data' => new SettingResource($setting),
                'message' => 'setting success',
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
    public function destroy(Setting $setting)
    {
        $setting->delete();
        try {
            $response = [
                'success' => true,
                'data' => new SettingResource($setting),
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

