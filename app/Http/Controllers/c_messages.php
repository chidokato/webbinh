<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\messages;
use App\User;

class c_messages extends Controller
{
    public function getlist()
    {
        $messages = messages::orderBy('id','desc')->get();
        return view('admin.messages.list',[
            'messages'=>$messages,
        ]);
    }

    public function search(Request $Request)
    {
        $datefilter[] = '';
        $messages = messages::orderBy('view','asc')->where('id','!=' , 0);
        if($Request->key){
            $messages->where('name','like',"%$Request->key%");
        }
        if(isset($Request->datefilter)){
            $datefilter = explode(" - ", $Request->datefilter);
            $day1 = date('Y-m-d',strtotime($datefilter[0]));
            $day2 = date('Y-m-d',strtotime($datefilter[1]));
            // $messages->whereBetween('created_at', [$day1, $day2]);
            $messages->whereDate('created_at','>=', $day1)->whereDate('created_at','<=', $day2);
        }
        $messages = $messages->paginate($Request->paginate);

        return view('admin.messages.list',[
            'messages'=>$messages,
            'key'=>$Request->key,
            'datefilter'=>$Request->datefilter,
            'paginate'=>$Request->paginate,
        ]);
    }

    public function getadd()
    {
        $messages = messages::all();
        $user = User::all();
        return view('admin.messages.addedit',['messages'=>$messages, 'user'=>$user]);
    }

    public function postadd(Request $Request)
    {
        $messages = new messages;
        $messages->user_id = $Request->user_id;
        $messages->name = $Request->name;
        $messages->content = $Request->content;
        $messages->status = 'none';
        $messages->save();
        return redirect('admin/messages/list')->with('Success','Thành công');
    }

    public function getedit($id)
    {
        $data = messages::findOrFail($id);
        $user = User::all();
        return view('admin.messages.addedit',['data'=>$data, 'user'=>$user]);
    }

    public function postedit(Request $Request,$id)
    {
        $messages = messages::findOrFail($id);
        $messages->name = $Request->name;
        $messages->user_id = $Request->user_id;
        $messages->content = $Request->content;
        $messages->save();
        return redirect()->back()->with('Success','Thành công');
    }

    public function getdelete($id)
    {
        $messages = messages::findOrFail($id);
        $messages->delete();
        return redirect()->back()->with('Success','Xóa thành công');
    }

}
