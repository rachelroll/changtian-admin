<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $file=$request->file('upload_file');

        if ($file->isValid()) {
            //$extension=$file->getClientOriginalExtension();
            $path=$file->getRealPath();
            $filename = 'images/' . date('Y-m-d-h-i-s') . '-' .  $file->getClientOriginalName();
            $bool= Storage::disk('oss')->put($filename,file_get_contents($path));
            if ($bool) {
                return [
                    'data'=>[
                        'http:'.env('CDN_DOMAIN') . '/' .$filename,
                    ],
                    'errno'=>0
                ];
                return [
                    "hash"=> "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                    'key'=>'http:'.env('CDN_DOMAIN') . '/' .$filename,
                    'errno'=>0,
                ];
            } else {
                return [
                    'success'   => false,
                    'msg'       => "上传失败,请联系管理员",
                    'file_path' => '',
                    'key' => '',
                ];
            }
        }

    }
}
