<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\street;
use Image;
use File;

class c_street extends Controller
{
    public function getlist()
    {
        $street = street::orderBy('id','desc')->paginate(50);
        $count = street::orderBy('id','desc')->count();
    	return view('admin.street.list',[
            'street'=>$street,
            'count'=>$count,
        ]);
    }
    public function loc(Request $Request)
    {
    	$count = street::orderBy('id','desc')->count();
        $street = street::orderBy('id','desc')->where('id','!=' , 0);
        if($Request->name){
            $street->where('name','like',"%$Request->name%");
        }
        $street = $street->paginate($Request->paginate);
        return view('admin.street.list',[
            'street'=>$street,
            'count'=>$count,
            'key'=>$Request->name,
            'paginate'=>$Request->paginate,
        ]);
    }
    
}
