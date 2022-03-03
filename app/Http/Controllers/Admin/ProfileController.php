<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでNews Modelが扱えるようになる
use App\Profile;

use App\ProfileHistory;

// 以下を追記
use Carbon\Carbon;


class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)  
    {
        // Varidationを行う
        // 今回はプローフィールの値チェック(newsじゃない)
         $this->validate($request, Profile::$rules);
        
        // 今回はプローフィール登録(newsじゃない)
        $Myprofile = new Profile;
        
        $form = $request->all();
       
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
         // データベースに保存する
        $Myprofile->fill($form);
        $Myprofile->save();
        return redirect('admin/profile.create');
    }
    
         // 以下を追記
    public function index(Request $request)
    {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = profile::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
      
    }
    
    
        // 以下を追記
  public function edit(Request $request)
    {
      // News Modelからデータを取得する
      $profile = profile::find($request->id);
      if (empty($profile)) {
        abort(404);

      }
      
      return view('admin.profile.edit', ['profile_form' => $profile]);
    }


  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, profile::$rules);
      // News Modelからデータを取得する
      $profile = profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();
      if ($request->remove == 'true') {
          $profile_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $profile_form['image_path'] = basename($path);
      } else {
          $profile_form['image_path'] = $profile->image_path;
      }

      unset($profile_form['image_path']);
      unset($profile_form['remove']);
      unset($profile_form['_token']);

      // 該当するデータを上書きして保存する
      $profile->fill($profile_form)->save();
      
      // 以下を追記
        $history = new ProfileHistory();
        $history->profile_id = $profile->id;
        $history->edited_at = Carbon::now();
        $history->save();

      return redirect('admin/profile/');
      
  }
    
    //public function delete(Request $request)
  //{
      // 該当するNews Modelを取得
      //$profile = profile::find($request->id);
      // 削除する
      //$profile->delete();
      //return redirect('admin/profile/');
  //}
}    