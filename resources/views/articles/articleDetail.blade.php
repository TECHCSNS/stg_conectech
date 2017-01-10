@extends('layouts.app')

<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}"> 

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="col-xs-12 col-md-12">
                <div style="margin:10px 0;">
                    {{-- userInfo(icon/userName) --}}
                    <div class="userInfoArea">
                        <ul class="list-group list-unstyled text-center">
                            <li class="list-group-item">
                                <img class="center-block img-responsive" src="data:image/jpeg;base64,{{ base64_encode($poster_profile['img']) }}"></li>
                            <li class="list-group-item"><a href="{{ url('profile/' . $poster_profile->user->username) }}">{{ $poster_profile->last_name }}{{ $poster_profile->middle_name }}{{ $poster_profile->first_name }}</a></li>
                            <li class="list-group-item">投稿数：{{ $articles_count }}</li>
                        </ul>
                    </div>
                    {{-- END userInfo(icon/userName) --}}
                    
                    
                    {{-- addModal --}}
                    <div class="poster">
                        @if(Auth::user()->id == $article->user_id)
                            <button type="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#addModal">Add</button>
                            
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="addModalLabel">Add New Article</h4>
                                        </div>
                                    
                                        <div class="modal-body">
                                            <form class="form-horizontal" role="form" method="POST" action="{{ action('ArticleController@store') }}">
                                                {{ csrf_field() }}
                                                
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <label for="title" class="col-md-4 control-label">Title</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" id="title" name="title">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-md-2">
                                                        <label for="content" class="col-md-4 control-label">Content</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea class="form-control" name="content" cols="50" rows="10" id="content"></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <input type="submit" class="btn btn-info form-control" value="Save">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- END addModal --}}
                </div>
            </div>
        </div>
        
        
        <div class="col-md-9 col-xs-12">
            
            {{-- entry_inner --}}
            <div class="panel panel-default entry_inner">
                
                {{-- entry_header --}}
                <header class="panel-heading rows clearfix">
                    
                    <div class="col-md-12 col-xs-12">
                    @if(Auth::user()->id == $article->user_id)
                            <ul class="list-inline pull-right">
                                <li style="color:black;">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal_{{ $article->id }}">Edit</button>
                                    
                                    <div class="modal fade" id="editModal_{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="editModalLabel">Edit Article</h4>
                                                </div>
                                            
                                                <div class="modal-body">
                                                    <form class="form-horizontal" role="form" method="POST" action="{{ action('ArticleController@update', $article->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('patch') }}
                                                        
                                                        <div class="form-group">
                                                                <div class="col-md-2">
                                                                    <label for="title" class="col-md-4 control-label">Title</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title',$article->title) }}">
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group">
                                                                <div class="col-md-2">
                                                                    <label for="content" class="col-md-4 control-label">Content</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <textarea class="form-control" name="content" cols="50" rows="10" id="content">{{ old('content',$article->content) }}</textarea>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group">
                                                                <div class="col-md-10 col-md-offset-1">
                                                                    <input type="submit" class="btn btn-info form-control" value="Save">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <form action="{{ action('ArticleController@destroy', $article->id) }}" method="POST" style="margin-bottom:0;">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </li>
                                </ul>
                            @endif
                            </div>
                    
                    <div class="col-md-12 col-xs-12">
                        <h1 class="entry_title overflow-wrap" style="margin-top:0;">{{ $article->title }}</h1>
                    </div>
                
                    <div class="col-md-12 col-xs-12">
                    <div class="date">
                        <div class="entry_date">
                            <ul class="list-inline">
                                <li>投稿日：</li>
                                <li>{{ $article->created_at }}</li>
                            </ul>
                        </div>
                        <div class="up_date">
                            <ul class="list-inline">
                                <li>更新日：</li>
                                <li>{{ $article->updated_at }}</li>
                            </ul>
                        </div>
                    </div>
                    </div>
                
                </header>
                {{-- end entry_header --}}
                        
                {{-- entry_content --}}
                <div class="panel-body overflow-wrap panel-back" style="padding:0;">
                    <div class="panel-trans" style="padding:30px;">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </div>
                {{-- end entry_content --}}
                
            </div>
            {{-- end entry_inner --}}
            
            
            {{-- paging
            <div class="text-center">
                <ul class="pagination ">
                    <li><a href="#">PREV</a></li>
                    <li><a href="#">NEXT</a></li>
                </ul>
            </div>
            end paging --}}
            
            {{-- comment --}}
            <div class="comments_list">
                
                <h4 class="white_p">Comment List</h4>
                
                {{-- addCommentArea --}}
                <button type="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#addCommentModal" style="margin-bottom:15px">Comment</button>
                    <div class="modal fade" id="addCommentModal" tabindex="-1" role="dialog" aria-labelledby="addCommentModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="addCommentModalLabel">Add Comment</h4>
                                </div>
                            
                                <div class="modal-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ action('ArticleController@commentStore') }}">
                                        {{ csrf_field() }}
                                        
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <label for="comment" class="col-md-4 control-label">Comment</label>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea class="form-control" name="comment" cols="50" rows="10" id="comment"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <input id="article_id" name="article_id" type="hidden" value="{{ $article->id }}">
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-md-10 col-md-offset-1">
                                                <input type="submit" class="btn btn-info form-control" value="Save">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end addCommentArea --}}
                
                <div class="comment">
                    <ul class="list-group">
                        @foreach($comments as $comment)
                        <li class="list-group-item">
                            <a href="{{ url('profile/' . $comment->user->username) }}">
                            <ul class="list-inline">
                                    <li><img src="data:image/jpeg;base64,{{base64_encode($comment->user->profile->img)}}" alt="profile Pic" class="img-responsive" width="20" height="20"></li>
                                    <li>{{ $comment->user->profile->last_name }}{{ $comment->user->profile->first_name }}</li>
                            </ul>
                            </a>
                            {{-- <p>投稿者：{{ $commenter_profile->last_name }}{{ $commenter_profile->middle_name }}{{ $commenter_profile->first_name }}</p> --}}
                            <ul class="list-inline">
                                <li>投稿日：</li>
                                <li>{{ $comment->created_at }}</li>
                            </ul>
                            <p class="comment_body overflow-wrap">{!! nl2br(e($comment->comment)) !!}</p>
                            
                            @if((Auth::user()->id == $article->user_id) || (Auth::user()->id == $comment->user_id))
                            <ul class="list-inline">
                                <li>
                                    <form action="{{ action('ArticleController@commentDestroy', $comment->id) }}" method="POST" style="margin-bottom:0;">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </form>
                                </li>
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- end comment --}}
        </div>
    </div>
</div>

@endsection