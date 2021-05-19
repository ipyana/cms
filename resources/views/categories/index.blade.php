@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
</div>
<div class="card card-default">
    <div class="card-header"> Categories </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Action</th>
            </thead>

            <tbody> 
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category-> name }}</td>
                    <td> <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm"> Edit </a>
                    <button onclick="$('#f{{ $category->id }}').submit()" type="button" class="btn btn-danger btn-sm"> Delete </button>
                    <form action="{{ route('categories.destroy', $category->id) }}" id="f{{ $category->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                    </td>  
                </tr>
            @endforeach 
            </tbody>

        </table>
    </div>
</div>
 
@endsection