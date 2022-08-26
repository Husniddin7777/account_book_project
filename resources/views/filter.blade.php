@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navBAR-light bg-faded">
                    <a href="{{route('income.index')}}">
                        <button type="button" class="btn btn-success">Добавить Доход</button>
                    </a>
                    <a href="{{route('outgo.index')}}">
                        <button type="button" class="btn btn-danger">Добавить Расход</button>
                    </a>
                </nav>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ __('Фильтр') }}</div>
                                <div class="card-body">
                                    <form method="POST" action="{{route('answer')}}">
                                        @csrf
                                        @method('post')
                                        <div class="row">
                                            <div class="col-md-6"><h4>C</h4></div>
                                            <div class="col-md-6"><h4>До</h4></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input id="from" type="date"
                                                       class="form-control @error('from') is-invalid @enderror"
                                                       name="from" min="2022-01-01" max="{{$dt->format('Y-m-d')}}"
                                                       value="{{ old('from') }}" required autocomplete="from">

                                                @error('from')
                                                <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <input id="to" type="date"
                                                       class="form-control @error('to') is-invalid @enderror"
                                                       name="to" min="2022-01-01" max="{{$dt->format('Y-m-d')}}"
                                                       value="{{ old('to') }}" required autocomplete="to">

                                                @error('to')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="type_id"><h4>Tип</h4></label>
                                                <select name="type_id"
                                                        id="type_id"
                                                        class="form-control"
                                                        placeholder="type_id"
                                                        required>
                                                    @foreach($types as $type)
                                                        <option value="{{ $type->id}}">{{$type->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="card-body">
                                                <a href="{{route('index.history')}}">
                                                    <button type="button" class="btn btn-danger">Назад</button>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <button type="submit" class="btn btn-warning">Фильтровать</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="color: #0E0EFF">Тип</th>
                                <th style="color: #0E9A00">Категория</th>
                                <th style="color: #0e9a00">Дата</th>
                                <th style="color: #0E9A00">Cумма</th>
                                <th style="color: #0E9A00">Комментарий</th>
                                <th style="color: #0E9A00">Пользователь</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($histories as $history)
                                @php /**@var \App\Models\BlogCategory $item */ @endphp
                                <tr>
                                    <td>{{$history->type->name}}</td>
                                    @if($history->type->id == 1)
                                        <td style="color: #8CEF74"><strong>{{$history->category->name}}</strong></td>
                                    @else
                                        <td style="color: #ff0000">{{$history->category->name}}</td>
                                    @endif
                                    <td>{{$history->created_at}}</td>
                                    <td><strong>{{number_format("$history->sum",2,"."," ")}}</strong></td>
                                    @if($history->type->id == 1)
                                        <td style="color: #8CEF74">{{$history->comment}}</td>
                                    @else
                                        <td style="color: #ff0000">{{$history->comment}}</td>
                                    @endif
                                    <td><strong>{{$history->user->name}}</strong></td>
                                </tr>
                            @endforeach
                            <table class="table table-hover">
                                <tr>
                                    <th style="color: #0E9A00">Общий доход</th>
                                    <td style="color: #8CEF74"><strong>{{number_format("$income",2,"."," ")}}</strong></td>
                                </tr>
                                <tr>
                                    <th style="color: #0E9A00">Общее расход</th>
                                    <td style="color: #ff0000"><strong>{{number_format("$outgo",2,"."," ")}}</strong></td>
                                </tr>
                                <tr>
                                    <th style="color: #0E9A00">Оставшийся сумма </th>
                                    <td style="color: #0E0EFF"><strong>{{number_format("$total",2,"."," ")}}</strong></td>
                                </tr>
                            </table>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

