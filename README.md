# Pages:
`/form` - страница аренды инвентаря
`/incomes/graphic` - График дохода 
`/incomes/employee` - График дохода от сотрудника 

# Instruction:
1) `git clone https://github.com/Reedhook/Usefulsoft.git` - клонирование проекта
2) `cd Usefulsoft` - переход в папку с проектом
3) `sudo docker compose build` - сборка проекта
4) `sudo docker compose up` - запуск контейнера
5) `sudo docker exec -it apps_app bash -c "npm run dev"` - для запуска фронта

# Ports:
1) `:8081` - порт приложения
2) `:5434` - порт базы данных

