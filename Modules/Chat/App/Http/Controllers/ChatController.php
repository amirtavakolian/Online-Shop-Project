<?php

namespace Modules\Chat\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Modules\Auth\App\Models\User;
use Modules\Chat\App\Events\PrivateChatEvent;
use Modules\Chat\App\Events\SendMessageEvent;
use Modules\Chat\App\Events\ShowOnlineUsersEvent;
use Modules\Chat\App\Events\UserHasJoinedTheChatEvent;
use Psy\Util\Json;

class ChatController extends Controller
{

    public function index()
    {
        UserHasJoinedTheChatEvent::dispatch(193);
        return view('chat::index');
    }

    public function send(Request $request)
    {
        SendMessageEvent::dispatch($request->all(), auth()->user());
    }

    public function privateChatView(Request $request,User $user)
    {
        PrivateChatEvent::dispatch($request->input(['message']), $user->email);
        return view('chat::private-chat');
    }
}
