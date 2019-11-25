@extends('layouts.admin')

@section('content')

    @if($replies)
        <h1>replies</h1>
        <table class="table">
            <thead>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
            </thead>
            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->body}}</td>
                    <td><a href="{{route('home.post', $reply->comment->post->id)}}">View Post</a></td>

                    <td>
                        @if($reply->isActive == 1)
                            <form method="post" action="{{route('admin.comment.replies.update', $reply->id)}}">
                                {{csrf_field()}}
                                <input type="hidden" name="isActive" value="0">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning btn-sm">Un-Approve</button>
                                </div>
                            </form>
                        @else
                            <form method="post" action="{{route('admin.comment.replies.update', $reply->id)}}">
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
                        <form method="post" action="{{route('admin.comment.replies.destroy', $reply->id)}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </form>
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    @else
        <h1 class="text-center">No Replies</h1>
    @endif
@stop