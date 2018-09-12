<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ReplyRequest $request, Reply $reply)
    {
        $reply->content = $request->content;
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;

        if ($request->has('reply_type')) {
            $reply->reply_type = $request->reply_type;
            $reply->target_id = $request->target_id;
        } else {
            $reply->target_id = $request->topic_id;
        }

        $reply->save();
        return response()->json(['code' => 0]);
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('destroy', $reply);
        $reply->delete();

        return response()->json(['code' => 0]);
    }

    public function list(Topic $topic) {
        $replies = $topic->replies()->with('user')->whereIn('reply_type', [Reply::TYPE_REPLY, Reply::TYPE_TOPIC])->get();
        $arr_replies = $replies->toArray();
        $replies_index = array_to_map($arr_replies, 'id', true);

        $user = Auth::user();

        foreach ($replies as $key => $reply) {
            $arr_replies[$key]['created_at'] = $reply->created_at->diffForHumans();
            $arr_replies[$key]['can_destroy'] = $user->can('destroy', $reply);
            if ($reply->reply_type === Reply::TYPE_REPLY) {
                $arr_replies[$key]['target'] = $replies_index[$reply->target_id] ?? [];
            }
        }
        return response()->json($arr_replies);
    }
}
