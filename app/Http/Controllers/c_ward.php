<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\ward;
use Image;
use File;

class c_ward extends Controller
{
    public function getlist()
    {
        $ward = ward::orderBy('id','desc')->paginate(50);
        $count = ward::orderBy('id','desc')->count();
    	return view('admin.ward.list',[
            'ward'=>$ward,
            'count'=>$count,
        ]);
    }
    public function loc(Request $Request)
    {
        $ward = ward::orderBy('id','desc')->where('id','!=' , 0);
        if($Request->name){
            $ward->where('name','like',"%$Request->name%");
        }
        $ward = $ward->paginate($Request->paginate);
        return view('admin.ward.list',[
            'ward'=>$ward,
            'key'=>$Request->name,
            'paginate'=>$Request->paginate,
        ]);
    }
    
}
