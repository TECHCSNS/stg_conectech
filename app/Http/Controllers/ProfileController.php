<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Image;


use App\User;
use App\Profile;
use App\Tweet;



class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::User();
        $profile = $user->profile;
        $tweets = Tweet::where('user_id',$user->id)->get();
        
        return view('profile.profileShow', ['profile' => $profile, 'tweets' => $tweets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('profile.profileEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'img' => 'required',
            'first_name' => 'required|max:255',
            'first_kana' => 'max:255',
            'middle_name' => 'max:255',
            'middle_kana' => 'max:255',
            'last_name' => 'required|max:255',
            'last_kana' => 'max:255',
            'birth' => 'required|date',
            'major' => 'required|max:255',
            'born_place' => 'required|max:255',
        ]);
        
        $file = $request->img;
        $img = Image::make($file);
        $requimg = $img->encode('jpeg');
        $img->resize(null, 100, function ($constraint) {
            $constraint->aspectRatio();
        });
        
        $img->resize(100, 100);
        $thumbnail = $img->encode('jpeg');
        
        $request->user()->profile()->create([
            'user_id' => \Auth::user()->id,
            'permission' => 2,
            'img' => $requimg,
            'thumbnail' => $thumbnail,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'first_kana' => $request->first_kana,
            'middle_kana' => $request->middle_kana,
            'last_kana' => $request->last_kana,
            'birth' => $request->birth,
            'sex' => $request->sex,
            'major' => $request->major,
            'born_place' => $request->born_place,
            'hobby' => $request->hobby,
            'about_me' => $request->about_me,
            'technic' => $request->technic,
            'specialty' => $request->specialty,
        ]);
        $profile = \Auth::user()->profile;
        
        
        return view('profile.profileShow', ['profile' => $profile]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        //
        $user = User::where('username',$username)->first();
        $profile = $user->profile;
        $tweets = Tweet::where('user_id',$user->id)->get();
        
        return view('profile.profileShow', ['profile' => $profile, 'tweets' => $tweets]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $user = \Auth::user();
        $profile = $user->profile;
        
        return view('profile.profileEdit', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'first_kana' => 'max:255',
            'middle_name' => 'max:255',
            'middle_kana' => 'max:255',
            'last_name' => 'required|max:255',
            'last_kana' => 'max:255',
            'birth' => 'required|date',
            'major' => 'required|max:255',
            'born_place' => 'required|max:255',
        ]);
        
        
        $file = $request->img;
        if($file != null){
            $img = Image::make($file);
            $img->resize(300, 300);
            $requimg = $img->encode('jpeg');
            $img->resize(100, 100);
            $thumbnail = $img->encode('jpeg');
        }else{
            $requimg = \Auth::User()->profile->img;
            $thumbnail = \Auth::User()->profile->thumbnail;
        }
        
        
        $profile = \Auth::user()->profile;
        $profile->update([
            'user_id' => \Auth::user()->id,
            'permission' => 2,
            'img' => $requimg,
            'thumbnail' => $thumbnail,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'first_kana' => $request->first_kana,
            'middle_kana' => $request->middle_kana,
            'last_kana' => $request->last_kana,
            'birth' => $request->birth,
            'sex' => $request->sex,
            'major' => $request->major,
            'born_place' => $request->born_place,
            'hobby' => $request->hobby,
            'about_me' => $request->about_me,
            'technic' => $request->technic,
            'specialty' => $request->specialty,
        ]);
        
        return view('profile.profileShow', ['profile' => $profile]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function testImg()
    {
        //
        $img = \Auth::User()->profile->img;

        $response['img'] = $img;
        $response['type'] = 'jpeg';

        return view('home',compact('response'));
        /*$image = Image::make(file_get_contents('http://goo.gl/uDTEzv'));
        $image->resize(100, null, function ($constraint) {
            $constraint->aspectRatio();
            
        });
        return $image->response('jpg');*/
    }
}
