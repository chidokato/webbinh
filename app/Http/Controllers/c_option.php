<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Image;
use File;
use App\option;

class c_option extends Controller
{
    public function getlist($key)
    {
        $option = option::where('sort_by',$key)->orderBy('id','desc')->get();
        return view('admin.option.list',[
            'option'=>$option,
            'key'=>$key,
        ]);
    }

    public function getadd($key)
    {
        return view('admin.option.addedit',[
            'key'=>$key,
        ]);
    }

    public function postadd(Request $Request)
    {
        $option = new option;
        $option->user_id = Auth::User()->id;
        $option->sort_by = $Request->key;
        $option->sku = str_random(8);
        $option->name = $Request->name;
        $option->slug = changeTitle($Request->name);
        $option->content = $Request->content;
        $option->status = 'true';
        // thêm ảnh
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/news/300/".$filename)){ $filename = str_random(4)."_".$filename; }
            $img = Image::make($file)->resize(1000, 800, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/news/'.$filename));
            $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/news/300/'.$filename));
            $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/news/80/'.$filename));
            $option->img = $filename;
        }
        // thêm ảnh
        $option->save();
        return redirect('admin/option/'.$Request->key)->with('Alerts','Thành công');
    }
    
    public function getedit($id,$key)
    {
        $data = option::findOrFail($id);
        return view('admin.option.addedit',[
            'data'=>$data,
            'key'=>$key,
        ]);
    }

    public function postedit(Request $Request,$id)
    {
        $option = option::find($id);
        $option->user_id = Auth::User()->id;
        $option->name = $Request->name;
        $option->slug = changeTitle($Request->name);
        $option->content = $Request->content;
        // thêm ảnh
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/news/300/".$filename)){ $filename = str_random(4)."_".$filename; }
            $img = Image::make($file)->resize(1000, 800, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/news/'.$filename));
            $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/news/300/'.$filename));
            $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/news/80/'.$filename));
            $option->img = $filename;
        }
        // thêm ảnh
        $option->save();
        return redirect()->back()->with('Success','Thành công');
    }

    public function getdelete($id)
    {
        $option = option::find($id);
        
        // xóa ảnh
        if(File::exists('data/news/'.$option->img)) {
            File::delete('data/news/'.$option->img);
            File::delete('data/news/300/'.$option->img);
            File::delete('data/news/80/'.$option->img);
        }
        // xóa ảnh
        $option->delete();
        return redirect()->back()->with('Success','Thành công');
    }
}
