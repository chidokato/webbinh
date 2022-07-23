<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\seo;
use App\investor;
use Image;
use File;

class c_investor extends Controller
{
    public function getlist()
    {
        $investor = investor::orderBy('id','desc')->get();
        return view('admin.investor.list',[
            'investor'=>$investor,
        ]);
    }

    public function search(Request $Request)
    {
        $datefilter[] = '';
        $investor = investor::orderBy('view','asc')->where('id','!=' , 0);
        if($Request->key){
            $investor->where('name','like',"%$Request->key%");
        }
        if(isset($Request->datefilter)){
            $datefilter = explode(" - ", $Request->datefilter);
            $day1 = date('Y-m-d',strtotime($datefilter[0]));
            $day2 = date('Y-m-d',strtotime($datefilter[1]));
            // $investor->whereBetween('created_at', [$day1, $day2]);
            $investor->whereDate('created_at','>=', $day1)->whereDate('created_at','<=', $day2);
        }
        $investor = $investor->paginate($Request->paginate);

        return view('admin.investor.list',[
            'investor'=>$investor,
            'key'=>$Request->key,
            'datefilter'=>$Request->datefilter,
            'paginate'=>$Request->paginate,
        ]);
    }

    public function getadd()
    {
        return view('admin.investor.addedit');
    }

    public function postadd(Request $Request)
    {
        // seo
        $seo = new seo;
        $seo->title = $Request->title;
        $seo->description = $Request->description;
        $seo->keywords = $Request->keywords;
        $seo->robot = $Request->robot;
        $seo->save();

        $investor = new investor;
        $investor->user_id = Auth::User()->id;
        $investor->seo_id = $seo->id;
        $investor->name = $Request->name;
        $investor->detail = $Request->detail;
        $investor->sku = str_random(8);
        $investor->slug = changeTitle($Request->name);
        $investor->content = $Request->content;
        $investor->status = 'true';
        if ($Request->hasFile('img')) {
            $file = $Request->file('img'); $filename = $file->getClientOriginalName();
            while(file_exists("data/investor/".$filename)){$filename = str_random(4)."_".$filename;}
            $img = Image::make($file)->resize(120, 120, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/investor/thumbnail/'.$filename));
            $img = Image::make($file)->resize(1000, 1000, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/investor/'.$filename));
            $investor->img = $filename;
        }
        $investor->save();
        return redirect('admin/investor/list')->with('Success','Thành công');
    }

    public function getedit($id)
    {
        $data = investor::findOrFail($id);
        $seo = seo::findOrFail($data['seo_id']);
        return view('admin.investor.addedit',['data'=>$data, 'seo'=>$seo]);
    }

    public function double($id)
    {
        $data = investor::findOrFail($id);
        $investor = investor::where('sort_by',$data['sort_by'])->select('id','name','parent')->get();
        return view('admin.investor.double',['data'=>$data, 'investor'=>$investor]);
    }

    public function postedit(Request $Request,$id)
    {
        $investor = investor::find($id);
        $investor->name = $Request->name;
        $investor->user_id = Auth::User()->id;
        $investor->detail = $Request->detail;
        $investor->slug = changeTitle($Request->name);
        $investor->content = $Request->content;

        if ($Request->hasFile('img')) {
            // xóa ảnh cũ
            if(File::exists('data/investor/thumbnail/'.$investor->img)) { File::delete('data/investor/'.$investor->img); File::delete('data/investor/thumbnail/'.$investor->img); }
            // xóa xảnh cũ
            // thêm ảnh mới
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/investor/".$filename)){$filename = str_random(4)."_".$filename;}
            $img = Image::make($file)->resize(120, 120, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/investor/thumbnail/'.$filename));
            $img = Image::make($file)->resize(1000, 1000, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/investor/'.$filename));
            $investor->img = $filename;
            // thêm ảnh mới
        }
        $investor->save();

        $seo = seo::find($investor->seo_id);
        $seo->title = $Request->title;
        $seo->description = $Request->description;
        $seo->keywords = $Request->keywords;
        $seo->robot = $Request->robot;
        $seo->save();
        return redirect()->back()->with('Success','Thành công');
    }

    public function getdelete($id)
    {
        $investor = investor::find($id);
        if(File::exists('data/investor/'.$investor->img)) {
            File::delete('data/investor/'.$investor->img);
            File::delete('data/investor/thumbnail/'.$investor->img); }
        $seo = seo::find($investor->seo_id);
        $seo->delete();
        $investor->delete();
        return redirect('admin/investor/list')->with('Success','Success');
    }

    public function delete_all(Request $Request)
    {
        if (isset($Request->foo)) {
            foreach($Request->foo as $id){
                $investor = investor::find($id);
                if(File::exists('data/investor/'.$investor->img)) {
                    File::delete('data/investor/'.$investor->img);
                    File::delete('data/investor/thumbnail/'.$investor->img); }
                $seo = seo::find($investor->seo_id);
                $seo->delete();
                $investor->delete();
            }
            return redirect('admin/investor/list')->with('Success','Success');
        }
    }

    

}
