@extends('layouts.app')
@section('content')
<div class="row">
    dd($post);
    <div class="col-md-12">
    @include('common.errors')
        <form action="{{ url('posts/update') }}" method="POST">
            <!-- item_name -->
            <div class="form-group">
                <label for="team_name">チーム名</label>
                <input type="text" name="team_name" class="form-control" value="{{$post->team_name}}">
            </div>
            <div class="form-group">
                <label for="team_desc">スローガン</label>
                <input type="text" name="team_desc" class="form-control" value="{{$post->team_desc}}">
            </div>
            <!--/ item_name -->
            <!-- Save ボタン/Back ボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('/') }}"> Back</a>
            </div>
            <!--/ Save ボタン/Back ボタン -->
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$post->id}}" /> <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
            <!--/ CSRF -->
        </form>
    </div>
</div>
@endsection