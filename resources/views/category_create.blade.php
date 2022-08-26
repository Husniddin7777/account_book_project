@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Добавить категорию') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('category.store')}}">
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
                                <label for="type">Тип</label>
                                <select name="type_id"
                                        id="type"
                                        class="form-control"
                                        placeholder="Vibrate category"
                                        required>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="name"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="card-body">
                                    <a href="{{route('index.history')}}">
                                        <button type="button" class="btn btn-danger">Назад</button>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <button type="submit" class="btn btn-warning">Сохранить</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
