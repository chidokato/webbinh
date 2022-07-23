<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\articles;
use App\option;
use App\category;


class c_dashboard extends Controller
{
	public function dashboard()
    {
        $category = category::where('status','true')->orderBy('id','asc')->get();
        $articles = articles::where('status','true')->orderBy('id','desc')->get();
    	$option = option::where('status','true')->orderBy('id','asc')->get();
    	return view('admin.dashboard',[
            'category'=>$category,
            'articles'=>$articles,
    		'option'=>$option,
        ]);
    }


    public function search(Request $Request)
    {
        $category = category::where('status','true')->orderBy('id','asc')->get();
        $option = option::where('status','true')->orderBy('id','asc')->get();

        $duan_array = [];
        if($Request->duan){
            foreach($Request->duan as $val){
                $articles = articles::select('id')->where('option_id','like',"%$val%")->get();
                foreach($articles as $val){
                    $duan_array[] = $val->id;
                }
            }
        }

        $theloai_array = [];
        if($Request->theloai){
            foreach($Request->theloai as $val){
                $articles = articles::select('id')->where('option_id','like',"%$val%")->get();
                foreach($articles as $val){
                    $theloai_array[] = $val->id;
                }
            }
        }

        $chinhanh_array = [];
        if($Request->chinhanh){
            foreach($Request->chinhanh as $val){
                $articles = articles::select('id')->where('option_id','like',"%$val%")->get();
                foreach($articles as $val){
                    $chinhanh_array[] = $val->id;
                }
            }
        }

        // dd($chinhanh_array);

        $articles = articles::orderBy('id','desc')->where('status','true');
        if($Request->file){
            $articles->whereIn('category_id',$Request->file);
        }
        if($duan_array){
            $articles->whereIn('id',$duan_array);
        }
        if($theloai_array){
            $articles->whereIn('id',$theloai_array);
        }
        if($chinhanh_array){
            $articles->whereIn('id',$chinhanh_array);
        }
        $articles = $articles->paginate(50);

        // dd($articles);

        // return view('admin.search',[
        //     'articles'=>$articles,
        // ]);

        return view('admin.dashboard',[
            'articles'=>$articles,
            'category'=>$category,
            'option'=>$option,

            'key_file'=>$Request->file,
            'key_duan'=>$Request->duan,
            'key_theloai'=>$Request->theloai,
            'key_chinhanh'=>$Request->chinhanh,
        ]);
    }

    public function detail($id)
    {
        $articles = articles::where('id',$id)->where('status','true')->orderBy('id','desc')->first();
        $option = option::wherein('sort_by',['theloai'])->where('status','true')->orderBy('id','desc')->get();
        return view('admin.dashboard.detail',[
            'articles'=>$articles,
            'option'=>$option,
        ]);
    }

}

