# Документация к TmSMM API для работы с многофункциональными услугами для Telegram

Получить Class PHP для работы с API можно по ссылке: https://github.com/tmsmm-ru/api-v1/blob/main/TmSMMApiV1.php


## #Баланс аккаунта

### Пример запроса

```php
    <?php

    $token = '';

    $oTmSMM = new TmSMMApiV1($token);

    $oTmSMM->getProfile();
```

### Пример ответа

```
Array
(
    [response] => Array
        (
            [success] => Array
                (
                    [code] => 1
                    [data] => Array
                        (
                            [email] => name@email.com
                            [balance] => Array
                                (
                                    [amount] => 12398.61
                                    [currency] => RUB
                                )

                        )

                )

        )

)
```

## #Создание заказа на подписчиков в Telegram

### Пример запроса

```php
    <?php

    $token = '';

    $oTmSMM = new TmSMMApiV1($token);

    $oTmSMM->createTaskT1([
        'name'    => '', // имя заказа, необязательно
        'channel' => 'https://t.me/username', // ссылка на канал или группу, пример: https://t.me/username или https://t.me/+aH1HSam3SF85ZQEu
        'country' => 0, // cтрана подписчиков, 0 - любая, 1 - Россия или 2 - англоязычные
        'sex'     => 0, // пол подписчиков, 0 - любой, 1 - женский или 2 - мужской
        'count'   => 10, // количество выполнений
        'speed'   => 1, // скорость накрутки, 0 - низкая, 1 - средняя, 2 - высокая, 3 - очень низкая или  4 - очень высокая
        'checkViewPosts' => 1, // просмотр постов при подписке, 0 - нет или 1 - просмотр 10 постов (новых)
        'timeStart' => '', // отложенный запуск, пустой параметр - нет или '31.12.2024 23:00' - формат передачи date_format:"d.m.Y G:i"
    ]);
```

### Пример ответа

```
Array
(
    [response] => Array
        (
            [success] => Array
                (
                    [code] => 1
                    [data] => Array
                        (
                            [id] => 65a14353965b7
                        )

                )

        )

)
```

## #Получение информации о заказе на подписчиков в Telegram

### Пример запроса

```php
    <?php

    $token = '';

    $oTmSMM = new TmSMMApiV1($token);

    $oTmSMM->getTaskT1('65a14353965b7'); // передавать id заказа
```

### Пример ответа

```
Array
(
    [response] => Array
        (
            [success] => Array
                (
                    [code] => 1
                    [data] => Array
                        (
                            [uniqid] => 65705df17fba6 // id заказа
                            [name] => Имя заказа // имя заказа
                            [telegram_id] => 1110232211 // внутрений id в Telegram
                            [telegram_type] => 1 // тип объекта, 1 - канал или 2 - группа
                            [telegram_uri] => @username // username
                            [telegram_uri_type] => 1 // тип ссылки 1 - открытый объект или 2,3 - закрытый объект
                            [telegram_title] => Name channel // имя объекта в Telegram
                            [last_time_run] => 2023-12-06 14:46:30 // время последнего выполнения
                            [country] => 1 // страна подписчиков
                            [sex] => 0 // пол подписчиков
                            [speed] => 1 // скорость накрутки
                            [count] => 13 // заказанное количество выполнений
                            [count_done] => 3 // текущее количество выполнений
                            [time_start] => '31.12.2024 23:00' // отложенный запуск
                            [pause] => 0 // пауза
                            [status] => 3 // статус заказа
                        )

                )

        )

)
```

## #Пауза заказа на подписчиков в Telegram

### Пример запроса

```php
    <?php

    $token = '';

    $oTmSMM = new TmSMMApiV1($token);

    $oTmSMM->pauseTaskT1([
         'id'     => '65a14353965b7',
         'status' => 1 // установка паузы, 0 - снять с паузы или 1 - установить паузу
    ]);
```

### Пример ответа

```
Array
(
    [response] => Array
        (
            [success] => Array
                (
                    [code] => 1
                    [data] => Array
                        (
                        )

                )

        )

)
```

## #Удаление заказа на подписчиков в Telegram

### Пример запроса

```php
    <?php

    $token = '';

    $oTmSMM = new TmSMMApiV1($token);

    $oTmSMM->deleteTaskT1('65a14353965b7'); // передавать id заказа
```

### Пример ответа

```
Array
(
    [response] => Array
        (
            [success] => Array
                (
                    [code] => 1
                    [data] => Array
                        (
                        )

                )

        )

)
```


## #Создание заказа на просмотры в Telegram

### Пример запроса

