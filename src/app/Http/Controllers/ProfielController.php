<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Skill;
use App\Background;
use Illuminate\Support\Facades\Auth;


class ProfielController extends Controller
{

    public function index(){

        $user = Auth::user();
    
        return view('users.user_edit', [
            'user' => $user,
            ]);
    }

    public function store(Request $request){
        if( $request->has('post') ){
            $user = Auth::user();
            $form = $request->all();
            $user->self_introduction = $request->self_introduction;
            $user->fill($form)->save();
            return redirect('/')->with('flash_message', 'プロフィール情報を更新しました');
        }
        $request->flash();
        return $this->index();  
    }

    public function update(Request $request)
    {
        $background = Background::where('id',$request->id)->get();
        //dd($request);
        $background[0]->fill($request->all());
        $background[0]->save();
        //dd($background);
        
        return $this->background_index()->with('flash_message', '経歴・実績を更新しました');
    }

    public function background_index(){
        $user = Auth::user();
        $backgrounds = Background::where('user_id',$user->id)->orderBy('id', 'asc')->get();
        return view('users.background', [
            'user' => $user,
            'backgrounds'=>$backgrounds,
        ]);
    }

    public function background_edit(Request $request){
        $user = Auth::user();
        $background = Background::where('id',$request->background)->get();
        //dd($background);
        
        return view('users.background_edit', [
            'background'=>$background[0],
            'user'=>$user,
        ]);
    }
    
    public function create(Request $request){
        $user = Auth::user();
        $background = new Background;
        $background->fill($request->all());
        $background->user_id = $request->user()->id;
        $background->save();

        return redirect('background');
    }

    public function destroy(Request $request)
    {
        //dd($request->background_id);
        $background = Background::where('id',$request->background_id)->get();
        $background[0]->delete();
  
        return $this->background_index();
    }

}
