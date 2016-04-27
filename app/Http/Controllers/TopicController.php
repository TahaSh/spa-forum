<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Topic;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Comment;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['only' => [
            'store',
            'update',
            'destroy'
        ]]);
    }

    public function index()
    {
        return Topic::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $request['views'] = 0;
        $request['created_at'] = Carbon::now();
        $request['user_id'] = $user->id;
        return Topic::create($request->all());
    }

    public function show($id)
    {
        return Topic::findOrFail($id);
    }

    public function update($id, Request $request)
    {
        $topic = Topic::findOrFail($id);

        $user = JWTAuth::parseToken()->authenticate();
        if ($topic->user_id !== $user->id) {
            return response('Unauthorized — you cannot update something you do not own', 401);
        }

        $topic->title = $request->title;
        $topic->body = $request->body;
        $topic->views = $request->views;
        $topic->save();

        return response('Topic updated', 200);
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);

        $user = JWTAuth::parseToken()->authenticate();

        if ($topic->user_id !== $user->id) {
            return response('Unauthorized — you cannot delete something you do not own', 401);
        }

        $topic->delete();
        return response('Topic delete', 200);
    }

    public function incrementViews($id, Request $request)
    {
        $topic = Topic::findOrFail($id);
        $topic->views = $request->views;
        $topic->save();

        return response('Topic views incremented', 200);
    }

    public function addComment($topicId, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        return Comment::create([
            'body' => $request->body,
            'topic_id' => $request->topic_id,
            'user_id' => $user->id
        ]);
    }
}
