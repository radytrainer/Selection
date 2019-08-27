<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class upload extends Controller
{

    public function uploadFile(REQUEST $request){
        if( $request->hasFile('inputFile')){
            $fileName=$request->file('inputFile')->getClientOriginalName();
            $request->file('inputFile')->storeAs('public/img',$fileName);

              // $id = \Auth::user()->id;
              // //dd($id);
              $user = \Auth::user();
              $user->profile = $fileName;
              $user->save();
               return view('pages.createCandidate');

        }
    }

}
