@extends('layouts.app')

@section('content')
    <form class="row g-2 needs-validation" action="{{route('store')}}" novalidate method="post" style="margin-left: 15%">
        @csrf
        <div>
            <h2>Клиент</h2>
        </div>
        <div class="col-md-4" style="width: 15%">
            <label for="validationCustom02" class="form-label">Имя</label>
            <input value="{{old('name')}}" type="text" class="form-control" name="name" id="validationCustom02" required>
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="valid-feedback">
                Все хорошо!
            </div>
        </div>
        <div class="col-md-4" style="width: 15%">
            <label for="validationCustom02" class="form-label">Фамилия</label>
            <input value="{{old('surname')}}" type="text" class="form-control" name="surname" id="validationCustom02" required>
            @error('surname')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="valid-feedback">
                Все хорошо!
            </div>
        </div>
        <div class="col-md-4" style="width: 15%">
            <label for="validationCustom02" class="form-label">Отчество</label>
            <input value="{{old('patronymic')}}" type="text" class="form-control" name="patronymic" id="validationCustom02" required>
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
                <input class="form-control" type="text" name="address" id="address" required>
                @error('address')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
            <div class="row-md-4" style="width: 20%">
                <label for="validationCustom02" class="form-label">Номер телефона (начинается с +7)</label>
                <input class="form-control"  type="tel" name="phone_number" pattern="^\+7\d{10}$" required>
                @error('phone_number')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
        </div>
        <div class="row-md-4">
            <label>Пол
                <select class="form-select"  name="gender">
                    <option  value="male">Мужчина</option>
                    <option  value="female">Женщина</option>
                </select>
            </label>
        </div>

        <div>
            <h2>Автомобили</h2>
        </div>
        <div>
            <div class="col-md-4" style="width: 10%">
                <label for="validationCustom02" class="form-label">Количество машин</label>
                <input   class="form-control" type="number"  min="0" max="5" name="number_cars" id="number_cars">
                <button class="btn btn-outline-success mt-1"   type="button" onclick="showForms()">Показать формы</button>
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
        </div>
        <div id="result"></div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Create</button>
        </div>
    </form>


    <script>
        function showForms() {
            var number = parseInt(document.getElementById("number_cars").value);

            var formsHTML = '';
            for (var i = 0; i < number; i++) {
                formsHTML += '<div class="col-md-4" style="width: 15%">' +
                    '<label for="validationCustom02" class="form-label">Марка</label>' +
                    '<input value="{{old('brand')}}" type="text" class="form-control" name="brand' + (i + 1) + '" id="validationCustom02" required>' +
                    '@error('brand')' +
                    '<p class="text-danger">{{$message}}</p>' +
                    '@enderror' +
                    '<div class="valid-feedback">' +
                    'Все хорошо!' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-4" style="width: 15%">' +
                    '<label for="validationCustom02" class="form-label">Модель</label>' +
                    '<input value="{{old('model')}}" type="text" class="form-control" name="model' + (i + 1) + '" id="validationCustom02" required>' +
                    '@error('model')' +
                    '<p class="text-danger">{{$message}}</p>' +
                    '@enderror' +
                    '<div class="valid-feedback">' +
                    'Все хорошо!' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-4" style="width: 15%">' +
                    '<label for="validationCustom02" class="form-label">Цвет</label>' +
                    '<input value="{{old('body_color')}}" type="text" class="form-control" name="body_color' + (i + 1) + '" id="validationCustom02" required>' +
                    '@error('body_color')' +
                    '<p class="text-danger">{{$message}}</p>' +
                    '@enderror' +
                    '<div class="valid-feedback">' +
                    'Все хорошо!' +
                    '</div>' +
                    '</div>' +
                    '<div>' +
                    '<div class="row-md-4" style="width: 20%">' +
                    '<label for="validationCustom02" class="form-label">Гос. номер</label>' +
                    '<input class="form-control" type="text" name="state_number' + (i + 1) + '" id="state_number' + (i + 1) + '" pattern="[A-Za-z]{1}\d{3}[A-Za-z]{2}\d{2}" required>' +
                    '@error('state_number')' +
                    '<p class="text-danger">{{$message}}</p>' +
                    '@enderror' +
                    '<div class="valid-feedback">' +
                    'Все хорошо!' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row-md-4">' +
                    '<label>Находится на стоянке' +
                    '<select class="form-select"  name="is_a_parking' + (i + 1) + '">' +
                    '<option  value="1">Да</option>' +
                    '<option  value="0">Нет</option>' +
                    '</select>' +
                    '</label>' +
                    '</div><br>';
            }

            document.getElementById("result").innerHTML = formsHTML;
        }
    </script>

@endsection
