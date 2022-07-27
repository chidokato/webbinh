<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Image;
use File;
use App\seo;
use App\product;
use App\section;
use App\mausac;
use App\form;
use App\size;
use App\articles;
use App\category;
use App\images;

use App\investor;
use App\province;
use App\district;
use App\ward;
use App\street;

class c_product extends Controller
{
    public function getlist()
    {
        $articles = articles::where('sort_by',1)->orderBy('id','desc')->get();
        $category = category::where('sort_by',1)->orderBy('id','desc')->get();
        return view('admin.product.list',[
            'product'=>$articles,
            'category'=>$category,
        ]);
    }

    public function search(Request $Request)
    {
        $datefilter[] = '';
        $articles = articles::where('sort_by',1)->orderBy('id','desc')->where('id','!=' , 0);
        if($Request->key){
            $articles->where('name','like',"%$Request->key%");
        }
        if($Request->category_id){
            $articles->where('category_id',$Request->category_id);
        }
        if(isset($Request->datefilter)){
            $datefilter = explode(" - ", $Request->datefilter);
            $day1 = date('Y-m-d',strtotime($datefilter[0]));
            $day2 = date('Y-m-d',strtotime($datefilter[1]));
            // $articles->whereBetween('created_at', [$day1, $day2]);
            $articles->whereDate('created_at','>=', $day1)->whereDate('created_at','<=', $day2);
        }
        $articles = $articles->paginate($Request->paginate);
        $category = category::where('sort_by',1)->orderBy('id','desc')->get();
        return view('admin.product.list',[
            'product'=>$articles,
            'key'=>$Request->key,
            'datefilter'=>$Request->datefilter,
            'paginate'=>$Request->paginate,
            'category'=>$category,
            'category_id'=>$Request->category_id,
        ]);
    }

    public function getadd()
    {
        $category = category::where('sort_by',1)->orderBy('id','desc')->get();
        $investor = investor::orderBy('id','desc')->get();
        $mausac = mausac::orderBy('id','desc')->get();
        $form = form::orderBy('id','desc')->get();
        $size = size::orderBy('id','desc')->get();
        
        $province = province::where('status','true')->orderBy('id','desc')->get();
        return view('admin.product.addedit',[
            'category'=>$category,
            'investor'=>$investor,
            'mausac'=>$mausac,
            'form'=>$form,
            'size'=>$size,
            'province'=>$province,
        ]);
    }

    public function postadd(Request $Request)
    {
        $cat_id=$Request->category_id;
        if (isset($Request->category_sku)) {
            $sku = implode(',', $Request->category_sku);
            if (count($Request->category_sku)==1) {
                $category = category::where('sku',$sku)->first();
                $cat_id = $category->id;
            }
        }
         // product
        $product = new product;
        $product->price = str_replace( array(',') , '', $Request->price );
        $product->oldprice = str_replace( array(',') , '', $Request->oldprice );
        $product->unit_price = $Request->unit;
        // $product->search_price = $product->price*$Request->unit;
        $product->saleoff = str_replace( array(',') , '', $Request->saleoff );
        $product->number = $Request->number;
        $product->investor_id = $Request->investor_id;
        if(isset($Request->province_id)){$product->province_id = $Request->province_id;}
        if(isset($Request->district_id)){$product->district_id = $Request->district_id;}
        if($Request->ward_id)$product->ward_id = $Request->ward_id;
        if($Request->street_id)$product->street_id = $Request->street_id;
        if(isset($Request->mausac)){$product->mausac_id = implode(',', $Request->mausac);}
        $product->save();
        // seo
        $seo = new seo;
        $seo->title = $Request->title;
        $seo->description = $Request->description;
        $seo->keywords = $Request->keywords;
        $seo->robot = $Request->robot;
        $seo->save();
        // articles
        $articles = new articles;
        $articles->user_id = Auth::User()->id;
        
        if(isset($Request->category_sku)){$articles->category_sku = implode(',', $Request->category_sku);}
        $articles->category_id = $cat_id;

        $articles->seo_id = $seo->id;
        $articles->product_id = $product->id;
        $articles->sort_by = '1';
        $articles->sku = str_random(8);
        $articles->name = $Request->name;
        $articles->slug = changeTitle($Request->name);
        $articles->detail = $Request->detail;
        $articles->content = $Request->content;
        $articles->hits = '50';
        $articles->status = 'true';
        // thêm ảnh
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/product/300/".$filename)){ $filename = str_random(4)."_".$filename; }
            $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
            $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
            $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
            $articles->img = $filename;
        }
        $articles->save();

