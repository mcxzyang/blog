<?php
/**
 * User: yff
 * Date: 2018/1/4
 * Time: 下午5:36
 */

namespace App\Services;

use Image;

class UploadService
{
    /**
     * 上传图片
     * @param $file
     *
     * @return array
     */
    public function uploadPic($file)
    {
        $check = $this->checkFile($file);
        // 验证
        if(!$check['status']){
            return ['status' => false, 'message' => $check['message']];
        }

        $validator = \Validator::make(['image' => $file], [
            'image' => 'image'
        ]);

        if($validator->fails()){
            return ['status' => false, 'message' => $validator->errors()->first()];
        }

        // 重命名
        $fileName = $this->reName($file->getClientOriginalExtension());

        $disk = \Storage::disk('qiniu');
        $result = $disk->put($fileName, file_get_contents($file->getRealPath()));

        if($result){
            $header = (strpos(env('QINIU_DOMAIN'), 'http') !== false || strpos(env('QINIU_DOMAIN'), 'https') !== false) ? env('QINIU_DOMAIN') : 'http://' .env('QINIU_DOMAIN');
            return [
                'status' => true,
                'url' => $header . '/' . $fileName,
                'src' => $fileName
            ];
        }

        return ['status' => true,'message' => '文件保存失败'];
    }

    /**
     * 上传头像并裁剪
     * @param $file
     * @param $paramsArray
     *
     * @return array
     */
    public function uploadFile($file, $paramsArray)
    {
        $check = $this->checkFile($file);
        // 验证
        if(!$check['status']){
            return ['status' => false, 'message' => $check['message']];
        }

        $validator = \Validator::make(['image' => $file], [
            'image' => 'image'
        ]);

        if($validator->fails()){
            return ['status' => false, 'message' => $validator->errors()->first()];
        }

        // 重命名
        $fileName = $this->reName($file->getClientOriginalExtension());

        // 压缩并截取 并保存图片
        $img = $this->avatar($file, $paramsArray);

        $disk = \Storage::disk('qiniu');
        $result = $disk->put($fileName, $img);

        if($result){
            return [
                'status' => true,
                'url' => 'http://' . env('QINIU_DOMAIN') . '/' . $fileName,
                'src' => $fileName
            ];
        }

        return ['status' => true,'message' => '文件保存失败'];
    }

    /**
     * 验证
     * @param $file
     * @return array
     */
    private function checkFile($file)
    {
        if (!$file->isValid()) {
            return ['status' => false, 'message' => '文件上传失败'];
        }

        if ($file->getClientSize() > $file->getMaxFilesize()) {
            return ['status' => false, 'message' => '上传文件过大'];
        }

        return ['status' => true];
    }

    /**
     * 文件重命名
     * @param $endname
     * @return string
     */
    private function reName($endname)
    {
        return md5($_SERVER['REQUEST_TIME'].mt_rand(0,9999999)).'.'.$endname;
    }


    /**
     * 裁剪
     * @param $file
     * @param $formatParams
     *
     * @return mixed
     */
    public function avatar($file, $formatParams)
    {
        $width = (int) $formatParams['width'];
        $height = (int) $formatParams['height'];
        $x = (int) $formatParams['x'];
        $y = (int) $formatParams['y'];
        $rotate = $formatParams['rotate'];

        $img = Image::make($file->getRealPath());
        $img->rotate($rotate);
        return $img->crop($width, $height, $x, $y)->stream();
    }
}
