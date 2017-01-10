@extends('layouts.app')

@section('content')
<div class="container">
    <div class="rows">
        <div class="col-md-3 col-xs-12 panel-back">
            <div class="col-xs-12 col-md-12">
                <div style="margin:10px 0;">
                    {{-- userInfo(icon/userName) --}}
                    <div class="userInfoArea">
                        <ul class="list-group list-unstyled text-center">
                            <li class="list-group-item">
                                <img class="center-block img-responsive" src="data:image/jpeg;base64,{{ base64_encode($profile['img']) }}"></li>
                            <li class="list-group-item">{{ $profile->last_name . ' ' . $profile->first_name . ' ' .$profile->middle_name }}</li>
                            <li class="list-group-item">投稿数：{{ $articles->count() }}</li>
                        </ul>
                    </div>
                    {{-- END userInfo(icon/userName) --}}
                
                
                    {{-- addModal --}}
                    <div class="poster">
                        @if(Auth::user()->id == $user->id)
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
                                                
                                                {{-- <div class="form-group">
                                                    <div class="col-md-4">
                                                        <input type="button" class="btn btn-info form-control" value="">
                                                    </div>
                                                </div> --}}
                                                
                                                <div class="form-group">
                                                    <div class="col-md-8">
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
            @if(count($articles) > 0)
            {{-- content --}}
                <ul class="list-group">
                @foreach($articles as $article)
                    <li class="list-group-item panel-back blog">
                        <div class="panel-trans">
                            <h2 class="overflow-wrap"><a href="{{ action('ArticleController@showDetail', $article->id) }}">{{ $article->title }}</a></h2>
                            <ul class="list-inline">
                                <li>投稿日：</li>
                                <li>{{ $article->created_at }}</li>
                            </ul>
                            <ul class="list-inline">
                                <li>更新日：</li>
                                <li>{{ $article->updated_at }}</li>
                            </ul>
                        @if(Auth::user()->id == $user->id)
                            <ul class="list-inline">
                                <li>
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
                                        <form action="{{ action('ArticleController@destroy', $article->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </li>
                @endforeach
                </ul>
            {{-- END content --}}
            @else
                <div class="panel-back blog">
                    <div class="panel-trans">
                        <h3 class="text-center">投稿はありません。</h3>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection