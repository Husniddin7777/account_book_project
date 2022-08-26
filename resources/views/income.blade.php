@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Доход') }}</div>
                        <div class="card-body">
        <form method="POST" action="{{ route('income.store') }}">
        @csrf
        @if($errors->any())
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        {{$errors->first()}}
                    </div>
                </div>
            </div>
    @endif
        @if(session('success'))
            <div class="row-justify-content-center">
                <div class="col-md-11">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                        {{session()->get('success')}}
                    </div>
                </div>
            </div>
    @endif
        <div class="form-group">
            <label for="category">Категория</label>
            <select name="category_id"
                    id="category"
                    class="form-control"
                    placeholder="Vibrate category"
                    required>
                @foreach($income_categories as $category)
                    <option value="{{ $category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <label for="sum"
                   class="col-md-4 col-form-label text-md-right">{{ __('Сумма') }}</label>
            <div class="col-md-6">
                <input id="sum" type="sum"
                       class="form-control @error('sum') is-invalid @enderror" name="sum"
                       value="{{ old('sum') }}" required autocomplete="sum">
            </div>
        </div>
        <div class="form-group row">
            <label for="comment"
                   class="col-md-4 col-form-label text-md-right">{{ __('Комментарий') }}</label>
            <div class="col-md-6">
                <input id="comment" type="comment"
                       class="form-control @error('comment') is-invalid @enderror" name="comment"
                       value="{{ old('comment') }}" required autocomplete="comment">
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="card-body">
                <a href="{{route('index.history')}}">
                    <button type="button" class="btn btn-danger">Назад</button>
                </a>
            </div>
            <div class="card-body">
                <button type="submit" class="btn btn-warning"> Сохранить </button>
            </div>
        </div>

    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
