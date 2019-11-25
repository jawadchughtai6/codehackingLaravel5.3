@extends('layouts.admin')


@section('content')

    <h1>Edit Post</h1>


    <div class="row">
        <div class="col-sm-3">
            <img src="{{$post->photo->file}}" alt="" class="img-responsive">
        </div>
        <div class="col-sm-9">
        <form method="post" action="{{route('admin.posts.update', $post->id)}}" enctype="multipart/form-data" >
        {{csrf_field()}} <!-- This makes a token for the form -->
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="{{$post->category->id}}">{{$post->category->name}}</option>
                    @foreach($categories as $id => $category)
                        <option value="{{$id}}">{{$category}}</option>
                    @endforeach


                    {{--                @foreach($roles as $id => $role)--}}
                    {{--                    <option value="{{$id}}">{{$role}}</option>--}}
                    {{--                @endforeach--}}

                </select>
            </div>
            <div class="form-group">
                <label for="photo_id">Photo:</label>
                <input type="file" name="photo_id" class="form-control">
            </div>
            <div class="form-group">
                <label for="body">Description:</label>
                <textarea name="body" class="form-control" rows="5">{{$post->body}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary col-sm-3">Update Post</button>
        </form>

        <form method="post" action="{{route('admin.posts.destroy', $post->id)}}">
        {{csrf_field()}} <!-- This makes a token for the form -->

            <input type="hidden" name="_method" value="DELETE">

            <div class="form-group">
                <button class="btn btn-danger col-sm-3" style="margin-left: 5px">Delete Post</button>
            </div>
        </form>
    </div>
    </div>
    <br>
    <div class="row">
        @include('includes.form_error')
    </div>
@stop