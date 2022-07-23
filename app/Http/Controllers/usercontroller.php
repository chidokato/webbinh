<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\category;
use App\articles;
use App\option;
use File;
use Mail;

class usercontroller extends Controller
{
    //
    public function profile($id)
    {
    	$user = User::find($id);
        $category = category::where('user_id', $user->id)->orderBy('id','desc')->take(20)->get();
        $product = articles::where('sort_by', 1)->where('user_id', $user->id)->orderBy('id','desc')->take(20)->get();
        $news = articles::where('sort_by', 2)->where('user_id', $user->id)->orderBy('id','desc')->take(20)->get();
        return view('admin.user.profile',[
            'data'=>$user,
            'category'=>$category,
            'product'=>$product,
            'news'=>$news,
        ]);
    }

    public function alerts($id)
    {
        $user = User::find($id);
        return view('admin.user.alerts',[
            'data'=>$user,
        ]);
    }

    public function getlist()
    {
        $user = User::orderBy('id','desc')->get();
        return view('admin.user.list',['user'=>$user]);
    }

    public function search(Request $Request)
    {
        $datefilter[] = '';
        $user = User::orderBy('id','desc')->where('id','!=' , 0);
        if($Request->key){
            $user->where('name','like',"%$Request->key%");
        }
        if(isset($Request->datefilter)){
            $datefilter = explode(" - ", $Request->datefilter);
            $day1 = date('Y-m-d',strtotime($datefilter[0]));
            $day2 = date('Y-m-d',strtotime($datefilter[1]));
            // $user->whereBetween('created_at', [$day1, $day2]);
            $user->whereDate('created_at','>=', $day1)->whereDate('created_at','<=', $day2);
        }
        $user = $user->paginate($Request->paginate);

        return view('admin.user.list',[
            'user'=>$user,
            'key'=>$Request->key,
            'datefilter'=>$Request->datefilter,
            'paginate'=>$Request->paginate,
        ]);
    }

    public function getadd()
    {
        $option = option::where('sort_by','chinhanh')->get();
    	return view('admin.user.addedit',[
            'option'=>$option,
        ]);
    }

    public function postadd(Request $Request)
    {
    	$user = new User;
        // $user->name = $Request->name;
        $user->password = bcrypt($Request->password);
        $user->permission = $Request->permission;
        $user->your_name = $Request->your_name;
        $user->option_id = $Request->option_id;
        $user->email = $Request->email;
        $user->phone = $Request->phone;
        $user->birthday = $Request->birthday;
        $user->facebook = $Request->facebook;
        
        if ($Request->hasFile('img')) {
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/user/".$filename)){$filename = str_random(4)."_".$filename;}
            $file->move('data/user', $filename);
            $user->avatar = $filename;
        }
        $user->save();

        return redirect('admin/user/list')->with('Alerts','Thành công');

    }

    public function getedit($id)
    {
        $user = User::find($id);
        $option = option::where('sort_by','chinhanh')->get();
    	return view('admin.user.addedit',[
            'data'=>$user,
            'option'=>$option,
        ]);
    }

    public function postedit(Request $Request,$id)
    {
        $user = User::find($id);
        // $user->name = $Request->name;
        $user->your_name = $Request->your_name;
        $user->option_id = $Request->option_id;
        $user->email = $Request->email;
        $user->phone = $Request->phone;
        $user->birthday = $Request->birthday;
        $user->facebook = $Request->facebook;
        $user->address = $Request->address;
        if($user->permission > 0)
        {
            $user->permission = $Request->permission;
        }

        if($Request->changepassword == "on")
        {
            $this->validate($Request,
            [
                'password' => 'Required',
                'passwordagain' => 'Required|same:password'                
            ],
            [] );
            $user->password = bcrypt($Request->password);
        }

        if ($Request->hasFile('img')) {
            if(File::exists('data/user/'.$user->avatar)) { File::delete('data/user/'.$user->avatar); } // xóa ảnh
            $file = $Request->file('img');
            $filename = $file->getClientOriginalName();
            while(file_exists("data/user/".$filename)){$filename = str_random(4)."_".$filename;}
            $file->move('data/user', $filename);
            $user->avatar = $filename;
        } // thêm ảnh
        $user->save();

        // return redirect('admin/user/edit/'.$id)->with('Alerts','Thành công');
        return redirect()->back()->with('Success','Thành công');
    }

    public function getdelete($id)
    {
        if (Auth::User()->id == $id) {
            return redirect('admin/user/list')->with('error','Bạn không thể xóa chính mình ');
        }else{
            $user = User::find($id);
            $user->delete();
            return redirect('admin/user/list')->with('Alerts','Thành công');
        }
        
    }


    public function getlogin()
    {
    	return view('admin.login');
    }

    public function postlogin(Request $request)
    {
    	$this->validate($request,[
    		'email' => 'required',
    		'password' => 'required|min:3|max:32'
    		],[]);
    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
    	{
            if (Auth::User()->permission < 5) {
                return redirect('admin/dashboard');
            }else{
                return redirect('/');
            }
    	}
    	else
    	{
            return redirect()->back()->with('Success','Tài khoản hoặc mật khẩu không đúng !');
    	}
    }
    public function getlogout()
    {
        Auth::logout();
        return redirect('admin_login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    
    public function registration(Request $Request){
        $this->validate($Request,
            [
                'email' => 'Required|min:3|max:50',
                'password' => 'Required',
                'passwordagain' => 'Required|same:password',
            ],
            [

            ] );
        $user = new User;
        // $user->name = $Request->name;
        $user->password = bcrypt($Request->password);
        $user->permission = 6;
        $user->your_name = $Request->your_name;
        $user->email = $Request->email;
        $user->phone = $Request->phone;
        $user->address = $Request->address;
        $user->save();
        return redirect('signin');
    }

    public function resetacconut(Request $Request){
        $mail = $Request->email;
        $user = user::where('email',$mail)->first();
        if (isset($user)) {
            $user->password = bcrypt('123456');
            $user->save();

            Mail::send('resetacconut', array('name'=>$user['name']), function($message) use ($mail){
                $message->from($mail, 'STTD');
                $message->to($mail, 'STTD')->subject('Khôi phục tài khoản');
            });
            return redirect('signin')->with('Success','Check email để nhận tk và mk mới !');
        }else{
            return redirect()->back()->with('Success','Email không tồn tại !');
        }
    }
    
}
