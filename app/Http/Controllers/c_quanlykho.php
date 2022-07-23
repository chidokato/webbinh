<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Image;
use File;
use App\articles;
use App\product;
use App\mausac;
use App\form;
use App\size;
use App\quanlykho;

class c_quanlykho extends Controller
{
    public function getlist()
    {
        $articles = articles::where('sort_by',1)->orderBy('id','desc')->get();
        return view('admin.quanlykho.list',[
            'articles'=>$articles
        ]);
    }

    public function getedit($id)
    {
        $data = articles::findOrFail($id);
        $mausac = mausac::all();
        $form = form::all();
        $size = size::orderBy('name','asc')->get();
        return view('admin.quanlykho.addedit',[
            'data'=>$data,
            'mausac'=>$mausac,
            'form'=>$form,
            'size'=>$size,
        ]);
    }

    public function postedit(Request $Request,$id)
    {
        // delete
        if (isset($Request->foo)) {
            foreach ($Request->foo as $key => $dell_id) {
                $quanlykho = quanlykho::where('id', $dell_id)->get();
                foreach ($quanlykho as $key => $value) {
                    $quanlykho = quanlykho::find($value->id);
                    $quanlykho->delete();
                }
            }
        }else{
            // update tồn kho
            if (isset($Request->all_tonkho)) {
                $quanlykho = quanlykho::where('articles_id', $id)->get();
                foreach ($quanlykho as $key => $value) {
                    $quanlykho = quanlykho::find($value->id);
                    $quanlykho->tonkho = $Request->all_tonkho;
                    $quanlykho->save();
                }
            }elseif(isset($Request->tonkho)){
                foreach ($Request->id_tk as $key => $id_tk) {
                    $quanlykho = quanlykho::find($id_tk);
                    $quanlykho->tonkho = $Request->tonkho[$key];
                    $quanlykho->save();
                }
            }

            // update size chân
            if (isset($Request->sizechan)) {
                if (isset($Request->mausac)) {
                    foreach ($Request->mausac as $key => $value) {
                        $quanlykho = quanlykho::where('articles_id', $id)->where('mausac_id', $value)->orderBy('size','asc')->get();
                        $i = $Request->sizechan;
                        foreach ($quanlykho as $key => $value) {
                            $quanlykho = quanlykho::find($value->id);
                            $quanlykho->sizechan = $i;
                            $quanlykho->save();
                            $i = $i + 0.5;
                        }
                    }
                }
            }
        }

        if (isset($Request->mausac)) {
            $articles = articles::find($id);
            $product = product::find($articles->product_id);
            $product->mausac_id = implode(',', $Request->mausac);
            $product->save();

            foreach ($Request->mausac as $key => $mausac) {
                if (isset($Request->size)) {
                    foreach ($Request->size as $key => $size) {
                        $count = quanlykho::where('articles_id', $id)->where('mausac_id', $mausac)->where('size', $size)->count();
                        if ($count == 0) {
                            $quanlykho = new quanlykho;
                            $quanlykho->articles_id = $id;
                            $quanlykho->mausac_id = $mausac;
                            $quanlykho->form_id = $Request->form;
                            $quanlykho->size = $size;
                            $quanlykho->save();
                        }
                    }
                }
            }
        }

        return redirect('admin/quanlykho/edit/'.$id)->with('Alerts','Thành công');
    }

    public function getdelete($qid,$id)
    {
        $quanlykho = quanlykho::find($id);
        $quanlykho->delete();
        return redirect('admin/quanlykho/edit/'.$qid)->with('Alerts','Thành công');
    }

    public function delete_all(Request $Request)
    {
        // if (isset($Request->foo)) {
        //     foreach($Request->foo as $id){
        //         $quanlykho = quanlykho::find($id);
        //         $quanlykho->delete();
        //     }
        //     // return redirect('admin/quanlykho/edit/'.$qid)->with('Alerts','Thành công');
        // }
    }

}
