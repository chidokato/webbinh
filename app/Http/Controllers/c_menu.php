<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\seo;
use App\menu;
use Image;
use File;

class c_menu extends Controller
{
    public function getlist()
    {
        $menu = menu::orderBy('view','asc')->get();
        return view('admin.menu.list',[
            'menu'=>$menu,
        ]);
    }

    public function search(Request $Request)
    {
        $datefilter[] = '';
        $menu = menu::orderBy('view','asc')->where('id','!=' , 0);
        if($Request->key){
            $menu->where('name','like',"%$Request->key%");
        }
        if(isset($Request->datefilter)){
            $datefilter = explode(" - ", $Request->datefilter);
            $day1 = date('Y-m-d',strtotime($datefilter[0]));
            $day2 = date('Y-m-d',strtotime($datefilter[1]));
            // $menu->whereBetween('created_at', [$day1, $day2]);
            $menu->whereDate('created_at','>=', $day1)->whereDate('created_at','<=', $day2);
        }
        $menu = $menu->paginate($Request->paginate);

        return view('admin.menu.list',[
            'menu'=>$menu,
            'key'=>$Request->key,
            'datefilter'=>$Request->datefilter,
            'paginate'=>$Request->paginate,
        ]);
    }

    public function getadd()
    {
        $menu = menu::select('id','name','parent')->get();
        return view('admin.menu.addedit',['menu'=>$menu]);
    }

    public function postadd(Request $Request)
    {
        $menu = new menu;
        $menu->user_id = Auth::User()->id;
        $menu->name = $Request->name;
        $menu->sku = str_random(8);
        $menu->slug = changeTitle($Request->name);
        $menu->content = $Request->content;
        $menu->sort_by = $Request->sort_by;
        $menu->parent = $Request->parent;
        $menu->classify = $Request->classify;
        $menu->icon = $Request->icon;
        $menu->status = 'true';
        $menu->view = $Request->view;
        if ($Request->hasFile('img')) {
            $file = $Request->file('img'); $filename = $file->getClientOriginalName();
            while(file_exists("data/menu/".$filename)){$filename = str_random(4)."_".$filename;}
            $img = Image::make($file)->resize(120, 120, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/menu/thumbnail/'.$filename));
            $img = Image::make($file)->resize(1000, 1000, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/menu/'.$filename));
            $menu->img = $filename;
        }
        $menu->save();
        return redirect('admin/menu/list')->with('Success','Thành công');
    }

    public function getedit($id)
    {
        $data = menu::findOrFail($id);
        $menu = menu::select('id','name','parent')->get();
        return view('admin.menu.addedit',['data'=>$data, 'menu'=>$menu]);
    }

    public function double($id)
    {
        $data = menu::findOrFail($id);
        $menu = menu::select('id','name','parent')->get();
        return view('admin.menu.double',['data'=>$data, 'menu'=>$menu]);
    }

    public function postedit(Request $Request,$id)
    {
        $menu = menu::find($id);
        $menu->name = $Request->name;
        $menu->slug = $Request->slug;
        $menu->content = $Request->content;
        $menu->icon = $Request->icon;
        $menu->view = $Request->view;
        $menu->classify = $Request->classify;
        if($id == $Request->parent){
            return redirect('admin/menu/edit/'.$id)->with('Errors','Errors parent');
        }
        else{
            $menu->parent = $Request->parent;
        }
        if ($Request->hasFile('img')) {
            // xóa ảnh cũ
            if(File::exists('data/menu/thumbnail/'.$menu->img)) { File::delete('data/menu/'.$menu->img); File::delete('data/menu/thumbnail/'.$menu->img); }
            // xóa xảnh cũ
            // thêm ảnh mới
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/menu/".$filename)){$filename = str_random(4)."_".$filename;}
            $img = Image::make($file)->resize(120, 120, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/menu/thumbnail/'.$filename));
            $img = Image::make($file)->resize(1000, 1000, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/menu/'.$filename));
            $menu->img = $filename;
            // thêm ảnh mới
        }
        $menu->save();
       
        return redirect('admin/menu/list')->with('Success','Thành công');
    }

    public function getdelete($id)
    {
        $count_cat = menu::where('parent',$id)->count();
        if($count_cat > 0){
            return redirect('admin/menu/list')->with('Error','Error parent');
        }else{
            $menu = menu::find($id);
            if(File::exists('data/menu/'.$menu->img)) {
                File::delete('data/menu/'.$menu->img);
                File::delete('data/menu/thumbnail/'.$menu->img); }
            $menu->delete();
            return redirect('admin/menu/list')->with('Success','Success');
        }
    }

    public function delete_all(Request $Request)
    {
        if (isset($Request->foo)) {
            foreach($Request->foo as $id){
                $count_cat = menu::where('parent',$id)->count();
                if($count_cat > 0){
                    return redirect('admin/menu/list')->with('Error','Error parent');
                }else{
                    $menu = menu::find($id);
                    if(File::exists('data/menu/'.$menu->img)) {
                        File::delete('data/menu/'.$menu->img);
                        File::delete('data/menu/thumbnail/'.$menu->img); }
                    $menu->delete();
                }
            }
            return redirect('admin/menu/list')->with('Success','Success');
        }
    }

    

}
