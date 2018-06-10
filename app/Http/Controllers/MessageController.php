<?php

namespace App\Http\Controllers;

use App\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function createMessage(Request $request)
    {
        $params = $request->except(['_token']);

        $date = new \DateTime();
        $message = new Messages();
        $message->creator_id = Auth::user()->id;
        $message->ticket_id = $params['id'];
        $message->content = $params['content'];
        $message->slug = Str::slug($params['id'] . $date->format('dmYhis')) ;
        //var_dump($message); die();
        $message->save();
       // return redirect()->route('show')->with('slug', $params['slug'])->with('success', 'item was added');
        return back()->with('success', 'message was added');
    }


}
