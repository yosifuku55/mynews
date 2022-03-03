<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    // 以下を追記
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
        
    );
    // 以下を追記
    // News Modelに関連付けを行う
    public function histories()
    {
        return $this->hasMany('App\ProfileHistory');

    }
}
