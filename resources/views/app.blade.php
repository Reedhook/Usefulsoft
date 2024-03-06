<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
<div id="app" class="m-lg-2">
    @yield('content')

</div>
</body>
<script>
    // Массив для хранения данных элементов и состояния чекбоксов
    var inventoryData = [];
    var selectedInventoryIndex = null;

    // Функция для отображения инвентаря
    function renderInventoryItems(data) {
        var resultElement = document.getElementById('inventory');
        resultElement.innerHTML = ''; // Очистить содержимое перед отрисовкой

        data.forEach(function(item, index) {
            if (item.status === 'свободен') {
                var checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.checked = (selectedInventoryIndex === index);
                checkbox.addEventListener('change', function() {
                    selectedInventoryIndex = index;
                    renderInventoryItems(data);
                });

                var label = document.createElement('label');
                label.textContent = item.name;

                var itemElement = document.createElement('div');
                itemElement.appendChild(checkbox);
                itemElement.appendChild(label);

                resultElement.appendChild(itemElement);
            }
        });
    }

    // Массив для хранения данных сотрудников и состояния чекбоксов
    var employeeData = [];
    var selectedEmployeeIndex = null;

    // Функция для отображения сотрудников
    function renderEmployeeItems(data) {
        var resultElement = document.getElementById('employee');
        resultElement.innerHTML = ''; // Очистить содержимое перед отрисовкой

        data.forEach(function(item, index) {
            var checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.checked = (selectedEmployeeIndex === index);
            checkbox.addEventListener('change', function() {
                selectedEmployeeIndex = index;
                renderEmployeeItems(data);
            });

            var label = document.createElement('label');
            label.textContent = item.name;

            var itemElement = document.createElement('div');
            itemElement.appendChild(checkbox);
            itemElement.appendChild(label);

            resultElement.appendChild(itemElement);
        });
    }
    // Массив для хранения данных сотрудников и состояния чекбоксов
    var clientData = [];
    var selectedClientIndex = null;

    // Функция для отображения сотрудников
    // Функция для отображения клиентов
    function renderClientItems(data) {
        var resultElement = document.getElementById('client');
        resultElement.innerHTML = ''; // Очистить содержимое перед отрисовкой

        data.forEach(function(item, index) {
            var checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.checked = (selectedClientIndex === index);
            checkbox.addEventListener('change', function() {
                selectedClientIndex = index;
                renderClientItems(data);
            });

            var label = document.createElement('label');
            label.textContent = item.first_name;

            var itemElement = document.createElement('div');
            itemElement.appendChild(checkbox);
            itemElement.appendChild(label);

            resultElement.appendChild(itemElement);
        });
    }

    // Кнопка для выбора клиентов
    // Кнопка для выбора сотрудника
    document.getElementById('showEmployee').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost:8081/api/employees', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    employeeData = response.body.employees;
                    renderEmployeeItems(employeeData);
                } else {
                    console.error('Произошла ошибка при выполнении AJAX запроса');
                }
            }
        };
        xhr.send();
    });

    // Кнопка для просмотра клиентов
    document.getElementById('showClient').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost:8081/api/clients', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    clientData = response.body.clients;
                    renderClientItems(clientData);
                } else {
                    console.error('Произошла ошибка при выполнении AJAX запроса');
                }
            }
        };
        xhr.send();
    });

    // Кнопка для выбора инвентаря
    document.getElementById('showInventory').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost:8081/api/inventories', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    inventoryData = response.body.inventories;
                    renderInventoryItems(inventoryData);
                } else {
                    console.error('Произошла ошибка при выполнении AJAX запроса');
                }
            }
        };
        xhr.send();
    });

    // Функция для отправки данных на сервер
    document.getElementById('sendData').addEventListener('click', function() {
        var selectedEmployee = employeeData[selectedEmployeeIndex];
        var selectedInventory = inventoryData[selectedInventoryIndex];
        var selectedClient = clientData[selectedClientIndex];
        var selectedDuration = document.querySelector('input[name="duration"]:checked').value;

        if (selectedEmployee && selectedInventory && selectedClient && selectedDuration) {
            var userData = {
                employee_id: selectedEmployee.id,
                inventory_id: selectedInventory.id,
                client_id: selectedClient.id,
                price_day: selectedDuration === 'day'?1:0
            };

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://localhost:8081/api/rents', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log('Данные успешно отправлены на сервер');
                    } else {
                        console.error('Произошла ошибка при выполнении AJAX запроса');
                    }
                }
            };
            xhr.send(JSON.stringify(userData));
        } else {
            alert('Пожалуйста, выберите сотрудника, инвентарь, клиента и длительность аренды');
        }
    });



</script>
</html>
