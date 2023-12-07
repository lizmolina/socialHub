<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginTwitterController;
use Illuminate\Support\Facades\Auth;
use App\Models\Queue;
use App\Models\Calendario;

class PostTwitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.create', [
            'calendarios' => Calendario::where(function ($query) {
                $query->where('user_id', request()->user()->id);
            })->paginate(50)
            ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $response = $request->all();
		$type = $response['type'];
        $post =  new Post();
        $post->description=  $response['description'];
        $post->user_id= Auth::id();
        $post->calendario_id= $response['schedule_id'];
        $post->type = $type;
        $user= User::find($post->user_id);



       $request->validate([
           'description' => 'required',
        ]);
       //$post->save();

       // $post->type = $type;
//$twitter = new LoginTwitterController();
           //     $twitter->postTweet($user->twitter_oauth_token,$user->twitter_oauth_token_secret,$post->description);
//return redirect('dashboard-user');
      // var_dump($user->twitter_oauth_token_secret);
       //var_dump($user->twitter_oauth_token);
       var_dump($post->description);

      	switch ($type) {
			case 'Now':
                $post->type = $type;
                $twitter = new LoginTwitterController();
                $twitter->postTweet($user->twitter_oauth_token,$user->twitter_oauth_token_secret,$post->description);
                break;
			case 'Queue':
                $queue = new Queue();
				$queue->status = 'en proceso';
				$post->type = $type;
                break;


			case 'Schedule':
				$post->type = $type;
				break;



		}



        $post->save();
        $post_id = $post->id;

        if ($type == 'Queue') {
			$queue->post_id = $post_id;
			$queue->user_id = request()->user()->id;
			$queue->save();
		}
		return redirect('dashboard-user');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
