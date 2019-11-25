@extends('layouts.blog-post')

@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->file}}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">{{$post->body}}</p>

    <hr>

    @if(Session::has('comment_message'))

        {{session('comment_message')}}

    @endif


    <!-- Blog Comments -->
@if(Auth::check()) <!--if the user is logged in, let them make a comment, otherwise not. -->
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>

        <form method="post" action="{{route('admin.comments.store')}}">
            {{csrf_field()}}

            <input type="hidden" name="post_id" value="{{$post->id}}">

            <div class="form-group">
                <label for="body">Body:</label>
                <input type="textarea" name="body" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit Comment</button>

        </form>
    </div>
@endif
    <hr>

    <!-- Posted Comments -->
@if(count($comments) > 0)
    <!-- Comment -->
    @foreach($comments as $comment)
    <div class="media">
        <a class="pull-left" href="#">
            <img height="64" class="media-object" src="{{$comment->photo}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            <p>{{$comment->body}}</p>

            @if(count($comment->replies) > 0)
                @foreach($comment->replies as $reply)

            <!-- Nested Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img height="64" class="media-object" src="{{$reply->photo}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$reply->author}}
                            <small>{{$reply->created_at->diffForHumans()}}</small>
                        </h4>
                    {{$reply->body}}
                    </div>

                    <div class="comment-reply-container">
                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                        <div class="comment-reply col-sm-6">

                            <form method="post" action="{{route('admin.comment.replies.store')}}">
                            {{csrf_field()}} <!-- This makes a token for the form -->
                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <input type="textarea" name="body" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary col-sm-6">Submit Reply</button>
                            </form>
                        </div>
                    </div>
                <!-- End Nested Comment -->
                </div>
                @endforeach
                @endif
        </div>
    </div>
    @endforeach
@endif

@stop

@section('scripts')
    <script>
        $(".comment-reply-container .toggle-reply").click(function () {
           $(this).next().slideToggle("slow");
        });
    </script>
@stop