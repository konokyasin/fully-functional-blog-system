@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Posts</div>
        <div class="card-body">
           @if($posts->count() > 0)
                <table class="table">
                    <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src="{{ URL::to('storage/'.$post->image) }}" alt="No Picture" style="width: 100px; height: 70px;">
                            </td>
                            <td>
                                {{ $post->title }}
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $post->category->id) }}">
                                    {{ $post->category->name }}
                                </a>
                            </td>
                            @if($post->trashed())
                            <td>
                                <form action="{{ route('restore-posts', $post->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info btn-sm text-white">Restore</button>
                                </form>
                            </td>
                            @else
                                <td>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm text-white">Edit</a>
                                </td>
                            @endif
                            <td>
                                <form action="{{ route('posts.destroy', $post->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
               <h4 class="text-danger text-center">No Post Available</h4>
            @endif
        </div>
    </div>
@endsection
