# При запуске команды make, должен быть запущен docker и установлен docker compose

Находясь в корне проекта, запустите команду make
```console
 make
 ```

После выполнения приложение должно быть доступно по http://localhost:8056/

Также расчет доступен по api `POST http://localhost:8056/api/product/calculate`
Если открывать проект в phpstorm, в файле `api.http` настроены запросы для теста
