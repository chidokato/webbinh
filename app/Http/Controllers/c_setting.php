<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use Image;
use File;

class c_setting extends Controller
{
    public function getlist()
    {
    	$setting = setting::where('id',1)->first();
    	return view('admin.setting.list',['data'=>$setting]);
    }

    public function postedit(Request $Request,$id)
    {
        $this->validate($Request,['name' => 'Required'],[] );
        $setting = setting::find($id);
        $setting->name = $Request->name;
        $setting->address = $Request->address;
        $setting->email = $Request->email;
        $setting->footer = $Request->footer;
        $setting->hotline = $Request->hotline;
        $setting->hotline1 = $Request->hotline1;
        $setting->facebook = $Request->facebook;
        $setting->youtube = $Request->youtube;
        $setting->twitter = $Request->twitter;
        $setting->analytics = $Request->analytics;
        $setting->fbapp = $Request->fbapp;
        $setting->sidebar = $Request->sidebar;
        $setting->maps = $Request->maps;
        $setting->codeheader = $Request->codeheader;
        $setting->codebody = $Request->codebody;
        $setting->title = $Request->title;
        $setting->description = $Request->description;
        $setting->keywords = $Request->keywords;
        $setting->robot = $Request->robot;
        if ($Request->hasFile('favicon')) {
            // xóa ảnh cũ
            if(File::exists('data/themes/'.$setting->img)) { 
                File::delete('data/themes/'.$setting->img); 
            }
            // xóa ảnh cũ
            // thêm ảnh mới
            $file = $Request->file('favicon');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/themes/".$filename)){ $filename = str_random(4)."_".$filename; }
            $img = Image::make($file)->resize(16, 16, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/themes/'.$filename));
            $setting->img = $filename;
            // thêm ảnh mới
        }
        $setting->save();
        return redirect('admin/setting/list')->with('Success','Success');
    }
}
