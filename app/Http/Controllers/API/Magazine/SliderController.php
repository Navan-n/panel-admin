<?php

namespace App\Http\Controllers\API\Magazine;


use App\Http\Controllers\Controller;
use App\Http\Requests\Magazine\StoreSliderRequrst;
use App\Http\Resources\Magazine\SliderResource;
use App\Models\Magazine\Slider;
use Exception;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $slider = Slider::query();
        if ($request->only('search') && $request->only('col')) {
            $slider = $slider->where($request->get('col'), 'like', '%' . $request->get('search') . '%');
        }
        if ($request->only('sort')) {
            $slider = $slider->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $slider = $slider->orderBy('id', 'ASC');
        }
        $slider = $slider->paginate(15);
        return response()->json($slider, 200);
    }

    public function store(StoreSliderRequrst $request)
    {
        $input = $request->all();

        try {
            $input['createdBy'] = $request->user()->id;
            $slider = Slider::create($input);
            $response = [
                'success' => true,
                'data' => new SliderResource($slider),
                'message' => 'slider success',
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
        $slider = Slider::find($id);
        try {
            if (!$slider == null) {
                $response = [
                    'success' => true,
                    'data' => new SliderResource($slider),
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
            var_dump('Exception Message: ' . $message);

            $code = $e->getCode();
            var_dump('Exception Code: ' . $code);

            $string = $e->__toString();
            var_dump('Exception String: ' . $string);

            exit;
        }
    }

    public function update(StoreSliderRequrst $request, Slider $slider)
    {
        $input = $request->all();

        try {

            $slider->title = $input['title'];
            $slider->alt = $input['alt'];
            $slider->link = $input['link'];
            $slider->position = $input['position'];
            $slider->createdBy = $request->user()->id;
            $slider->editedBy = $request->user()->id;;
            $slider->save();

            $response = [
                'success' => true,
                'data' => new SliderResource($slider),
                'message' => 'slider success',
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

    public function destroy(Slider $slider)
    {
        $slider->delete();
        try {
            $response = [
                'success' => true,
                'data' => new SliderResource($slider),
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
