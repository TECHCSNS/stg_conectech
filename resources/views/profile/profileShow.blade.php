@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">プロフィール<a href="{{ url('profile/edit') }}" class="pull-right">
                    @if (\Auth::User()->id == $profile->user->id)
                    <span>編集</span>
                    @endif
                </a></div>

                  <div class="panel-body panel-back">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <img src="data:image/jpeg;base64,{{base64_encode($profile['img'])}}" alt="profile Pic" class=" img-responsive">
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8" id="sampleAccordion">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2>
                                        <ruby>
                                            {{ $profile->last_name }}<rp>(</rp><rt>{{ $profile->last_kana }}</rt><rp>)</rp>
                                            {{ $profile->first_name }}<rp>(</rp><rt>{{ $profile->first_kana}}</rt><rp>)</rp>
                                        </ruby>
                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    @if (\Auth::User()->id == $profile->user->id)
                                        <button class="btn btn-default">フォロー</button>
                                    @endif
                                </div>
                            </div>

                            <hr/>

                            <ul class="nav nav-pills panel-trans">
                            	<li><a data-toggle="collapse" href="#collapseSample1" data-parent="#sampleAccordion">詳細</a></li>
                            	<li><a data-toggle="collapse" href="#collapseSample2" data-parent="#sampleAccordion">
                            	    <ruby>
                                        10<rp>(</rp><rt>フォロー</rt><rp>)</rp>
                                    </ruby></a>
                                </li>
                            	<li><a data-toggle="collapse" href="#collapseSample3" data-parent="#sampleAccordion">
                            	    <ruby>
                                        10<rp>(</rp><rt>フォロワー</rt><rp>)</rp>
                                    </ruby></a>
                                </li>
                            	<li><a href="{{ url("/article/".$profile->user->username) }}">ブログ</a></li>
                            </ul>
                            
                            <div id="sampleAccordion">
                            	<div id="collapseSample1" class="collapse">
                            		<table class="table">
                                        <tr>
                                            <th>専攻</th>
                                            <td>{{ $profile->major }}</td>
                                        </tr>
                                        <tr>
                                            <th>出身</th>
                                            <td>{{ $profile->born_place }}</td>
                                        </tr>
                                        <tr>
                                            <th>誕生日</th>
                                            <td>{{ $profile->birth->format('Y年m月d日') }}</td>
                                        </tr>
                                        <tr>
                                            <th>自己紹介</th>
                                            <td>{!! str_replace('&lt;br /&gt;', '<br>', e( nl2br($profile->about_me) ,ENT_QUOTES) ) !!}</td>
                                        </tr>
                                        <tr>
                                            <th>趣味</th>
                                            <td>{!! str_replace('&lt;br /&gt;', '<br>', e( nl2br($profile->hobby) ,ENT_QUOTES) ) !!}</td>
                                        </tr>
                                        <tr>
                                            <th>技術</th>
                                            <td>{!! str_replace('&lt;br /&gt;', '<br>', e( nl2br($profile->technic) ,ENT_QUOTES) ) !!}</td>
                                        </tr>
                                        <tr>
                                            <th>得意分野</th>
                                            <td>{!! str_replace('&lt;br /&gt;', '<br>', e( nl2br($profile->specialty) ,ENT_QUOTES) ) !!}</td>
                                        </tr>
        
                                    </table>
                            	</div>
                            	<div id="collapseSample2" class="collapse">
                            		<p>メニューＢの内容</p>
                            	</div>
                            	<div id="collapseSample3" class="collapse">
                            		<p>メニューＣの内容</p>
                            	</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- .panel -->
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
              </li>
              <br>
              @endforeach
              </ul>
          </div><!--  -->
          @endif
        </div>
    </div>
</div>
@endsection
