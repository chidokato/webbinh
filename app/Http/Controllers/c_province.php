<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\province;
use Image;
use File;

class c_province extends Controller
{
    public function getlist()
    {
        $province = province::orderBy('status','desc')->paginate(50);
        $count = province::orderBy('id','desc')->count();
    	return view('admin.province.list',[
            'province'=>$province,
            'count'=>$count,
        ]);
    }

    public function search(Request $Request)
    {

        $province = province::orderBy('status','desc')->where('id','!=' , 0);
        if($Request->key){
            $province->where('name','like',"%$Request->key%");
        }
        if($Request->ngay1 && $Request->ngay2){
            $product->whereBetween('ngayketthuc', array($Request->ngay1, $Request->ngay2));
        }
        $province = $province->paginate($Request->paginate);
        $count = count($province);
        return view('admin.province.list',[
            'province'=>$province,
            'key'=>$Request->name,
            'paginate'=>$Request->paginate,
            'count'=>$count,
        ]);
    }

    
}