        // images
        if($Request->hasFile('imgdetail')){
            foreach ($Request->file('imgdetail') as $file) {
                $images = new images();
                if(isset($file)){
                    $images->articles_id = $articles->id;
                    $filename = $file->getClientOriginalName();
                    while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                    $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                    $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                    $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                    $images->img = $filename;
                    $images->save();
                }
            }
        }

        if ($Request->name_section) {
            foreach($Request->name_section as $val){
                $section = new section;
                $section->articles_id = $articles->id;
                $section->tab_heading = $val;
                $section->slug = changeTitle($val);
                $section->save();
            }
        }

        return redirect('admin/product/list')->with('Alerts','Thành công');
    }

    public function double($id)
    {
        $data = articles::findOrFail($id);
        $seo = seo::findOrFail($data['seo_id']);
        $category = category::where('sort_by',1)->orderBy('id','desc')->get();
        $mausac = mausac::orderBy('id','desc')->get();
        $form = form::orderBy('id','desc')->get();
        $size = size::orderBy('id','desc')->get();
        $double = 'double';
        $investor = investor::orderBy('id','desc')->get();
        return view('admin.product.addedit',[
            'data'=>$data,
            'category'=>$category,
            'seo'=>$seo,
            'mausac'=>$mausac,
            'form'=>$form,
            'size'=>$size,
            'double'=>$double,
            'investor'=>$investor,
        ]);
    }
    public function getedit($id)
    {
        $data = articles::findOrFail($id);
        $seo = seo::findOrFail($data['seo_id']);
        $category = category::where('sort_by',1)->orderBy('id','desc')->get();
        $mausac = mausac::orderBy('id','desc')->get();
        $form = form::orderBy('id','desc')->get();
        $size = size::orderBy('id','desc')->get();

        $investor = investor::orderBy('id','desc')->get();
        $province = province::where('status','true')->orderBy('id','desc')->get();
        $district = district::where('province_id',$data->product->province_id)->where('status','true')->orderBy('id','desc')->get();
        $ward = ward::where('district_id',$data->product->district_id)->orderBy('id','desc')->get();
        $street = street::where('district_id',$data->product->district_id)->orderBy('id','desc')->get();
        return view('admin.product.addedit',[
            'data'=>$data,
            'category'=>$category,
            'seo'=>$seo,
            'mausac'=>$mausac,
            'form'=>$form,
            'size'=>$size,

            'investor'=>$investor,
            'province'=>$province,
            'district'=>$district,
            'ward'=>$ward,
            'street'=>$street,
        ]);
    }

    public function postedit(Request $Request,$id)
    {
        $this->validate($Request,['name' => 'Required'],[] );     
        $articles = articles::find($id);
        $articles->name = $Request->name;
        $articles->slug = $Request->slug;
        $articles->detail = $Request->detail;
        $articles->content = $Request->content;
        $articles->category_id = $Request->category_id;
        if(isset($Request->category_sku)){$articles->category_sku = implode(',', $Request->category_sku);}
        else{$articles->category_sku='';}
        if ($Request->hasFile('img')) {
            // xóa ảnh cũ
            if(File::exists('data/product/'.$articles->img)) { 
                File::delete('data/product/'.$articles->img); 
                File::delete('data/product/300/'.$articles->img); 
                File::delete('data/product/80/'.$articles->img); 
            }
            // xóa ảnh cũ
            // thêm ảnh mới
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/product/300/".$filename)){ $filename = str_random(4)."_".$filename; }
            $img = Image::make($file)->resize(1000, 800, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
            $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
            $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
            $articles->img = $filename;
            // thêm ảnh mới
        }
        $articles->save();

        // seo
        $seo = seo::find($articles['seo_id']);
        $seo->title = $Request->title;
        $seo->description = $Request->description;
        $seo->keywords = $Request->keywords;
        $seo->robot = $Request->robot;
        $seo->save();

        // product
        $product = product::find($articles['product_id']);
        $product->price = str_replace( array(',') , '', $Request->price );
        $product->oldprice = str_replace( array(',') , '', $Request->oldprice );
        $product->unit_price = $Request->unit;
        $product->investor_id = $Request->investor_id;
        if($product->price!=''){$product->search_price = $product->price*$Request->unit;}
        $product->saleoff = str_replace( array(',') , '', $Request->saleoff );
        $product->number = $Request->number;
        if($Request->province_id){$product->province_id = $Request->province_id;}
        if($Request->district_id)$product->district_id = $Request->district_id;
        if($Request->ward_id)$product->ward_id = $Request->ward_id;
        if($Request->street_id)$product->street_id = $Request->street_id;
        if($Request->address)$product->address = $Request->address;
        if(isset($Request->mausac)){$product->mausac_id = implode(',', $Request->mausac);}else{$product->mausac_id='';}
        $product->save();

        // thêm ảnh chi tiết
        if($Request->hasFile('imgdetail')){
            foreach ($Request->file('imgdetail') as $file) {
                $images = new images();
                if(isset($file)){
                    $images->articles_id = $articles->id;
                    $filename = $file->getClientOriginalName();
                    while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                    $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                    $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                    $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                    $images->img = $filename;
                    $images->save();
                }
            }
        }
        // return redirect('admin/product/list')->with('Success','Thành công');

        
        if ($Request->name_section) {
            foreach($Request->name_section as $val){
                if ($val != '') {
                    $section = new section;
                    $section->articles_id = $articles->id;
                    $section->tab_heading = $val;
                    $section->slug = changeTitle($val);
                    $section->save();
                }
            }
        }

        
        if ($Request->id_section) {
            foreach($Request->id_section as $key => $id_section){
                $section = section::find($id_section);
                $section->tab_heading = $Request->tab_heading[$key];
                $section->slug = changeTitle($Request->tab_heading[$key]);
                $section->heading = $Request->heading[$key];
                $section->content = $Request->content_section[$key];
                $section->note = $Request->note_section[$key];
                $section->save();

                if($key==0 && $Request->hasFile('img_section0')) {
                    foreach($Request->file('img_section0') as $file){
                        $images = new images();
                        $images->section_id = $id_section;
                        $filename = $file->getClientOriginalName();
                        while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                        $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                        $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                        $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                        $images->img = $filename;
                        $images->save();
                    }
                }
                if($key==1 && $Request->hasFile('img_section1')) {
                    foreach($Request->file('img_section1') as $file){
                        $images = new images();
                        $images->section_id = $id_section;
                        $filename = $file->getClientOriginalName();
                        while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                        $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                        $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                        $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                        $images->img = $filename;
                        $images->save();
                    }
                }
                if($key==2 && $Request->hasFile('img_section2')) {
                    foreach($Request->file('img_section2') as $file){
                        $images = new images();
                        $images->section_id = $id_section;
                        $filename = $file->getClientOriginalName();
                        while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                        $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                        $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                        $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                        $images->img = $filename;
                        $images->save();
                    }
                }
                if($key==3 && $Request->hasFile('img_section3')) {
                    foreach($Request->file('img_section3') as $file){
                        $images = new images();
                        $images->section_id = $id_section;
                        $filename = $file->getClientOriginalName();
                        while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                        $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                        $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                        $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                        $images->img = $filename;
                        $images->save();
                    }
                }
                if($key==4 && $Request->hasFile('img_section4')) {
                    foreach($Request->file('img_section4') as $file){
                        $images = new images();
                        $images->section_id = $id_section;
                        $filename = $file->getClientOriginalName();
                        while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                        $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                        $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                        $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                        $images->img = $filename;
                        $images->save();
                    }
                }
                if($key==5 && $Request->hasFile('img_section5')) {
                    foreach($Request->file('img_section5') as $file){
                        $images = new images();
                        $images->section_id = $id_section;
                        $filename = $file->getClientOriginalName();
                        while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                        $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                        $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                        $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                        $images->img = $filename;
                        $images->save();
                    }
                }
                if($key==6 && $Request->hasFile('img_section6')) {
                    foreach($Request->file('img_section6') as $file){
                        $images = new images();
                        $images->section_id = $id_section;
                        $filename = $file->getClientOriginalName();
                        while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                        $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                        $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                        $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                        $images->img = $filename;
                        $images->save();
                    }
                }
                if($key==7 && $Request->hasFile('img_section7')) {
                    foreach($Request->file('img_section7') as $file){
                        $images = new images();
                        $images->section_id = $id_section;
                        $filename = $file->getClientOriginalName();
                        while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                        $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                        $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                        $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                        $images->img = $filename;
                        $images->save();
                    }
                }
                if($key==8 && $Request->hasFile('img_section8')) {
                    foreach($Request->file('img_section8') as $file){
                        $images = new images();
                        $images->section_id = $id_section;
                        $filename = $file->getClientOriginalName();
                        while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                        $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                        $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                        $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                        $images->img = $filename;
                        $images->save();
                    }
                }
                if($key==9 && $Request->hasFile('img_section9')) {
                    foreach($Request->file('img_section9') as $file){
                        $images = new images();
                        $images->section_id = $id_section;
                        $filename = $file->getClientOriginalName();
                        while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                        $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                        $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                        $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                        $images->img = $filename;
                        $images->save();
                    }
                }
                if($key==10 && $Request->hasFile('img_section10')) {
                    foreach($Request->file('img_section10') as $file){
                        $images = new images();
                        $images->section_id = $id_section;
                        $filename = $file->getClientOriginalName();
                        while(file_exists("data/product/".$filename)){ $filename = str_random(4)."_".$filename; }
                        $img = Image::make($file)->resize(1000, 600, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/'.$filename));
                        $img = Image::make($file)->resize(300, 300, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/300/'.$filename));
                        $img = Image::make($file)->resize(80, 80, function ($constraint) {$constraint->aspectRatio();})->save(public_path('data/product/80/'.$filename));
                        $images->img = $filename;
                        $images->save();
                    }
                }
            }
        }

        return redirect()->back()->with('Success','Thành công');
    }

    public function getdelete($id)
    {
        $articles = articles::find($id);
        // del seo
        $seo = seo::find($articles->seo_id);
        $seo->delete();
        // del product
        $product = product::find($articles->product_id);
        $product->delete();
        // xóa ảnh
        if(File::exists('data/product/'.$articles->img)) {
            File::delete('data/product/'.$articles->img);
            File::delete('data/product/300/'.$articles->img);
            File::delete('data/product/80/'.$articles->img);
        }
        // del images
        if (isset($articles->images)) {
            foreach ($articles->images as $key => $value) {
                $images = images::find($value->id);
                if(File::exists('data/images/'.$images->img)) {
                    File::delete('data/images/'.$images->img);
                    File::delete('data/images/100/'.$images->img);
                }
                $images->delete();
            }
        }

        $articles->delete();
        return redirect('admin/product/list')->with('Alerts','Thành công');
    }
    public function delete_all(Request $Request)
    {
        if (isset($Request->foo)) {
            foreach($Request->foo as $id){
                $articles = articles::find($id);
                // del seo
                $seo = seo::find($articles->seo_id);
                $seo->delete();
                // del product
                $product = product::find($articles->product_id);
                $product->delete();
                // xóa ảnh
                if(File::exists('data/product/'.$articles->img)) {
                    File::delete('data/product/'.$articles->img);
                    File::delete('data/product/300/'.$articles->img);
                    File::delete('data/product/80/'.$articles->img);
                }
                // del images
                if (isset($articles->images)) {
                    foreach ($articles->images as $key => $value) {
                        $images = images::find($value->id);
                        if(File::exists('data/images/'.$images->img)) {
                            File::delete('data/images/'.$images->img);
                            File::delete('data/images/300/'.$images->img);
                            File::delete('data/images/80/'.$images->img);
                        }
                        $images->delete();
                    }
                }

                $articles->delete();
            }
        }
        return redirect('admin/product/list')->with('Success','Success');
    }


    // section
    public function add_section(Request $Request)
    {
        $section = new section;
        $section->articles_id = $Request->articles_id;
        $section->number = $Request->number;
        $section->tab_heading = $Request->tab_section;
        $section->heading = $Request->heading;
        $section->content = $Request->content;
        $section->save();

        $section_list = section::where('articles_id', $Request->articles_id)->orderBy('number','asc')->get();
        return view('admin.product.section', [
            'section_list'=>$section_list,
        ]);
    }
}
