<?php

namespace App\Http\Controllers\API\Magazine;

use App\Http\Controllers\Controller;
use App\Http\Requests\Magazine\StoreBannerRequest;
use App\Http\Resources\Magazine\BannerResource;
use App\Models\Magazine\Banner;
use Exception;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $banner = Banner::query();
        if ($request->only('search') && $request->only('col')) {
            $banner = $banner->where($request->get('col'), 'like', '%' . $request->get('search') . '%');
        }
        if ($request->only('sort')) {
            $banner = $banner->orderBy($request->get('sort'), $request->get('dir'));
        } else {
            $banner = $banner->orderBy('id', 'ASC');
        }
        $banner = $banner->paginate(15);
        return response()->json($banner, 200);
    }
    public function store(StoreBannerRequest $request)
    {

        $input = $request->all();
        try {
            $input['createdBy'] = $request->user()->id;
            $banner = Banner::create($input);
            $response = [
                'success' => true,
                'data' => new BannerResource($banner),
                'message' => 'banner store success',
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
        $banner = Banner::find($id);
        try {
            if (!$banner == null) {
                $response = [
                    'success' => true,
                    'data' => new BannerResource($banner),
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

    public function update(StoreBannerRequest $request, Banner $banner)
    {
        $input = $request->all();
        try {
            $banner->title = $input['title'];
            $banner->alt = $input['alt'];
            $banner->code = $input['code'];
            $banner->link = $input['link'];
            $banner->landing_page = $input['landing_page'];
            $banner->row = $input['row'];
            $banner->col = $input['col'];
            $banner->order = $input['order'];
            $banner->status = $input['status'];
            $banner->createdBy = $request->user()->id;
            $banner->editedBy = $request->user()->id;
            $banner->save();

            $response = [
                'success' => true,
                'data' => new BannerResource($banner),
                'message' => 'banner update success',
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

    public function destroy(Banner $banner)
    {
        $banner->delete();
        try {
            $response = [
                'success' => true,
                'data' => new BannerResource($banner),
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
