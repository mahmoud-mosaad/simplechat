<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Message;
use App\Models\Group;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ChatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function saveAudioBlob(Request $request)
    {

        if ($request->hasFile('audio_data')){

            $file_name = uniqid() . '-' . time() . '.wav';

            $path = $request->audio_data->storeAs('chat/records', $file_name, 'public_assets');

            return $path;
        }

    }

}
