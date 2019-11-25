@extends('layouts.admin')


@section('content')

    <h1>Create Post</h1>
    <div class="row">
    <form method="post" action="{{route('admin.posts.store')}}" enctype="multipart/form-data" >
    {{csrf_field()}} <!-- This makes a token for the form -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="category_id">Category:</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value="">Choose Option</option>
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
            <textarea name="body" class="form-control" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
    </div>
<br>
    <div class="row">
        @include('includes.form_error')
    </div>
@stop