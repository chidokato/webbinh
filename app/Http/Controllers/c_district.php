<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\province;
use App\district;
use Image;
use File;

class c_district extends Controller
{
    public function getlist()
    {
        $district = district::orderBy('id','asc')->paginate(50);
        $province = province::orderBy('id','asc')->get();
        $count = district::orderBy('id','desc')->count();

    	return view('admin.district.list',[
            'district'=>$district,
            'province'=>$province,
            'count'=>$count,
        ]);
    }
    public function loc(Request $Request)
    {
    	
        $district = district::orderBy('id','desc')->where('id','!=' , 0);
        if($Request->key){
            $district->where('name','like',"%$Request->key%");
        }
        if($Request->province_id){
            $district->where('province_id',$Request->province_id);
        }
        $district = $district->paginate($Request->paginate);
        $province = province::orderBy('id','asc')->get();
        $count = count($district);
        return view('admin.district.list',[
            'district'=>$district,
            'key'=>$Request->key,
            'paginate'=>$Request->paginate,
            'province'=>$province,
            'province_id'=>$Request->province_id,
            'count'=>$count,
        ]);
    }

    
}
