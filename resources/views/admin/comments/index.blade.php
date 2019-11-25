@extends('layouts.admin')

    @section('content')

        @if($comments->count() > 0)
            <h1>Comments</h1>
            <table class="table">
                <thead>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Body</th>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{$comment->author}}</td>
                            <td>{{$comment->email}}</td>
                            <td>{{$comment->body}}</td>
                            <td><a href="{{route('home.post', $comment->post->id)}}">View Post</a></td>
                            <td><a href="{{route('admin.comment.replies.show', $comment->id)}}">View Replies</a></td>

                            <td>
                                @if($comment->isActive == 1)
                                    <form method="post" action="{{route('admin.comments.update', $comment->id)}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="isActive" value="0">
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning btn-sm">Un-Approve</button>
                                        </div>


                                    </form>

                                    @else

                                    <form method="post" action="{{route('admin.comments.update', $comment->id)}}">
                                        {{csrf_field()}}
                                        <input type="hidden" name="isActive" value="1">
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                                        </div>
                                    </form>
                                @endif
                            </td>

                            <td>
                                <form method="post" action="{{route('admin.comments.destroy', $comment->id)}}">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h1 class="text-center">No Comments</h1>
        @endif

@stop