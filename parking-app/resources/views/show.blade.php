@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-3">Все клиенты</h2>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ФИО</th>
                <th scope="col">Авто</th>
                <th scope="col">Гос. номер</th>
                <th scope="col">Продолжительность стоянки</th>
                <th scope="col">Добавить/убрать со стоянки</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            @foreach($clientsAndTheirCars as $clientAndTheirCars)
                <tr>
                    @if(isset($clientAndTheirCars->parking_time))
                        <th scope="row" style="background: green">{{$clientAndTheirCars->id}}</th>
                    @else
                        <th scope="row" style="background: red">{{$clientAndTheirCars->id}}</th>
                    @endif
                    <td>{{$clientAndTheirCars->surname}} {{$clientAndTheirCars->name}} {{$clientAndTheirCars->patronymic}}
                    </td>
                    <td>Бренд: {{$clientAndTheirCars->brand}} Модель: {{$clientAndTheirCars->model}}</td>
                    <td>{{$clientAndTheirCars->state_number}}</td>
                    @if(isset($clientAndTheirCars->parking_time))
                        <td class="text-success">
                            {{$clientAndTheirCars->parking_time}}
                        </td>
                        <td>
                            <form class="col" action="{{route('remove.from.parking',$clientAndTheirCars->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"></path>
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    @else
                        <td class="text-danger">
                            Не на парковке
                        </td>
                        <td>
                            <form class="col" action="{{route('add.to.parking',$clientAndTheirCars->id)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"></path>
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{$clientsAndTheirCars->links()}}</div>
    <div class="mt-2">
        <form id="myForm" action="{{route('check.client.cars')}}">
            <div class="form-group">
                <label for="mySelect">Выберите клиента:</label>
                <select class="form-control" id="clientId" name="clientId" onchange="redirectToSelectedPage()">
                    <option value="">Выберите клиента</option>
                    @foreach($clients as $client)
                        <option value="{{$client->id}}">{{$client->surname}} {{$client->name}} {{$client->patronymic}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-info mt-2">Перейти</button>
        </form>
    </div>
    <div class="mt-2">
        <a href="{{route('index')}}">
            <button class="btn btn-outline-info">Назад</button>
        </a>
    </div>

</div>
@endsection
