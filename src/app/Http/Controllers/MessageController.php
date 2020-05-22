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

        $query = Message::where('send_user_id' , $user->id)->where('receive_user_id' , $friend->id);
        $query->orWhere(function($query) use($user , $friend){
            $query->where('send_user_id' , $friend->id);
            $query->where('receive_user_id' , $user->id);
        });
        $messages = $query->get();

    //メッセージ一覧機能
        $user_id = Auth::id();
        //メッセージ相手ごとに直近のメッセージ情報を取得
        $messages_sql = DB::select("select max(id) as max,user_id from
        (select receive_user_id as user_id , id from messages where send_user_id = ? 
        union select send_user_id as user_id , id from messages where receive_user_id = ?)
        as tmp group by user_id  ", [ $user_id , $user_id ]);

        //ユーザーごと直近メッセージのユーザーIDとメッセージIDを格納
        $user_array =[];
        $message_array = [];
        foreach($messages_sql as $key => $message){
            $user_array[$key]= $message->user_id;
            $message_array[$key]= $message->max;
        }
        $messageall = Message::all();
        $userall = User::orderBy('id', 'asc')->get();
    //メッセージ一覧機能ここまで

        return view('messages.chat',compact(
            'messages',
            'friend',
            'user',
            'userall',
            'messageall',
            'user_array',
            'message_array',
        ));
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

    public function list_index(){

        $user_id = Auth::id();
        //メッセージ相手ごとに直近のメッセージ情報を取得
        $messages_sql = DB::select("select max(id) as max,user_id from
        (select receive_user_id as user_id , id from messages where send_user_id = ? 
        union select send_user_id as user_id , id from messages where receive_user_id = ?)
        as tmp group by user_id  ", [ $user_id , $user_id ]);

        //ユーザーごと直近メッセージのユーザーIDとメッセージIDを格納
        $user_array =[];
        $message_array = [];
        foreach($messages_sql as $key => $message){
            $user_array[$key]= $message->user_id;
            $message_array[$key]= $message->max;
        }
        $messageall = Message::all();
        $userall = User::orderBy('id', 'asc')->get();

    
        return view('messages.message_list', [
            'userall'=>$userall,
            'messageall'=>$messageall,
            'user_array'=>$user_array,
            'message_array'=>$message_array,
            ]);   
    }


}

