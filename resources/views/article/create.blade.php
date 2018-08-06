@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Article New
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('article.store') }}" method="post">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">{{ __('Title') }}:</label>
                                <input id="title" class="form-control" type="text" name="title"
                                       value="{{ old('title') }}">
                                @if($errors->has('title'))
                                    <div class="alert-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('Description') }}:</label>
                                <textarea id="description" class="form-control"
                                          name="description">{{ old('description') }}</textarea>
                                @if($errors->has('description'))
                                    <div class="alert-danger">{{ $errors->first('description') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="author_id">{{ __('Author') }}:</label>

                                <select id="author_id" name="author_id" class="form-control">
                                    <option value="">---</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ ($author->id == old('author_id')) ? 'selected' : '' }}>
                                            {{ $author->first_name }} {{ $author->last_name }}
                                        </option>
                                    @endforeach
                                </select>

                                {{--<input id="author" class="form-control" type="text" name="author"--}}
                                {{--value="{{ old('author') }}">--}}
                                @if($errors->has('author_id'))
                                    <div class="alert-danger">{{ $errors->first('author_id') }}</div>
                                @endif
                            </div>

                            <div class="form_group">
                                <label>{{ __('Categories') }}</label>
                                <br>
                                @foreach($categories as $category)
                                    <label for="category_{{ $category->id }}">
                                        <input id="category_{{ $category->id }}" type="checkbox" name="category[]"
                                               value="{{ $category->id }}"
                                                {{ (in_array($category->id, old('category', [])) ? 'checked' : '') }}
                                        > {{ $category->title }}
                                    </label>
                                    <br>
                                @endforeach
                                @if($errors->has('category'))
                                    <div class="alert-danger">{{ $errors->first('category') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>{{ __('Categories') }}</label>
                                @foreach($categories as $category)
                                    <br>
                                    <label for="category_{{ $category->id }}">
                                        <input type="checkbox" id="{{ $category->id }}" name="category[]" value="{{ $category->id }}"

                                        >
                                        {{ __($category->title) }}

                                    </label>
                                @endforeach
                            </div>


                            <div class="form-group">
                                <input class="btn btn-success" type="submit" value="{{ __('Save') }}">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
