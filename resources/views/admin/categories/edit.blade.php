@extends('layouts.admin')

@section('content')

    <h1>Categories</h1>

    <div class="col-sm-6">
        <form method="post" action="{{route('admin.categories.update', $category->id)}}" enctype="multipart/form-data" >
        {{csrf_field()}} <!-- This makes a token for the form -->
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{$category->name}}">
            </div>
            <button type="submit" class="btn btn-primary col-sm-3">Update Category</button>
        </form>

        <form method="post" action="{{route('admin.categories.destroy', $category->id)}}">
        {{csrf_field()}} <!-- This makes a token for the form -->

            <input type="hidden" name="_method" value="DELETE">

            <div class="form-group">
                <button class="btn btn-danger col-sm-3" style="margin-left: 5px">Delete Post</button>
            </div>
        </form>
    </div>

    <div class="col-sm-6">

    </div>

@endsection