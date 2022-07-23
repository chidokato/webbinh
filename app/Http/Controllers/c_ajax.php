<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Request;
use File;
use App\User;
use App\category;
use App\menu;
use App\articles;
use App\mausac;
use App\product;
use App\section;
use App\quanlykho;
use App\images;
use App\customer;
use App\order;
use App\channel;
use App\themes;

use App\province;
use App\district;
use App\ward;
use App\street;
use App\messages;
use App\option;

class c_ajax extends Controller
{   
    // category
    public function sortby($id)
    {
        $data = category::where('sort_by',$id)->get();
        return view('admin.category.listparent',['data'=>$data]);
    }
    public function update_status_category($id)
    {
        if(Request::ajax()){
            $category = category::find($id);
            $category->status = Request::get('status_cat');
            $category->save();
        }
    }
    public function update_home_category($id)
    {
        if(Request::ajax()){
            $category = category::find($id);
            $category->home = Request::get('home');
            $category->save();
        }
    }
    public function update_status_menu($id)
    {
        if(Request::ajax()){
            $menu = menu::find($id);
            $menu->status = Request::get('status_menu');
            $menu->save();
        }
    }
    public function updateview($id)
    {
        if(Request::ajax()){
            $view = Request::get('view');
            $menu = menu::find($id);
            $menu->view = $view;
            $menu->save();
        }
    }
    // end category
    // nhập hàng
    public function mausac1($id, $a_id)
    {
        if(Request::ajax()){
            $quanlykho = quanlykho::where('articles_id',$a_id)->where('mausac_id',$id)->get();
            $data=array();
            foreach($quanlykho as $value ){$data[$value->form_id]= $value;}
            foreach ($data as $f) {echo "<option value='".$f->form->id."'>".$f->form->name."</option>";}
        }
    }
    // end nhập hàng

    // bán hàng
    public function articles($id)
    {
        if(Request::ajax()){
            $articles = articles::find($id);
            $product = product::find($articles->product_id);
            $mausac = mausac::get();
            foreach ($mausac as $key => $value) {
                echo "<option value=''>...</option>";
                if(in_array($value->id, explode(',',$product->mausac_id))){
                    echo "<option value='".$value->id."'>".$value->name."</option>";
                }
            }
        }
    }
    public function mausac($id, $a_id)
    {
        if(Request::ajax()){
            $quanlykho = quanlykho::where('articles_id',$a_id)->where('mausac_id',$id)->get();
            echo "<option value=''>Tất cả</option>";
            foreach ($quanlykho as $key => $value) {
                echo "<option value='".$value->size."'>".$value->size."</option>";
            }
        }
    }
    public function change_khang($kh_id)
    {
        if(Request::ajax()){
            $customer = customer::where('id',$kh_id)->first();
            echo "Tên KH: ".$customer->name."<br>";
            echo "Mã KH: ".$customer->code."<br>";
            echo "SĐT: ".$customer->phone."<br>";
            echo "Địa chỉ: ".$customer->address."<br>";
        }
    }
    public function change_order($od_id)
    {
        if(Request::ajax()){
            $order = order::where('id',$od_id)->first();
            $channel = channel::orderBy('id','asc')->get();
            if ($od_id == '0') {
                return view('admin.banhang.ajax_order',['channel'=>$channel]);
            }else{
            echo ' <div class="col-md-6 form-group">
                <label>Kênh bán hàng</label>
                <select disabled name="ch_id" class="form-control">
                    <option value="">'.$order->channel->name.'</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label>Ngày bán hàng</label>
                <input disabled name="date" type="date" value="'.$order->date.'" class="form-control" />
            </div> '; }
        }
    }
    // bán hàng

    // articles
    public function del_img_detail($id)
    {
        if(Request::ajax()){
            $images = images::find($id);
            if(File::exists('data/product/'.$images->img)) {
                File::delete('data/product/'.$images->img);
                File::delete('data/product/300/'.$images->img);
                File::delete('data/product/80/'.$images->img);
            }
            $images->delete();
        }
    }
    public function update_status_articles($id)
    {
        if(Request::ajax()){
            $articles = articles::find($id);
            $articles->status = Request::get('status_articles');
            $articles->save();
        }
    }
    // end articles
    
    // section
    public function del_section($id)
    {
        if(Request::ajax()){
            $section = section::find($id);
            $section->delete();
        }
    }
    // end section

    // themes
    public function update_status_themes($id)
    {
        if(Request::ajax()){
            $themes = themes::find($id);
            $themes->status = Request::get('status');
            $themes->save();
        }
    }
    // end themes

    // location
    public function update_status_province($id)
    {
        if(Request::ajax()){
            $province = province::find($id);
            $province->status = Request::get('status');
            $province->save();
        }
    }
    public function update_status_district($id)
    {
        if(Request::ajax()){
            $district = district::find($id);
            $district->status = Request::get('status');
            $district->save();
        }
    }
    public function change_province($id)
    {
        if(Request::ajax()){
            $district = district::where('province_id', $id)->get();
            echo "<option value=''>Tất cả</option>";
            foreach ($district as $key => $value) {
                echo "<option value='".$value->id."' >".$value->name."</option>";
            }
        }
    }
    public function change_district($id)
    {
        if(Request::ajax()){
            $ward = ward::where('district_id', $id)->get();
            echo "<option value=''>...</option>";
            foreach ($ward as $key => $value) {
                echo "<option value='".$value->id."' >".$value->name."</option>";
            }
        }
    }
    public function change_district_street($id)
    {
        if(Request::ajax()){
            $street = street::where('district_id', $id)->get();
            echo "<option value=''>...</option>";
            foreach ($street as $key => $value) {
                echo "<option value='".$value->id."' >".$value->name."</option>";
            }
        }
    }
    // end location

    // messages
    public function update_status_messages($id)
    {
        if(Request::ajax()){
            $messages = messages::find($id);
            $messages->status = 'acctive';
            $messages->save();
        }
    }
    public function del_messages($id)
    {
        if(Request::ajax()){
            $messages = messages::find($id);
            $messages->delete();
        }
    }
    // messages


    // option
    public function update_status_option($id)
    {
        if(Request::ajax()){
            $option = option::find($id);
            $option->status = Request::get('status_option');
            $option->save();
        }
    }
    public function dell_section($id)
    {
        if(Request::ajax()){
            $section = section::find($id);
            $section->delete();
        }
    }
    // option
}
?>
