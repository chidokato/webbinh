<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\channel;
use App\customer;
use App\order;
use App\banhang;
use App\supplier;
use App\articles;
use App\mausac;
use App\form;
use App\size;
use App\User;
use App\quanlykho;
use Image;
use File;

class c_banhang extends Controller
{
    public function getlist()
    {
        $orders = order::where('note',0)->orderBy('id','desc')->get();
        $user = User::orderBy('id','desc')->get();
        $customer = customer::orderBy('id','desc')->get();
        $channel = channel::orderBy('id','desc')->get();

    	return view('admin.banhang.list',[
            'orders'=>$orders,
            'user'=>$user,
            'customer'=>$customer,
			'channel'=>$channel,
		]);
    }

    public function search(Request $Request)
    {
        $datefilter[] = '';
        $orders = order::where('note',0)->where('id','!=' , 0)->orderBy('id','desc');
        if($Request->key){
            $orders->where('code','like',"%$Request->key%");
        }
        if($Request->user_id){
            $orders->where('user_id', $Request->user_id);
        }
        if($Request->customer_id){
            $orders->where('customer_id', $Request->customer_id);
        }
        if($Request->channel_id){
            $orders->where('channel_id', $Request->channel_id);
        }
        if(isset($Request->datefilter)){
            $datefilter = explode(" - ", $Request->datefilter);
            $day1 = date('Y-m-d',strtotime($datefilter[0]));
            $day2 = date('Y-m-d',strtotime($datefilter[1]));
            // $orders->whereBetween('created_at', [$day1, $day2]);
            $orders->whereDate('date','>=', $day1)->whereDate('date','<=', $day2);
        }
        $orders = $orders->paginate($Request->paginate);
        $user = User::orderBy('id','desc')->get();
        $customer = customer::orderBy('id','desc')->get();
        $channel = channel::orderBy('id','desc')->get();

        return view('admin.banhang.list',[
            'orders'=>$orders,
            'user'=>$user,
            'customer'=>$customer,
            'channel'=>$channel,

            'user_id'=>$Request->user_id,
            'customer_id'=>$Request->customer_id,
            'channel_id'=>$Request->channel_id,
            'key'=>$Request->key,
            'datefilter'=>$Request->datefilter,
            'paginate'=>$Request->paginate,
        ]);
    }
	
    public function getadd()
    {
        $articles = articles::orderBy('id','desc')->get();
		$channel = channel::orderBy('id','asc')->get();
        $customer = customer::orderBy('id','asc')->get();
        $order = order::where('note',0)->orderBy('id','desc')->get();
        $mausac = mausac::orderBy('name','asc')->get();
		$size = size::orderBy('name','asc')->get();
    	return view('admin.banhang.addedit',[
            'articles'=>$articles,
			'channel'=>$channel,
            'customer'=>$customer,
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
            $order->channel_id = $Request->channel_id;
            $order->customer_id = $Request->customer_id;
            $order->note = 0;
            $order->save();
            $order = order::findOrFail($order->id);
            $order->code = 'DH'.date('Ym', time()).$order->id;
            $order->save();
            $order_id = $order->id;
        }else{
            $order_id = $Request->order_id;
        }
    	$banhang = new banhang;
		$banhang->order_id = $order_id;
        $banhang->articles_id = $Request->articles_id;
		$banhang->mausac_id = $Request->mausac_id;
		$banhang->size = $Request->size;
		$banhang->price = $Request->price;
		if($Request->number == ''){ $banhang->total = $Request->price; }
        else { $banhang->total = $Request->price * $Request->number; }
        $banhang->number = $Request->number;
    	$banhang->save();

        $quanlykho = quanlykho::where('articles_id', $Request->articles_id)->where('mausac_id', $Request->mausac_id)->where('size', $Request->size)->first();
        $quanlykho->tonkho = $quanlykho->tonkho - $Request->number;
        $quanlykho->save();

        // return redirect('admin/banhang/edit/'.$order_id)->with('Alerts','Thành công');
        return redirect('admin/banhang/list')->with('Alerts','Thành công');
    }

    public function getedit($id)
    {
        $data = order::findOrFail($id);
		$articles = articles::orderBy('id','desc')->get();
        $channel = channel::orderBy('id','asc')->get();
        $customer = customer::orderBy('id','asc')->get();
        $order = order::orderBy('id','desc')->get();
        $mausac = mausac::orderBy('id','desc')->get();
        
    	return view('admin.banhang.addedit',[
			'data'=>$data,
			'articles'=>$articles,
            'channel'=>$channel,
            'customer'=>$customer,
            'order'=>$order,
            'mausac'=>$mausac,
		]);
    }

    

    public function deleteorder($id)
    {
        $order = order::find($id);
        foreach ($order->banhang as $key => $value) {
            $banhang = banhang::find($value->id);
            $banhang->delete();
        }
        $order->delete();
        return redirect('admin/banhang/list')->with('Success','Success');
    }
    public function dell_banhang($id, $od_id)
    {
        $banhang = banhang::find($id);
        if ($banhang->number > 0) {
            $quanlykho = quanlykho::where('articles_id', $banhang->articles_id)->where('mausac_id', $banhang->mausac_id)->where('size', $banhang->size)->first();
            $quanlykho->tonkho = $quanlykho->tonkho + $banhang->number;
            $quanlykho->save();
        }
        $banhang->delete();
        return redirect('admin/banhang/edit/'.$od_id)->with('Success','Success');
    }

    public function add_sp($id)
    {
        $banhang = new banhang;
        $banhang->order_id = $id;
        $banhang->save();
        return redirect('admin/banhang/edit/'.$id)->with('Success','Success');
    } // thêm sp bán

    public function postedit(Request $Request,$id)
    {
        $order = order::findOrFail($id);
        $order->user_id = Auth::User()->id;
        $order->date = $Request->date;
        $order->channel_id = $Request->channel_id;
        $order->customer_id = $Request->customer_id;
        $order->save();

        if (isset($Request->bh_id)) {
            foreach ($Request->bh_id as $key => $bh_id) {
                $banhang = banhang::findOrFail($bh_id);
                $banhang->articles_id = $Request->articles_id[$key];
                if(isset($Request->mausac_id[$key]))$banhang->mausac_id = $Request->mausac_id[$key];
                if(isset($Request->size[$key]))$banhang->size = $Request->size[$key];
                $banhang->number = $Request->number[$key];
                $banhang->price = $Request->price[$key];
                if($Request->number[$key]==''){
                    $banhang->total = $banhang->price * 1;
                }elseif($Request->number[$key] > 0){
                    $banhang->total = $banhang->price * $Request->number[$key];
                    $quanlykho = quanlykho::where('articles_id', $Request->articles_id[$key])->where('mausac_id', $Request->mausac_id[$key])->where('size', $Request->size[$key])->first();
                    $i = $Request->number[$key] - $Request->number_old[$key];
                    $quanlykho->tonkho = $quanlykho->tonkho - $i;
                    $quanlykho->save();
                }
                $banhang->save();

                
            }
        }
        
        return redirect('admin/banhang/edit/'.$id)->with('Success','Thành công');
    }
}
