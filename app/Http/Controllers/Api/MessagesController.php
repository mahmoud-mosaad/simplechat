<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\Thread;
use DB;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authUserMessages(Request $request)
    {
        $threads_subs = auth()->user()->threads->pluck('id')->toArray();

        if ($request->input('page') || $request->input('thread'))
            $threads_subs = [$request->input('thread')];

        $messages = [];
        
        foreach($threads_subs as $threads_sub){
            
            $msgs = 
                DB::table('messages')
                    ->join('threads', 'threads.id', '=', 'messages.thread_id')
                    ->join('users', 'users.id', '=', 'messages.author_id')
                    ->select('users.name as author_name', 'users.avatar as author_avatar', 'threads.type as thread_type', 'threads.name as thread_name', 'threads.description as thread_description', 'messages.*')
                    ->where('messages.thread_id', '=', $threads_sub)
                    ->orderBy('timestamp', 'DESC')->paginate(10)->items();

            for ($i = count($msgs)-1; $i >= 0 ; $i--)
                $messages[] = $msgs[$i];
            
        }

        $threads_users = Thread::
                // ->join('thread_user', 'threads.id', '=', 'thread_user.thread_id')
                // join('users', 'users.id', '=', 'thread_user.user_id')
                // ->select('threads.id as thread_id', 'users.id as user_id', 'users.name as user_name', 'users.avatar as user_avatar')
                whereIn('id', $threads_subs)
                ->get();

        $threads_users_result = [];

        foreach($threads_users as $thread_user)
            $threads_result[$thread_user->id][] = array('id' => $thread_user->id, 'name' => $thread_user->name, 'avatar' => $thread_user->avatar);

        $messages_result = [];

        foreach($messages as $message){
            
            $msg = [];
            $msg['id'] = $message->id;
            $msg['text'] = $message->text;
            $msg['timestamp'] = $message->timestamp;
            $msg['attachments'] = $message->attachments;
            $msg['record'] = $message->record;
            $msg['is_read'] = $message->is_read;
            
            if ($message->thread_type == 'user')
                $msg['thread'] = array('id' => $message->thread_id, 'type' => $message->thread_type, 'users' => $threads_result[$message->thread_id]);
            else
                $msg['thread'] = array('id' => $message->thread_id, 'name' => $message->thread_name, 'description' => $message->thread_description, 'type' => $message->thread_type, 'users' => $threads_result[$message->thread_id]);
            $msg['author'] = array('id' => $message->author_id, 'name' => $message->author_name, 'avatar' => $message->author_avatar);

            $messages_result[] = $msg;

        }

        return json_encode($messages_result);
    }

    public function createMessage(Request $request)
    {

        if ($request->input('attachments')){

            $attachments = $request->input('attachments');

            if (!array_key_exists('files', $attachments) && !array_key_exists('photos', $attachments))
                $attachments = '{}';
            else if (!array_key_exists('files', $attachments) && array_key_exists('photos', $attachments))
                $attachments = '{"photos": ' . json_encode($attachments['photos']) . '}';
            else if (array_key_exists('files', $attachments) && !array_key_exists('photos', $attachments))
                $attachments = '{"files": ' . json_encode($attachments['files']) . '}';
            else
                $attachments = '{"files": ' . json_encode($attachments['files']) . ', "photos": ' . json_encode($attachments['photos']) . '}';

        }
        else{
            $attachments = '{}';
        }

        if ($request->input('record')){
            $record = $request->input('record');

            if (!array_key_exists('path', $record) || !array_key_exists('duration', $record) || !array_key_exists('type', $record))
                $record = '{}';
            else
                $record = '{"path": "' . $record['path'] . '", "duration": ' . $record['duration'] . ', "type": "' . $record['type'] . '"}';
        }
        else{
            $record = '{}';
        }

        $message = new Message;
        $message->text = !$request->input('text') ? '' : $request->input('text');
        $message->author_id = auth()->user()->id;
        $message->thread_id = $request->input('thread')['id'];
        $message->timestamp = time();
        $message->attachments = $attachments;
        $message->record = $record;
        $message->save();

        return array('id' => $message->id, 'timestamp' => $message->timestamp);
    }


}
