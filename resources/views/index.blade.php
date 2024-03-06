@extends('app')


@section('content')
    <div class="container">
        <button id="showEmployee">Выбрать сотрудника</button>
        <button id="showInventory">Посмотреть инвентарь</button>
        <button id="showClient">Посмотреть клиентов</button>
    </div>
    <div class="container">
        <div id="employee"></div>
        <div id="inventory"></div>
        <div id="client"></div>
        <input type="radio" id="day" name="duration" value="day">Сутки
        <input type="radio" id="week" name="duration" value="week">Неделя
        <button id="sendData">Отправить данные</button>
    </div>
@endsection

@section('scripts')

@endsection

