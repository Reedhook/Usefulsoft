<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Incomes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 5px;
            margin-right: 10px;
        }
        select {
            padding: 5px;
            margin-right: 10px;
        }
        button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Employee Incomes</h1>

<!-- Форма для поиска и фильтрации -->
<form action="{{ route('income.table') }}" method="GET">
    <input type="text" name="search" placeholder="Поиск по ФИО">

    <select name="interval">
        <option value="">Весь период</option>
        <option value="week">Текущая неделя</option>
        <option value="month">Текущий месяц</option>
    </select>

    <button type="submit">Применить фильтр</button>
</form>

<!-- Таблица с доходами сотрудников -->
<table>
    <thead>
    <tr>
        <th>Дата</th>
        <th>ФИО сотрудника</th>
        <th>Доход</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($incomes as $income)
        <tr>
            <td>{{ $income->date }}</td>
            <td>{{ $income->employee->name }}</td>
            <td>{{ $income->income }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
