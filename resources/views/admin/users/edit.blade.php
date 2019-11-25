@extends('layouts.admin')

@section('content')

<h1>Edit User</h1>

<div class="row">
<div class="col-sm-3">
    <img src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt="" class="img-responsive img-rounded">
</div>

<div class="col-sm-9">
    <form method="post" action="{{route('admin.users.update', $user->id)}}" enctype="multipart/form-data" >
    {{csrf_field()}} <!-- This makes a token for the form -->

        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <label for="role_id">Role:</label>
            <select class="form-control" id="role_id" name="role_id">
                <option value="">{{$user->role->name}}</option>
                @foreach($roles as $id => $role)
                    <option value="{{$id}}">{{$role}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="is_active">Status:</label>
            <select class="form-control" id="is_active" name="is_active">
                @if($user->is_active == 1)
                    <option value="1" selected="selected">Active</option>
                    <option value="0">Not Active</option>
                @else
                    <option value="1">Active</option>
                    <option value="0" selected="selected">Not Active</option>
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="photo_id">File:</label>
            <input type="file" name="photo_id" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary col-sm-3">Create User</button>
    </form>

    <form method="post" action="{{route('admin.users.destroy', $user->id)}}">
    {{csrf_field()}} <!-- This makes a token for the form -->

        <input type="hidden" name="_method" value="DELETE">

        <div class="form-group">
            <button class="btn btn-danger col-sm-3" style="margin-left: 5px">Delete User</button>
        </div>
    </form>

    <br>
</div>
</div>

<div class="row">
    @include('includes.form_error')
</div>
@stop