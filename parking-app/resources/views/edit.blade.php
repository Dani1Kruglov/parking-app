@extends('layouts.app')

@section('content')
    <form class="row g-2 needs-validation" action="{{route('client.update', $client->id)}}" novalidate method="post"
          style="margin-left: 15%">
        @csrf
        @method('patch')
        <div>
            <h2>Клиент</h2>
        </div>
        <div class="col-md-4" style="width: 15%">
            <label for="validationCustom02" class="form-label">Имя</label>
            <input value="{{$client->name}}" type="text" class="form-control" name="name" id="validationCustom02"
                   required>
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="valid-feedback">
                Все хорошо!
            </div>
        </div>
        <div class="col-md-4" style="width: 15%">
            <label for="validationCustom02" class="form-label">Фамилия</label>
            <input value="{{$client->surname}}" type="text" class="form-control" name="surname" id="validationCustom02"
                   required>
            @error('surname')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="valid-feedback">
                Все хорошо!
            </div>
        </div>
        <div class="col-md-4" style="width: 15%">
            <label for="validationCustom02" class="form-label">Отчество</label>
            <input value="{{$client->patronymic}}" type="text" class="form-control" name="patronymic"
                   id="validationCustom02" required>
            @error('patronymic')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="valid-feedback">
                Все хорошо!
            </div>
        </div>
        <div>
            <div class="row-md-4" style="width: 20%">
                <label for="validationCustom02" class="form-label">Адрес</label>
                <input class="form-control" value="{{$client->address}}" type="text" name="address" id="address"
                       required>
                @error('likes')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
            <div class="row-md-4" style="width: 20%">
                <label for="validationCustom02" class="form-label">Номер телефона (начинается с +7)</label>
                <input class="form-control" value="{{$client->phone_number}}" type="tel" name="phone_number"
                       pattern="^\+7\d{10}$" required>
                @error('phone_number')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </div>
    </form>
    <form class="row g-2 needs-validation mt-1" action="{{route('cars.client.update', $client->id )}}" novalidate
          method="post" style="margin-left: 15%">
        @csrf
        @method('patch')
        <input type="hidden" name="number_cars" value="{{count($clientCars)}}">
        @for($i = 0,$iMax = count($clientCars); $i < $iMax; $i++)
            <div>
                <h2>Автомобиль</h2>
            </div>
            <input type="hidden" name="id{{$i+1}}" value="{{$clientCars[$i]->id}}">
            <div class="col-md-4" style="width: 15%">
                <label for="validationCustom02" class="form-label">Марка</label>
                <input value="{{$clientCars[$i]->brand}}" type="text" class="form-control" name="brand{{$i+1}}"
                       id="validationCustom02" required>
                @error('brand')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
            <div class="col-md-4" style="width: 15%">
                <label for="validationCustom02" class="form-label">Модель</label>
                <input value="{{$clientCars[$i]->model}}" type="text" class="form-control" name="model{{$i+1}}"
                       id="validationCustom02" required>
                @error('model')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
            <div class="col-md-4" style="width: 15%">
                <label for="validationCustom02" class="form-label">Цвет</label>
                <input value="{{$clientCars[$i]->body_color}}" type="text" class="form-control" name="body_color{{$i+1}}"
                       id="validationCustom02" required>
                @error('body_color')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
            <div>
                <div class="row-md-4" style="width: 20%">
                    <label for="validationCustom02" class="form-label">Гос. номер</label>
                    <input value="{{$clientCars[$i]->state_number}}" class="form-control" type="text" name="state_number{{$i+1}}"
                           id="state_number" pattern="[A-Za-z]{1}\d{3}[A-Za-z]{2}\d{2}" required>
                    @error('state_number')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    <div class="valid-feedback">
                        Все хорошо!
                    </div>
                </div>
            </div>
            <div class="row-md-4">
                <label>Находится на стоянке
                    <select class="form-select" name="is_a_parking{{$i+1}}">
                        <option {{$clientCars[$i]->is_a_parking === 1 ? ' selected' : ''}} value="true">Да</option>
                        <option {{$clientCars[$i]->is_a_parking === 0 ? ' selected' : ''}} value="false">Нет</option>
                    </select>
                </label>
            </div>
        @endfor
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Сохранить</button>
        </div>
    </form>
    <form class="row g-2 needs-validation mt-1" action="{{route('add.car.client', $client->id)}}" novalidate method="post"  style="margin-left: 15%">
        @csrf
        <div>
            <h2>Добавить новую машину</h2>
        </div>
        <div class="col-md-4" style="width: 15%">
            <label for="validationCustom02" class="form-label">Марка</label>
            <input type="text" class="form-control" name="brand" id="validationCustom02" required>
            @error('brand')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="valid-feedback">
                Все хорошо!
            </div>
        </div>
        <div class="col-md-4" style="width: 15%">
            <label for="validationCustom02" class="form-label">Модель</label>
            <input type="text" class="form-control" name="model" id="validationCustom02" required>
            @error('model')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="valid-feedback">
                Все хорошо!
            </div>
        </div>
        <div class="col-md-4" style="width: 15%">
            <label for="validationCustom02" class="form-label">Цвет</label>
            <input type="text" class="form-control" name="body_color" id="validationCustom02" required>
            @error('body_color')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="valid-feedback">
                Все хорошо!
            </div>
        </div>
        <div>
            <div class="row-md-4" style="width: 20%">
                <label for="validationCustom02" class="form-label">Гос. номер</label>
                <input class="form-control" type="text" name="state_number" id="state_number"
                       pattern="[A-Za-z]{1}\d{3}[A-Za-z]{2}\d{2}" required>
                @error('state_number')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
        </div>
        <div class="row-md-4">
            <label>Находится на стоянке
                <select class="form-select" name="is_a_parking">
                    <option value="true">Да</option>
                    <option value="false">Нет</option>
                </select>
            </label>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Добавить</button>
        </div>
    </form>

@endsection
