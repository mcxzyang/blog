<?php
/**
 * User: yff
 * Date: 2017/12/25
 * Time: 下午9:12
 */

/**
 * 获取图片资源
 * @param $avatar
 *
 * @return string
 */
function getPicAsset($avatar){
    if(strpos($avatar, '/') === 0){
        return asset($avatar);
    } else {
        if(strpos($avatar, 'http') === false && strpos($avatar, 'adminImage') === false){
            $header = (strpos(env('QINIU_DOMAIN'), 'http') !== false || strpos(env('QINIU_DOMAIN'), 'https') !== false) ? env('QINIU_DOMAIN') : 'http://' .env('QINIU_DOMAIN');
            $asset = $header . '/' . $avatar;
        } else {
            $asset = strpos($avatar, 'http') ? $avatar : asset($avatar);
        }
        return asset($asset);
    }
}

/**
 * 获取指定尺寸七牛图片
 * @param     $pic
 * @param     $w
 * @param     $h
 * @param int $m
 *
 * @return string
 */
function getQiniuPic($pic, $w, $h, $m = 1){
    $header = (strpos(env('QINIU_DOMAIN'), 'http') !== false || strpos(env('QINIU_DOMAIN'), 'https') !== false) ? env('QINIU_DOMAIN') : 'http://' .env('QINIU_DOMAIN');
    $url = $header . '/' . $pic . '?imageView2/' .$m;
    if($w){
        $url .= '/w/'.$w;
    }
    if($h){
        $url .= '/h/'.$h;
    }
    return $url;
}

/**
 * 自定义 Ajax 返回格式
 *
 * @param $status
 * @param $respond
 * @return \Illuminate\Http\JsonResponse
 */
function respond($status, $respond)
{
    return response()->json(['status' => $status, is_string($respond) ? 'message' : 'data' => $respond]);
}

/**
 * 自定义 Ajax 成功返回
 *
 * @param $respond
 * @return \Illuminate\Http\JsonResponse
 */
function succeed($respond = 'Request success!')
{
    return respond(true, $respond);
}

/**
 * 自定义 Ajax 失败返回
 *
 * @param $respond
 * @return \Illuminate\Http\JsonResponse
 */
function failed($respond = 'Request failed!')
{
    return respond(false, $respond);
}

/**
 * 检查路由是否存在，依检查结果返回 link 或 slug
 *
 * @param $slug
 * @return string
 */
function linker($slug = null)
{
    return \Route::has($slug) ? route($slug) : $slug;
}
