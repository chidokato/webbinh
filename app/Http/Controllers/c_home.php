<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Image;
use File;
use App\seo;
use App\home;
use App\category;
use App\images;
use App\option;
use App\section;

class c_home extends Controller
{
    public function getlist()
    {
        $home = home::orderBy('view','asc')->get();
        return view('admin.home.list',[
            'home'=>$home,
        ]);
    }

    public function search(Request $Request)
    {
        $datefilter[] = '';
        $articles = articles::where('user_id',Auth::User()->id)->where('sort_by',2)->orderBy('id','desc')->where('id','!=' , 0);
        if($Request->key){
            $articles->where('name','like',"%$Request->key%");
        }
        if($Request->category_id){
            $articles->where('category_id',$Request->category_id);
        }
        if($Request->duan){
            $articles->where('option_id','like',"%$Request->duan%");
        }
        if($Request->theloai){
            $articles->where('option_id','like',"%$Request->theloai%");
        }
        if(isset($Request->datefilter)){
            $datefilter = explode(" - ", $Request->datefilter);
            $day1 = date('Y-m-d',strtotime($datefilter[0]));
            $day2 = date('Y-m-d',strtotime($datefilter[1]));
            // $articles->whereBetween('created_at', [$day1, $day2]);
            $articles->whereDate('created_at','>=', $day1)->whereDate('created_at','<=', $day2);
        }
        $articles = $articles->paginate($Request->paginate);
        $category = category::orderBy('id','desc')->get();
        $option = option::orderBy('id','desc')->get();
        return view('admin.home.list',[
            'home'=>$articles,
            'category'=>$category,
            'option'=>$option,

            'key'=>$Request->key,
            'category_id'=>$Request->category_id,
            'datefilter'=>$Request->datefilter,
            'paginate'=>$Request->paginate,
            'duan'=>$Request->duan,
            'theloai'=>$Request->theloai,

        ]);
    }

    public function getadd()
    {
        $category = category::orderBy('id','desc')->get();
        return view('admin.home.addedit',[
            'category'=>$category,
        ]);
    }

