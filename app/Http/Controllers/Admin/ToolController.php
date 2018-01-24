<?php

namespace App\Http\Controllers\Admin;

use App\Services\UploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class ToolController extends Controller
{
    /**
     * 上传图片
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadPic(Request $request)
    {
        $file = $request->file('file');
        $upload = new UploadService();
        $result = $upload->uploadPic($file);
        return \Response::json($result);
    }

    /**
     * 上传头像
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadAvatar(Request $request)
    {
        $params = $request->input('avatar_data');

        $file = $request->file('avatar_file');

        $formatParams = json_decode($params, true);

        $upload = new UploadService();
        $result = $upload->uploadFile($file, $formatParams);
        if($result['status']){
            $user = \Auth::guard('admin')->user();
            $user->avatar = $result['src'];
            $user->save();
        }
        return \Response::json($result);
    }
}
