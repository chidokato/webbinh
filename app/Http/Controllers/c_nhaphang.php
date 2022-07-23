<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\order;
use App\nhaphang;
use App\supplier;
use App\articles;
use App\mausac;
use App\form;
use App\size;
use App\User;
use App\quanlykho;
use Image;
use File;

class c_nhaphang extends Controller
{
    public function getlist()
    {
        $orders = order::where('note',1)->orderBy('id','desc')->get();
        $supplier = supplier::orderBy('id','desc')->get();
        $user = User::orderBy('id','desc')->get();
        return view('admin.nhaphang.list',[
            'orders'=>$orders,
            'supplier'=>$supplier,
            'user'=>$user,
        ]);
    }

    public function search(Request $Request)
    {
        $datefilter[] = '';
        $orders = order::where('note',1)->where('id','!=' , 0)->orderBy('id','desc');
        if($Request->key){
            $orders->where('code','like',"%$Request->key%");
        }
        if($Request->user_id){
            $orders->where('user_id', $Request->user_id);
        }
        if($Request->supplier_id){
            $orders->where('supplier_id', $Request->supplier_id);
        }
        if(isset($Request->datefilter)){
            $datefilter = explode(" - ", $Request->datefilter);
            $day1 = date('Y-m-d',strtotime($datefilter[0]));
            $day2 = date('Y-m-d',strtotime($datefilter[1]));
            // $orders->whereBetween('created_at', [$day1, $day2]);
            $orders->whereDate('created_at','>=', $day1)->whereDate('created_at','<=', $day2);
        }
        $orders = $orders->paginate($Request->paginate);
        $supplier = supplier::orderBy('id','desc')->get();
        $user = User::orderBy('id','desc')->get();

        return view('admin.nhaphang.list',[
            'orders'=>$orders,
            'supplier'=>$supplier,
            'user'=>$user,

            'user_id'=>$Request->user_id,
            'supplier_id'=>$Request->supplier_id,
            'key'=>$Request->key,
            'datefilter'=>$Request->datefilter,
            'paginate'=>$Request->paginate,
        ]);
    }

    
    public function getadd()
    {
        $articles = articles::orderBy('id','desc')->get();
        $supplier = supplier::orderBy('id','asc')->get();
        $order = order::where('note',1)->orderBy('id','desc')->get();
        $mausac = mausac::orderBy('name','asc')->get();
        $size = size::orderBy('name','asc')->get();
        return view('admin.nhaphang.addedit',[
            'articles'=>$articles,
            'supplier'=>$supplier,
            'order'=>$order,
            'mausac'=>$mausac,
            'size'=>$size,
        ]);
    }
    
    public function postadd(Request $Request)
    {
        if ($Request->order_id == 0) {
            $order = new order;
            $order->user_id = Auth::User()->id;
            $order->date = $Request->date;
            $order->supplier_id = $Request->supplier_id;
            $order->note = '1';
            $order->save();
            $order = order::findOrFail($order->id);
            $order->code = 'DH'.date('Ym', time()).$order->id;
            $order->save();
            $order_id = $order->id;
        }else{
            $order_id = $Request->order_id;
        }
        $nhaphang = new nhaphang;
        $nhaphang->order_id = $order_id;
        $nhaphang->articles_id = $Request->articles_id;
        $nhaphang->mausac_id = $Request->mausac_id;
        $nhaphang->form_id = $Request->form_id;
        $nhaphang->number = $Request->number;
        $nhaphang->price = $Request->price;
        if($Request->number=='')$nhaphang->total = 1 * $Request->price;
        else $nhaphang->total = $Request->number * $Request->price;
        $nhaphang->save();

        $quanlykho_list = quanlykho::where('articles_id', $Request->articles_id)->where('mausac_id', $Request->mausac_id)->where('form_id', $Request->form_id)->get();
        $i = $Request->number/count($quanlykho_list);
        foreach ($quanlykho_list as $val) {
            $quanlykho = quanlykho::find($val->id);
            $quanlykho->tonkho = $quanlykho->tonkho + $i;
            $quanlykho->save();
        }

        return redirect('admin/nhaphang/edit/'.$order_id)->with('Alerts','Thành công');
    }

    public function getedit($id)
    {
        $data = order::findOrFail($id);
        $articles = articles::orderBy('id','desc')->get();
        $order = order::orderBy('id','desc')->get();
        $mausac = mausac::orderBy('id','desc')->get();
        $supplier = supplier::orderBy('id','asc')->get();
        return view('admin.nhaphang.addedit',[
            'data'=>$data,
            'articles'=>$articles,
            'order'=>$order,
            'mausac'=>$mausac,
            'supplier'=>$supplier,
        ]);
    }

    public function deleteorder($id)
    {
        $order = order::find($id);
        foreach ($order->nhaphang as $key => $value) {
            $nhaphang = nhaphang::find($value->id);
            $nhaphang->delete();
        }
        $order->delete();
        return redirect('admin/nhaphang/list')->with('Success','Success');
    }
    public function dell_nhaphang($id, $od_id)
    {
        $nhaphang = nhaphang::find($id);

        $quanlykho_list = quanlykho::where('articles_id', $nhaphang->articles_id)->where('mausac_id', $nhaphang->mausac_id)->where('form_id', $nhaphang->form_id)->get();
        $i = $nhaphang->number/count($quanlykho_list);
        foreach ($quanlykho_list as $val) {
            $quanlykho = quanlykho::find($val->id);
            $quanlykho->tonkho = $quanlykho->tonkho - $i;
            $quanlykho->save();
        }

        $nhaphang->delete();
        return redirect('admin/nhaphang/edit/'.$od_id)->with('Success','Success');
    }

    public function add_sp($id)
    {
        $nhaphang = new nhaphang;
        $nhaphang->order_id = $id;
        $nhaphang->save();
        return redirect('admin/nhaphang/edit/'.$id)->with('Success','Success');
    } // thêm sp bán

    public function postedit(Request $Request,$id)
    {
        $order = order::findOrFail($id);
        $order->user_id = Auth::User()->id;
        $order->date = $Request->date;
        $order->supplier_id = $Request->supplier_id;
        $order->save();

        if (isset($Request->bh_id)) {
            foreach ($Request->bh_id as $key => $bh_id) {
                $nhaphang = nhaphang::findOrFail($bh_id);
                $nhaphang->articles_id = $Request->articles_id[$key];
                $nhaphang->form_id = $Request->form_id[$key];
                if(isset($Request->mausac_id[$key]))$nhaphang->mausac_id = $Request->mausac_id[$key];
                if(isset($Request->form_id[$key]))$nhaphang->form_id = $Request->form_id[$key];
                $nhaphang->number = $Request->number[$key];
                $nhaphang->price = $Request->price[$key];
                if($Request->number[$key]==''){$nhaphang->total = $nhaphang->price * 1;}
                else{$nhaphang->total = $nhaphang->price * $Request->number[$key];}
                $nhaphang->save();

                $quanlykho_list = quanlykho::where('articles_id', $Request->articles_id[$key])->where('mausac_id', $Request->mausac_id[$key])->where('form_id', $Request->form_id[$key])->get();
                $i = $Request->number[$key]/count($quanlykho_list)-$Request->number_old[$key]/count($quanlykho_list);
                foreach ($quanlykho_list as $val) {
                    $quanlykho = quanlykho::find($val->id);
                    $quanlykho->tonkho = $quanlykho->tonkho + $i;
                    $quanlykho->save();
                }
            }
        }


        
        return redirect('admin/nhaphang/edit/'.$id)->with('Success','Thành công');
    }
}