    public function postadd(Request $Request)
    {
        $home = new home;
        $home->name = $Request->name;
        $home->links = $Request->links;
        $home->view = $Request->view;
        $home->detail = $Request->detail;
        $home->content = $Request->content;
        $home->status = 'true';
        // thêm ảnh
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/home/300/".$filename)){ $filename = str_random(4)."_".$filename; }
            $img = Image::make($file)->resize(2000, 800, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/home/'.$filename));
            $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/home/300/'.$filename));
            $home->img = $filename;
        }
        // thêm ảnh

        $home->save();

        if ($Request->name_section) {
            foreach($Request->name_section as $val){
                $section = new section;
                $section->home_id = $home->id;
                $section->name = $val;
                if ($Request->hasFile('img_section')) {
                    $file = $Request->file('img_section')[$key];
                    $filename = $file->getClientOriginalName();
                    while(file_exists("data/home/300/".$filename)){ $filename = str_random(4)."_".$filename; }
                    $img = Image::make($file)->resize(2000, 800, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/home/'.$filename));
                    $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/home/300/'.$filename));
                    $section->img = $filename;
                }
                $section->save();
            }
        }

        return redirect('admin/home/list')->with('Alerts','Thành công');
    }

    public function getedit($id)
    {
        $data = home::findOrFail($id);
        $option = option::orderBy('id','desc')->get();
        return view('admin.home.addedit',[
            'data'=>$data,
            'option'=>$option,
        ]);
    }

    public function postedit(Request $Request,$id)
    {
        $home = home::find($id);
        $home->name = $Request->name;
        $home->links = $Request->links;
        $home->view = $Request->view;
        $home->detail = $Request->detail;
        $home->content = $Request->content;

        if ($Request->hasFile('img')) {
            // xóa ảnh cũ
            if(File::exists('data/home/'.$home->img)) { 
                File::delete('data/home/'.$home->img); 
                File::delete('data/home/300/'.$home->img); 
                File::delete('data/home/80/'.$home->img); 
            }
            // xóa ảnh cũ
            // thêm ảnh mới
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/home/300/".$filename)){ $filename = str_random(4)."_".$filename; }
            $img = Image::make($file)->resize(2000, 800, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/home/'.$filename));
            $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/home/300/'.$filename));
            $home->img = $filename;
            // thêm ảnh mới
        }
        $home->save();
        
        if ($Request->name_section) {
            foreach($Request->name_section as $key => $val){
                $section = new section;
                $section->home_id = $home->id;
                $section->name = $val;
                if ($Request->hasFile('img_section')) {
                    $file = $Request->file('img_section')[$key];
                    $filename = $file->getClientOriginalName();
                    while(file_exists("data/home/300/".$filename)){ $filename = str_random(4)."_".$filename; }
                    $img = Image::make($file)->resize(2000, 800, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/home/'.$filename));
                    $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/home/300/'.$filename));
                    $section->img = $filename;
                }
                $section->save();
            }
        }

        if ($Request->section_id) {
            foreach($Request->section_id as $key => $sec_id){
                $section = section::find($sec_id);
                $section->name = $Request->name_edit_section[$key];
                $section->link = $Request->link_edit_section[$key];
                $section->content = $Request->content_edit_section[$key];
                if (isset($Request->img_edit_section[$key])) {
                    if ($Request->hasFile('img_edit_section')) {
                        if(File::exists('data/home/'.$home->img)) { 
                            File::delete('data/home/'.$home->img); 
                            File::delete('data/home/300/'.$home->img); 
                        }
                        $file = $Request->file('img_edit_section')[$key];
                        $filename = $file->getClientOriginalName();
                        while(file_exists("data/home/300/".$filename)){ $filename = str_random(4)."_".$filename; }
                        $img = Image::make($file)->resize(2000, 800, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/home/'.$filename));
                        $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/home/300/'.$filename));
                        $section->img = $filename;
                    }
                }
                
                $section->save();
            }
        }

        return redirect('admin/home/edit/'.$id)->with('Alerts','Thành công');
    }

    public function getdelete($id)
    {
        $home = home::find($id);
        
        // xóa ảnh
        if(File::exists('data/home/'.$home->img)) {
            File::delete('data/home/'.$home->img);
            File::delete('data/home/300/'.$home->img);
        }
        // xóa ảnh
        $home->delete();
        return redirect('admin/home/list')->with('Alerts','Thành công');
    }

    public function delete_all(Request $Request)
    {
        if (isset($Request->foo)) {
            foreach($Request->foo as $id){
                $articles = articles::find($id);
                $seo = seo::find($articles->seo_id);
                $seo->delete();
                // xóa ảnh
                if(File::exists('data/home/'.$articles->img)) {
                    File::delete('data/home/'.$articles->img);
                    File::delete('data/home/300/'.$articles->img);
                    File::delete('data/home/80/'.$articles->img);
                }
                // xóa ảnh
                $articles->delete();
            }
        }
        return redirect('admin/home/list')->with('Success','Success');
    }


    public function addflast(Request $Request)
    {
        include 'admin_asset/simplehtml/simple_html_dom.php';
        $html = file_get_html($Request->link);
        
        $thuoctinh =  $html->find('.entry-body',0)->find('.boxtip');
        foreach ($thuoctinh as $key => $value) {
            $value->outertext=''; // xóa class boxtip bên trong class entry-body
        }
        $thuoctinh =  $html->find('.entry-body',0)->find('.banner');
        foreach ($thuoctinh as $key => $value) {
            $value->outertext=''; // xóa
        }
        $thuoctinh =  $html->find('.entry-body',0)->find('.shareImage');
        foreach ($thuoctinh as $key => $value) {
            $value->outertext=''; // xóa
        }
        $thuoctinh =  $html->find('.entry-body',0)->find('.alignRight');
        foreach ($thuoctinh as $key => $value) {
            $value->outertext=''; // xóa
        }
        $thuoctinh =  $html->find('.entry-body',0)->find('.type-7_preview');
        foreach ($thuoctinh as $key => $value) {
            $value->outertext=''; // xóa
        }


        function get_firstimage( $contents ){
            if( preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $contents, $img) ){
                return $img[1];
            }else{
                return '';
            }
        } // ảnh trong bài viết

        // echo $name = $html->find('.dt-title',0)->plaintext."<br>"; // tiêu đề
        // echo '<img style="width: 200px;" src="'.get_firstimage($html->find('img',6)).'">'."<br>";  // ảnh đại diện
        // echo $content = $html->find('.entry-body',0); // content

        
        // $this->validate($Request,['name' => 'Required'],[] );
        // seo
        $seo = new seo;
        $seo->title = $html->find('.dt-title',0)->plaintext;
        $seo->description = $html->find('.dt-title',0)->plaintext;
        // $seo->keywords = $Request->keywords;
        // $seo->robot = $Request->robot;
        $seo->save();

        $articles = new articles;
        $articles->user_id = Auth::User()->id;
        $articles->category_id = $Request->cat_id;
        $articles->seo_id = $seo->id;
        $articles->sort_by = '2';
        $articles->sku = str_random(8);
        $articles->name = $html->find('.dt-title',0)->plaintext;
        $articles->slug = changeTitle($html->find('.dt-title',0)->plaintext);
        $articles->detail = $html->find('.dt-title',0)->plaintext;
        $articles->content = $html->find('.entry-body',0);
        $articles->hits = '50';
        $articles->status = 'true';
        $articles->img2 = get_firstimage($html->find('img',6));
        
        $articles->save();
        
        return redirect('admin/home/list')->with('Alerts','Thành công');
    }
}
