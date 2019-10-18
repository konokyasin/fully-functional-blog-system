@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">{{ isset($post) ? 'Edit Post' : 'Create Post' }}</div>
        @include('partials.errors')
        <div class="card-body">
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ isset($post) ? $post->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ isset($post) ? $post->description : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="contents">Content</label>
                    <input id="contents" type="hidden" name="contents" value="{{ isset($post) ? $post->contents : '' }}">
                    <trix-editor input="contents"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" class="form-control" name="published_at" id="published_at" value="{{ isset($post) ? $post->published_at : '' }}">
                </div>
                @if(isset($post))
                    <div class="form-group">
                        <img src="{{ URL::to('storage/'.$post->image) }}" alt="" style="width: 100%;">
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                               @if(isset($post))
                               @if($category->id === $post->category_id)
                               selected
                                @endif
                                   @endif
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if($tags->count() > 0)
                    <div class="form-group">
                        <label for="tags">Tags</label>
                            <select name="tags[]" id="tags" class="form-control tags" multiple>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                            @if(isset($post))
                                                @if($post->hasTag($tag->id))
                                                    selected
                                                @endif
                                            @endif
                                    >
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                    </div>
                @endif

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        {{ isset($post) ? 'Update Post' : 'Create Post' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.11/css/select2.min.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.11/js/select2.min.js"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true,
            enableSeconds: true
        });

        $(document).ready(function() {
            $('.tags').select2();
        });
    </script>
@endsection
