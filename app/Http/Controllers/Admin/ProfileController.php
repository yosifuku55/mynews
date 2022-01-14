<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでNews Modelが扱えるようになる
use app\profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create()  
    {
        return redirect('admin/profile/create');
    }
    
    public function edit()
    {
        return view('admin.profile.edit');
    }
    
    public function update()
    {
        return redirect('admin/profile/edit');
    }

    public function Controllers(Request $request)
    {
        
        // Varidationを行う
        // 今回はプローフィールの値チェック(newsじゃない)
         $this->validate($request, profile::$rules);
        
        // 今回はプローフィール登録(newsじゃない)
        $Myprofile = Myprofile;
        
        $form = $request->all();
       
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
         // データベースに保存する
        $myprofile->fill($form);
        $myprofile->save();
    }
    
}