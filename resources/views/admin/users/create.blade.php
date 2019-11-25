@extends('layouts.admin')

@section('content')

<h1>Create User</h1>

<form method="post" action="{{route('admin.users.store')}}" enctype="multipart/form-data" >
    {{csrf_field()}} <!-- This makes a token for the form -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="role_id">Role:</label>
            <select class="form-control" id="role_id" name="role_id">
                <option value="">Choose Option</option>
                @foreach($roles as $id => $role)
                    <option value="{{$id}}">{{$role}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="is_active">Status:</label>
            <select class="form-control" id="is_active" name="is_active">
                <option value="1">Active</option>
                <option value="0" selected="selected">Not Active</option>
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
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
<br>
    @include('includes.form_error')

@stop