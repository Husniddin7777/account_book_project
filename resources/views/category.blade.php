@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="color: #0E0EFF">id</th>
                                <th style="color: #0E9A00">Тип</th>
                                <th style="color: #0e9a00">Имя</th>
                                <th style="color: #0E9A00">Изминение</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($categories as $category)
                             <tr>
                                <td>{{$category->id}}</td>
                                @if($category->type_id == 1)
                                    <td style="color: #8CEF74"><strong>{{'Доход'}}</strong></td>
                                @endif
                                @if($category->type_id == 2)
                                    <td style="color:#FF0000"><strong>{{'Расход'}}</strong></td>
                                 @endif
                                    <td><strong>{{$category->name}}</strong></td>
                                    <td style="color: #ff0000">
                                        <form method="POST" action="{{ route('category.delete',$category->id) }}">
                                            @csrf
                                            @method('delete')
                                            <a href="{{route('category.index')}}"><button type="submit" class="btn btn-danger">Удалить</button></a>
                                            <a href="{{route('category.edit',$category->id)}}"><button type="button" class="btn btn-warning">Изменить</button></a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
                <br>
                <a href="{{route('category.create')}}">
                   <button type="submit" class="btn btn-success">Добавить Категорию</button>
                </a>
            </div>
        </div>
    </div>

@endsection

