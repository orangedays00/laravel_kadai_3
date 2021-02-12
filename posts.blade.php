<!-- resources/views/posts.blade.php -->
@extends('layouts.app')
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <div class="card-title">
            投稿フォーム
        </div>
        <!-- バリデーションエラーの表示に使用-->
    	@include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
        <!-- 投稿フォーム -->
        @if( Auth::check() )
        <form action="{{ url('posts') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- 投稿のタイトル -->
            <div class="form-group">
                チーム名
                <div class="col-sm-6">
                    <input type="text" name="post_title" class="form-control">
                </div>
            </div>
            <!-- 投稿の本文 -->
            <div class="form-group">
                チームのスローガン
                <div class="col-sm-6">
                    <input type="text" name="post_desc" class="form-control">
                </div>
            </div>
            <!--　登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
        @endif
    </div>
    <!-- 全ての投稿リスト -->
    @if (count($posts) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead class="thead-dark">
                        <th class="table-name">チーム名</th>
                        <th class="table-text">スローガン</th>
                        <th class="table-redaer">リーダー</th>
                        <th class="">チーム参加</th>
                        <th class="">更新</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <!-- チーム名 -->
                                <td class="table-name">
                                    <div>{{ $post->team_name }}</div>
                                </td>
                                 <!-- チームスローガン -->
                                <td class="table-text">
                                    <div>{{ $post->team_desc }}</div>
                                </td>
				 <!-- 投稿者名の表示 -->
                                <td class="table-redaer">
                                   <div>{{ $post->user->name }}</div>
                                </td>
 				<!-- お気に入りボタン -->
                                <td class="">
                                    @if(Auth::check())
                                    	@if(Auth::id() != $post->user_id && $post->favo_user()->where('user_id',Auth::id())->exists() !== true)
                                    	<form action="{{ url('post/'.$post->id) }}" method="POST">
                                    		{{ csrf_field() }}
                                    		<button type="submit" class="btn btn-danger">
                                    		参加する
                                    		</button>
                                    	</form>
                                    	@endif
                                	@endif
                                </td>
                                <!--内容更新-->
                                <td>
                                    @if(Auth::check())
                                    	@if(Auth::id() == $post->user_id)
                                    	<form action="{{ url('postsedit/'.$post->id) }}" method="GET"> {{ csrf_field() }}
                                    	    <button type="submit" class="btn btn-primary">更新</button>
                                    	</form>
                                    	@endif
                                	@endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>		
    @endif
    @if( Auth::check() )
    	@if (count($favo_posts) > 0)
            <div class="card-body">
                <div class="card-body">
                    <table class="table table-striped task-table">
                        <!-- テーブルヘッダ -->
                        <thead>
                            <th>お気に入り一覧</th>
                            <th>&nbsp;</th>
                        </thead>
                        <!-- テーブル本体 -->
                        <tbody>
                            @foreach ($favo_posts as $favo_post)
                                <tr>
                                    <!-- 投稿タイトル -->
                                    <td class="table-text">
                                        <div>{{ $favo_post->post_title }}</div>
                                    </td>
                                     <!-- 投稿詳細 -->
                                    <td class="table-text">
                                        <div>{{ $favo_post->post_desc }}</div>
                                    </td>
                                    <!-- 投稿者名の表示 -->
                                    <td class="table-text">
                                        <div>{{ $favo_post->user->name }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>		
        @endif
    @endif
@endsection