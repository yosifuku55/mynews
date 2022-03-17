@extends('layouts.front')

@section('content')
    <div class="container">
        <hr color="(#c0c0c0)">
        @if (!is_null($headline))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <p class="name mx-auto">{{ str_limit($headline->name, 650) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="gender mx-auto">{{ str_limit($headline->gender, 650) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="hobby mx-auto">{{ str_limit($headline->hobby, 650) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="introduction mx-auto">{{ str_limit($headline->introduction, 650) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr color="(#c0c0c0)">
        <div class="row">
            <div class="posts col-md-10 mx-auto">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="col-md-6">
                                    <p class="name mx-auto">{{ str_limit($post->name, 650) }}</p>
                                </div>
                            <div class="col-md-6">
                                <p class="gender mx-auto">{{ str_limit($post->gender, 650) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="hobby mx-auto">{{ str_limit($post->hobby, 650) }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="introduction mx-auto">{{ str_limit($post->introduction, 650) }}</p>
                            </div>
                            </div>
                        </div>
                    </div>
            <hr color="(#c0c0c0)">
                @endforeach
            </div>
        </div>
    </div>
@endsection