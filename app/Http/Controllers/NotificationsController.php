<?php

namespace App\Http\Controllers;

use App\Mail\UserInitialized;
use Illuminate\Http\Request;
use Auth;
use Mail;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // 获取登录用户的所有通知
        $notifications = Auth::user()->notifications()->paginate(20);
        // 标记为已读，未读数量清零
        Auth::user()->markAsRead();
        return view('notifications.index', compact('notifications'));
    }

    public function mail() {
        $obj = new \stdClass();
        $obj->email = 'cl0067@126.com';
        $obj->name = 'cl0067';
        Mail::to($obj)->send(new UserInitialized());
    }
}