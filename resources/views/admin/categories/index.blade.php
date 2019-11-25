@extends('layouts.admin')

@section('content')

<h1>Categories</h1>

    <div class="col-sm-6">
        <form method="post" action="{{route('admin.categories.store')}}" enctype="multipart/form-data" >
        {{csrf_field()}} <!-- This makes a token for the form -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>

    <div class="col-sm-6">
        @if($categories)
            <table class="table">
                <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Created At</th>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
                        <td>{{$category->created_at ? $category->created_at->diffForHumans() : "No Date"}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection