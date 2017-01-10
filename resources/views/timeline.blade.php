@extends('layouts.app')

<!-- Main Content -->
@section('content')
    <div class="container">

      <div class="rows">
        <div class="col-md-3 col-sm-4 col-xs-12 panel-back">
          <div class="col-xs-1 col-md-0 col-sm-0"></div>
          <div class="col-xs-10 col-md-12 col-sm-12">
          <div style="margin-top:10px;">
            <ul class="list-group list-unstyled text-center">
              <li class="list-group-item">
                <img class="center-block img-responsive" src="data:image/jpeg;base64,{{ base64_encode($profile['img']) }}"></li>
              <li class="list-group-item"  style="padding-top:20px">
                <ruby>
                    {{ $profile->last_name }}<rp>(</rp><rt>{{ $profile->last_kana }}</rt><rp>)</rp>
                    {{ $profile->first_name }}<rp>(</rp><rt>{{ $profile->first_kana}}</rt><rp>)</rp>
                </ruby>
              <li class="list-group-item">フォロー：2</li>
              <li class="list-group-item">フォロワー：2</li>
            </ul>
          </div><!--  -->
          </div>
          <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 panel-trans" style="padding-bottom:0; margin-bottom:10px;">
            <h2>通知欄</h2>
            <ul class="list-group list-unstyled">
              <li class="list-group-item">ゴメスは新規ユーザーです。</li>
            </ul>
            <p class="text-right">もっと見る</p>
          </div><!--  -->
        </div>
        
        <div class="col-md-6 col-sm-8 col-xs-12 panel-back">
          <div class="post_list panel-trans post_form" style="padding-bottom:0;margin-top:10px;padding-right:25px;padding-left:20px">
            <div class="row noright">
                @foreach (\Auth::User()->all() as $user)
                @if($user->id != \Auth::User()->id)
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3 noleft noright">
                <a href="{{ url('profile/' . $user->username) }}">
                  <img style="padding-left:5px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 noright" src="data:image/jpeg;base64,{{ base64_encode($user->profile['img']) }}">
                </a>
                <a href="{{ url('profile/' . $user->username) }}">
                  <p class="col-lg-12 col-md-12 col-sm-12 col-xs-12 noright noleft text-center resp">{{$user->profile->last_name . ' ' . $user->profile->first_name}}</p>
                </a>
                </div>
                @endif
                @endforeach
            </div>
            <p class="text-right">もっと見る</p>
          </div><!--  -->
          <div class="panel-trans post_form" style="margin-bottom:0px;padding-bottom:5px;margin-top:20px;">
            {{ Form::open(array('url' => '/tweet')) }}
              <div class="form-group">
                <label for="post_tweet">投稿欄</label>
                <input type="text" class="form-control" name="tweet"></input>
                <input class="btn btn-primary form-control" type="submit"></input>
              </div>
            {{ Form::close() }}
          </div><!-- .post_form -->
          <br>
          @if (isset($tweets[0]))
          <div class="post_list panel-trans post_form" style="padding-bottom:0;">
            <ul class="list-group list-unstyled">
              @foreach ($tweets as $tweet)
              <li class="list-group-item">
                <div class="row">
                  <a href="{{ url('profile/' . $tweet->user->username) }}">
                  <img class="col-xs-3 col-sm-3 col-md-2 col-lg-2 img-responsive" src="data:image/jpeg;base64,{{ base64_encode($tweet->user->profile['img']) }}">
                  </a>
                  <div class="col-xs-9 col-sm-9 col-md-10 col-lg-10 noleft">
                    <a href="{{ url('profile/' . $tweet->user->username) }}">
                    <p>{{ $tweet->user->profile->last_name . ' ' .$tweet->user->profile->first_name }}</p>
                    </a>
                    <p>{{ $tweet->tweet }}</p>
                  </div>
                </div>
              </li>
              <br>
              @endforeach
              </ul>
          </div><!--  -->
          @endif
        </div><!--  -->
        </div>

        <div class="col-md-3 col-xs-12 panel-back">
        <div class="panel-trans" style="padding-bottom:0;margin-top:10px">
          <h2>ブログ</h2>
          <ul class="list-group list-unstyled" style="margin-bottom:10px">
            @foreach ($articles as $article)
            <li class="list-group-item overflow-wrap">
              <a href="{{ url('article/detail/' . $article->id) }}">{{$article->title}}<br></a>
              by <a href="{{ url('profile/' . $article->user->username) }}">{{$article->user->profile->last_name . ' ' . $article->user->profile->first_name}}</a>
              <br>blg <a href="{{ url('article/' . $article->user->username) }}">{{$article->user->username}}</a>
              </li>
            <br>
            @endforeach
          </ul>
          <p class="text-right"><a href="{{ url('blog') }}" style="color:black">もっと見る</a></p>
        </div><!--  -->

        </div>

      </div> <!-- .rows -->

    </div> <!-- .container -->
@endsection