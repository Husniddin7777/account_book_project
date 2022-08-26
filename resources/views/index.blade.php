@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navBAR-light bg-faded">
                    <a href="{{route('income.index')}}">
                        <button type="button" class="btn btn-success">Добавить Доход</button>
                    </a>
                    <a href="{{route('filter.index')}}">
                        <button type="button" class="btn btn-dark">Фильтр</button>
                    </a>
                    <a href="{{route('outgo.index')}}">
                        <button type="button" class="btn btn-danger">Добавить Расход</button>
                    </a>
                </nav>
            </div>
        </div>
    </div>

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
@endsection
