@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('posts.create') }}" class="btn btn-success">New post</a>
</div>

<div class="card card-default">
    <div class="card-header"> Posts </div>
    <div class="card-body">
        
        @empty($posts->count())
            <h3 class="text-center">No post available!</h3>
        @endempty

        <table class="table">
            @foreach ($posts as $post)
                <tr>
                    <td>
                        <img src="{{ asset('storage/'.$post->image)}}" alt="" width="80px" height="50px">
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>
                        @if (!$post->trashed())
                        <a href="" class="btn btn-primary btn-sm" >edit</a>   
                        @endif
                    </td>

                    <td>
                      <button onclick="$('#delete{{ $post->id }}').submit()" type="button" class="btn btn-danger btn-sm">{{ $post->trashed() ? 'Delete' : 'Trash' }}</button>
                        <form action="{{ route('posts.destroy', $post->id) }}" id="delete{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>

{{--                         <form action="{{ route('posts.destroy', $post->id) }}" class="form" method="POST">
                            @csrf
                            @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">{{ $post->trashed() ? 'Delete' : 'Trash' }}</button>
                        
                        </form>
 --}}
                    </td>  
                </tr>
            @endforeach
        </table>
    </div>
</div>
 
@endsection