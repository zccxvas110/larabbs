<?php

namespace App\Handlers;

use  Illuminate\Support\Str;
use  Image;

class ImageUploadHandler
{
    //允许一下后缀图片上传
    protected $allowed_ext = ['png','jpg','gif','jpeg'];

    public function save($file,$forder,$file_prefix)
    {
        //构建存储的文件夹规则,如:upload/images/avatar/201912/11
        //文件夹切割能让查找更效率
        $forder_name = "upload/images/{$forder}/".date('Ym/d',time(),$max_width = false);

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path = public_path().'/'.$forder_name;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ? :'png';

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        // 如果上传的不是图片将终止操作
        if( !in_array($extension,$this->allowed_ext))
        {
            return false;
        }

        // 将图片移动到我们的目标存储路径中
        $file->move($upload_path,$filename);

        //// 如果限制了图片宽度，就进行裁剪
        if($max_width && $extension != 'gif')
        {
            $this->reduceSize($upload_path.'/'.$filename,$max_width);
        }

        return [
          "path" => config('app.url')."/$forder_name/$filename"
        ];

    }

    public function reduceSize($file_path, $max_width)
    {

        $image = Image::make($file_path);

        $image->resize($max_width,null,function($constraint){
            //设定宽度是 $max_width,高度等比缩放
            $constraint->aspectRatio();

            //防止截图时尺寸变大
            $constraint->upsize();

        });

        //对图片修改后保存
        $image->save();
    }
}