```php
    <?php

    $token = '';

    $oTmSMM = new TmSMMApiV1($token);

    // заказ на разовое выполнения просмотров
    $oTmSMM->createTaskT2([
        'name'       => '', // имя заказа, необязательно
        'channel'    => 'https://t.me/username', // ссылка на канал или группу, пример: https://t.me/username или https://t.me/+aH1HSam3SF85ZQEu
        'mode'       => 0, // режим просмотров записей, 0 - разовое, 2 - автопросмотры на новые записи
        'countView'  => 100, // количество выполнений
        'speed'      => 1, // скорость накрутки, 0 - низкая, 1 - средняя, 2 - высокая, 3 - очень низкая или 4 - очень высокая
        'recordType' => 1, // выбор просмотра записей, 0 - первые 10 записей (новые), 1 - указать номера записей, 4 - первая запись (новая) или 5 - Telegraph (telegra.ph)
        'recordIDs'  => '1,2,3', // номера записей, указывать через запятую, если установлен "recordType=1" в ином случае оставить поле пустым
        'timeStart'  => '', // отложенный запуск, пустой параметр - нет или '31.12.2024 23:00' - формат передачи date_format:"d.m.Y G:i"
    ]);

    // заказ на автопросмотры на новые записи
    $oTmSMM->createTaskT2([
        'name'              => '', // имя заказа, необязательно
        'channel'           => 'https://t.me/username', // ссылка на канал или группу, пример: https://t.me/username или https://t.me/+aH1HSam3SF85ZQEu
        'mode'              => 2, // режим просмотров записей, 0 - разовое, 2 - автопросмотры на новые записи
        'countView'         => 100, // количество выполнений
        'speed'             => 1, // скорость накрутки, 0 - низкая, 1 - средняя, 2 - высокая, 3 - очень низкая или 4 - очень высокая
        'countDay'          => 14, // длительность подписки, 7, 14 или 30 дней
        'viewStartNewPosts' => 1, // начать просмотры с новой записи (через 15 мин., после создания заказа), 1 - включить или 0 - отключить (тогда возьмутся 10 имеющихся записей)
        'viewAccuracy'      => 5, // погрешность просмотров ±, от 0 до 20 процентов 
        'timeStart'         => '', // отложенный запуск, пустой параметр - нет или '31.12.2024 23:00' - формат передачи date_format:"d.m.Y G:i"
    ]);
```

### Пример ответа

```
Array
(
    [response] => Array
        (
            [success] => Array
                (
                    [code] => 1
                    [data] => Array
                        (
                            [id] => 65a14353965b7
                        )

                )

        )

)
```

## #Получение информации о заказе на просмотры в Telegram

### Пример запроса

```php
    <?php

    $token = '';

    $oTmSMM = new TmSMMApiV1($token);

    $oTmSMM->getTaskT2('65a14353965b7'); // передавать id заказа
```

### Пример ответа

```
Array
(
    [response] => Array
        (
            [success] => Array
                (
                    [code] => 1
                    [data] => Array
                        (
                            [uniqid] => 65a27d708999e // id заказа
                            [name] => Имя заказа // имя заказа
                            [telegram_id] => 1110232211 // внутрений id в Telegram
                            [telegram_title] => Name channel // имя объекта в Telegram
                            [telegram_uri] => @username // username
                            [telegram_uri_type] => 1 // тип ссылки 1 - открытый объект или 2,3 - закрытый объект
                            [last_time_run] => 2023-12-06 14:46:30 // время последнего выполнения
                            [speed] => 1 // скорость накрутки
                            [auto_view] => 0 // режим просмотров записей, 0 - разовое, 2 - автопросмотры на новые записи
                            [auto_view_accuracy] => 0 // погрешность просмотров ±, от 0 до 20 процентов 
                            [count_view] => 100 // заказанное количество выполнений
                            [count_view_done] => 0 // текущее количество выполнений
                            [count_day] => 1 // длительность подписки, 7, 14 или 30 дней
                            [time_start] => '31.12.2024 23:00' // отложенный запуск
                            [pause] => 0 // пауза
                            [status] => 0 // статус
                        )

                )

        )

)
```

## #Пауза заказа на просмотры в Telegram

### Пример запроса

```php
    <?php

    $token = '';

    $oTmSMM = new TmSMMApiV1($token);

    $oTmSMM->pauseTaskT2([
         'id'     => '65a14353965b7',
         'status' => 1 // установка паузы, 0 - снять с паузы или 1 - установить паузу
    ]);
```

### Пример ответа

```
Array
(
    [response] => Array
        (
            [success] => Array
                (
                    [code] => 1
                    [data] => Array
                        (
                        )

                )

        )

)
```

## #Удаление заказа на просмотры в Telegram

### Пример запроса

```php
    <?php

    $token = '';

    $oTmSMM = new TmSMMApiV1($token);

    $oTmSMM->deleteTaskT2('65a14353965b7'); // передавать id заказа
```

### Пример ответа

```
Array
(
    [response] => Array
        (
            [success] => Array
                (
                    [code] => 1
                    [data] => Array
                        (
                        )

                )

        )

)
