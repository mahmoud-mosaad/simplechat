<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Message;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Builder;

class ThreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createChatGroup(Request $request)
    {

        $thread = new Thread;
        $thread->name = $request->input('name');
        $thread->description = $request->input('description');
        $thread->type = 'group';
        $thread->save();
        $users = $request->input('users');
        $users[] = '' . backpack_user()->id . '';
        $thread->users()->sync($users);

        if ($request->input('message')){
            $message = new Message;
            $message->text = $request->input('message');
            $message->author_id = backpack_user()->id;
            $message->thread_id = $thread->id;
            $message->attachments = '{}';
            $message->record = '{}';
            $message->timestamp = time();
            $message->save();
        }

        $thread_users = \App\Models\User::join('thread_user', 'users.id', '=', 'thread_user.user_id')
            ->where('thread_user.thread_id', '=', $thread->id)->select('users.id', 'users.name', 'users.avatar')->get()->toArray();

        return array('id' => $message->id, 'timestamp' => $message->timestamp, 'thread_id' => $thread->id, 'thread_users' => $thread_users);

    }

    public function createUserThread(Request $request)
    {

        // $thread_exists = DB::table('thread_user')
        //     ->select(DB::raw("thread_id"))
        //     ->whereIn('user_id', $request->input('users'))
        //     ->groupBy('thread_id')
        //     ->havingRaw("COUNT(*) = 2")
        //     ->get()->first();

//        $thread_exists = \App\Models\Thread::whereHas('users', function (Builder $query) use($request) {
//            $query->whereIn('user_id', $request->input('users'));
//        })->get()->first();


        $thread_exists = Thread::whereIn('user_ids', $request->input('users'))->get()->first();

        if (!$thread_exists){

            $thread = new Thread;
            $thread->name = '';
            $thread->description = '';
            $thread->type = 'user';
            $thread->save();
            $thread->users()->sync($request->input('users'));

            return $thread->id;
        }

        return $thread_exists->id;

    }

    public function userSubscribedThreads(Request $request)
    {

        return \App\Models\User::find(auth()->user()->id)->threads()->get()->pluck('id')->toArray();

    }

    public function threadUsers(Request $request)
    {
        $user_ids = json_decode($request->input('activeThreads'), true)['activeUsers'];

        $threads = [];

        foreach ($user_ids as $uid){

            if ($uid != auth()->user()->id){

                $users = array($uid, auth()->user()->id);

                // $thread_users = DB::table('thread_user')
                //     ->select(DB::raw("thread_id"))
                //     ->whereIn('user_id', $users)
                //     ->groupBy('thread_id')
                //     ->havingRaw("COUNT(*) = 2")
                //     ->get()->first();

                $thread_users = Thread::where('type', '=', 'user')->whereIn('user_ids', $users)->get()->first();

                $uidu = \App\Models\User::find($uid);

                if ($thread_users){
                    $threads[$thread_users->id] = array('id' => $thread_users->id, 'type' => 'user', 'user' => array('id' => $uidu->id, 'name' => $uidu->name, 'avatar' => $uidu->avatar), 'users' => [array('id' => $uidu->id, 'name' => $uidu->name, 'avatar' => $uidu->avatar), array('id' => auth()->user()->id, 'name' => auth()->user()->name, 'avatar' => auth()->user()->avatar)]);
                }

            }

        }

        return $threads;

    }

    public function searchUsers(Request $request)
    {

        $searchUsers = $request->input('searchTerm');

        // $users = \App\Models\User::join('thread_user', 'users.id', '=', 'thread_user.user_id')
        //     ->join('threads', 'thread_user.thread_id', '=', 'threads.id')
        //     ->where('threads.type', '=', 'user')
        //     ->where('users.id', '!=', auth()->user()->id)
        //     ->where('users.name', 'like', '%' . $searchUsers . '%')
        //     ->pluck('users.id')
        //     ->toArray();

        $users = \App\Models\User::find(auth()->user()->id)->threads()
                    ->where('type', '=', 'user')
                    ->where('name', 'like', '%' . $searchUsers . '%')
            ->pluck('users.id')
            ->toArray();


        return $users;

    }

    public function searchGroups(Request $request)
    {

        $searchGroups = $request->input('searchTerm');

        $groups = \App\Models\Thread::where('name', 'like', '%' . $searchGroups . '%')->pluck('id')->toArray();

        return $groups;

    }

    public function threadData(Request $request)
    {

        $users = array($request->input('user'), auth()->user()->id);

        // $thread = DB::table('thread_user')
        //     ->select(DB::raw("thread_id"))
        //     ->whereIn('user_id', $users)
        //     ->groupBy('thread_id')
        //     ->havingRaw("COUNT(*) = 2")
        //     ->get()->first();

        $thread = Thread::whereIn('user_ids', $users)->get()->first();

        if ($thread){
            $user = \App\Models\User::find($request->input('user'));
            $users = \App\Models\Thread::find($thread->id)->users()->get();
            $us = [];
            foreach($users as $user){
                $us[] = array(
                    'id' => $user->_id,
                    'name' => $user->name,
                    'avatar' => $user->avatar
                );
            }
            return array(
                        'id' => $thread->id, 
                        'type' => 'user', 
                        'user' => array(
                            'id' => $user->_id,
                            'name' => $user->name,
                            'avatar' => $user->avatar
                        ), 
                        'users' => $us
                    );
        }

    }

}
