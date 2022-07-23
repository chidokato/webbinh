<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Image;
use File;
use App\slider;

class c_slider extends Controller
{
    public function getlist()
    {
        $slider = slider::orderBy('id','desc')->get();
        return view('admin.slider.list',[
            'slider'=>$slider
        ]);
    }

    public function getadd()
    {
        return view('admin.slider.addedit',[
        ]);
    }

    public function postadd(Request $Request)
    {
        $this->validate($Request,['title' => 'Required'],[] );
        $slider = new slider;
        $slider->title = $Request->title;
        $slider->titlesize = $Request->titlesize;
        $slider->text = $Request->text;
        $slider->textsize = $Request->textsize;
        $slider->button = $Request->button;
        $slider->link = $Request->link;
        $slider->colorbutton = $Request->colorbutton;
        $slider->status = 'true';
        // thêm ảnh
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/home/".$filename)){ $filename = str_random(4)."_".$filename; }
            $file->move('data/home', $filename);
            $slider->img = $filename;
        }
        if ($Request->hasFile('imgmobile')) {
            $file = $Request->file('imgmobile');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/home/".$filename)){ $filename = str_random(4)."_".$filename; }
            $file->move('data/home', $filename);
            $slider->imgmobile = $filename;
        }
        // thêm ảnh
        $slider->save();
        return redirect('admin/slider/list')->with('Alerts','Thành công');
    }

    public function getedit($id)
    {
        $data = slider::findOrFail($id);
        return view('admin.slider.addedit',[
            'data'=>$data,
        ]);
    }

    public function postedit(Request $Request,$id)
    {
        $this->validate($Request,['title' => 'Required'],[] );     
        $slider = slider::find($id);
        $slider->title = $Request->title;
        $slider->titlesize = $Request->titlesize;
        $slider->text = $Request->text;
        $slider->textsize = $Request->textsize;
        $slider->button = $Request->button;
        $slider->link = $Request->link;
        $slider->colorbutton = $Request->colorbutton;
        
        if ($Request->hasFile('img')) {
            // xóa ảnh cũ
            if(File::exists('data/home/'.$slider->img)) {
                File::delete('data/home/'.$slider->img);
            }
            // xóa ảnh cũ
            // thêm ảnh mới
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/home/".$filename)){ $filename = str_random(4)."_".$filename; }
            $file->move('data/home', $filename);
            $slider->img = $filename;
            // thêm ảnh mới
        }
        $slider->save();
        return redirect('admin/slider/edit/'.$id)->with('Alerts','Thành công');
    }

    public function getdelete($id)
    {
        $slider = slider::find($id);
        // xóa ảnh
        if(File::exists('data/home/'.$slider->img)) {
            File::delete('data/home/'.$slider->img);
        }
        // xóa ảnh
        $slider->delete();
        return redirect('admin/slider/list')->with('Alerts','Thành công');
    }
}
