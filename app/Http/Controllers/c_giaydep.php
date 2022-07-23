<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\size;
use App\form;
use App\mausac;

class c_giaydep extends Controller
{
    public function getadd()
    {
        $mausac = new mausac;
        $mausac->name = '';
        $mausac->save();

        return redirect('admin/giaydep/list')->with('Success','Success');
    }

    public function getlist()
    {
        $size = size::all();
        $form = form::all();
        $mausac = mausac::all();
        return view('admin.giaydep.list',[
            'size'=>$size,
            'form'=>$form,
            'mausac'=>$mausac,
        ]);
    }

    public function postedit(Request $Request)
    {
        if ($Request->size_id) {
            foreach ($Request->size_id as $key => $id) {
                $size = size::find($id);
                $size->name = $Request->size[$key];
                $size->save();
            }
        }

        if ($Request->mausac_id) {
            foreach ($Request->mausac_id as $key => $id) {
                $mausac = mausac::find($id);
                $mausac->name = $Request->mausac[$key];
                $mausac->save();
            }
        }

        if ($Request->form_id) {
            foreach ($Request->form_id as $key => $id) {
                $form = form::find($id);
                $form->name = $Request->form[$key];
                $form->save();
            }
        }
        
        return redirect('admin/giaydep/list')->with('Success','Success');
    }
}
