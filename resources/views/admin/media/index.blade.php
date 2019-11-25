@extends('layouts.admin')

@section('content')

    <h1>Media</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td><img height="50" src="{{$photo->file}}" alt=""></td>
                    <td>{{$photo->created_at ? $photo->created_at : 'No Date'}}</td>
                    <td>
                        <form method="post" action="{{route('admin.media.destroy', $photo->id)}}">
                        {{csrf_field()}} <!-- This makes a token for the form -->

                            <input type="hidden" name="_method" value="DELETE">

                            <div class="form-group">
                                <button class="btn btn-danger btn-sm col-sm-3" style="margin-left: 5px">Delete Photo</button>
                            </div>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

@stop