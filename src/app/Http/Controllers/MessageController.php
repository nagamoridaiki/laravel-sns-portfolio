<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index(Request $request, string $name)
    {
        //メッセージ相手
        $friend = User::where('name', $name)->first();
    
        //自分
        $user = $request->user();

        $param = [
            'send' => $user->id,
            'recieve' => $friend->id,
          ];
        
        $query = Message::where('send_user_id' , $user->id)->where('receive_user_id' , $friend->id);
        $query->orWhere(function($query) use($user , $friend){
            $query->where('send_user_id' , $friend->id);
            $query->where('receive_user_id' , $user->id);
        });
        $messages = $query->get();

        return view('messages.chat',compact('messages','friend','user'));
    }

    public function send(Request $request , string $name){

        //メッセージ相手
        $friend = User::where('name', $name)->first();
        //自分
        $user = Auth::User();

        $message = new Message;
        $message->send_user_id = $user->id;
        $message->receive_user_id = $friend->id;

        $form = $request->all();

        unset($form['_token']);
        $message->fill($form)->save();

        return redirect('/'.$friend->name.'/message');
    }
}
