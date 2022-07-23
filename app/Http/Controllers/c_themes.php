<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Image;
use File;
use App\themes;

class c_themes extends Controller
{
    public function getlist()
    {
        $themes = themes::orderBy('id','desc')->get();
        return view('admin.themes.list',[
            'themes'=>$themes
        ]);
    }

    public function search(Request $Request)
    {
        $datefilter[] = '';
        $themes = themes::orderBy('id','desc')->where('id','!=' , 0);
        if($Request->key){
            $themes->where('name','like',"%$Request->key%");
        }
        if(isset($Request->datefilter)){
            $datefilter = explode(" - ", $Request->datefilter);
            $day1 = date('Y-m-d',strtotime($datefilter[0]));
            $day2 = date('Y-m-d',strtotime($datefilter[1]));
            // $themes->whereBetween('created_at', [$day1, $day2]);
            $themes->whereDate('created_at','>=', $day1)->whereDate('created_at','<=', $day2);
        }
        $themes = $themes->paginate($Request->paginate);

        return view('admin.themes.list',[
            'themes'=>$themes,
            'key'=>$Request->key,
            'datefilter'=>$Request->datefilter,
            'paginate'=>$Request->paginate,
        ]);
    }

    public function getadd()
    {
        return view('admin.themes.addedit',[
        ]);
    }

    public function postadd(Request $Request)
    {
        if ($Request->note == 'logo' || $Request->note == 'logo ân bản') {
            $this->validate($Request,[
                'note' => 'unique:themes,note',
            ],[
                'note.unique'=>'Logo phải là duy nhất',
            ] );
        }
        $themes = new themes;
        $themes->user_id = Auth::User()->id;
        $themes->name = $Request->name;
        $themes->title = $Request->title;
        $themes->note = $Request->note;
        $themes->link = $Request->link;
        $themes->button = $Request->button;
        $themes->content = $Request->content;
        $themes->status = 'true';
        // thêm ảnh
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/themes/".$filename)){$filename = str_random(4)."_".$filename;}
            $file->move('data/themes', $filename);
            $themes->img = $filename;
        }
        // thêm ảnh
        $themes->save();
        return redirect('admin/themes/list')->with('Alerts','Thành công');
    }

    public function double($id)
    {
        $data = themes::findOrFail($id);
        $double = 'double';
        return view('admin.themes.addedit',[
            'data'=>$data,
            'double'=>$double,
        ]);
    }
    public function getedit($id)
    {
        $data = themes::findOrFail($id);
        return view('admin.themes.addedit',[
            'data'=>$data,
        ]);
    }

    public function postedit(Request $Request,$id)
    {
        // if ($Request->note == 'logo' || $Request->note == 'logo ân bản') {
        //     $this->validate($Request,[
        //         'note' => 'unique:themes,note',
        //     ],[
        //         'note.unique'=>'Logo phải là duy nhất',
        //     ] );
        // }
        $themes = themes::find($id);
        $themes->name = $Request->name;
        $themes->title = $Request->tit;
        $themes->note = $Request->note;
        $themes->link = $Request->link;
        $themes->content = $Request->content;
        $themes->status = 'true';

        if ($Request->hasFile('img')) {
            // xóa ảnh cũ
            if(File::exists('data/themes/'.$themes->img)) { 
                File::delete('data/themes/'.$themes->img); 
            }
            // xóa ảnh cũ
            // thêm ảnh mới
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/themes/".$filename)){$filename = str_random(4)."_".$filename;}
            $file->move('data/themes', $filename);
            $themes->img = $filename;
            // thêm ảnh mới
        }
        $themes->save();
        return redirect('admin/themes/edit/'.$id)->with('Alerts','Thành công');
    }

    public function getdelete($id)
    {
        $themes = themes::find($id);
        // xóa ảnh
        if(File::exists('data/themes/'.$themes->img)) {
            File::delete('data/themes/'.$themes->img);
        }
        // xóa ảnh
        $themes->delete();
        return redirect('admin/themes/list')->with('Alerts','Thành công');
    }

    public function delete_all(Request $Request)
    {
        if (isset($Request->foo)) {
            foreach($Request->foo as $id){
                $themes = themes::find($id);
                // xóa ảnh
                if(File::exists('data/themes/'.$themes->img)) {
                    File::delete('data/themes/'.$themes->img);
                }
                // del images
                $themes->delete();
            }
        }
        return redirect('admin/themes/list')->with('Success','Success');
    }
}
