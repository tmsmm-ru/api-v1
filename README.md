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
        'timeStart' => '', // отложенный запуск, пустой параметр - нет или 31.12.2024 23:00 - формат передачи date_format:"d.m.Y G:i"
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
                            [uniqid] => 65705df17fba6
                            [name] => Имя заказа
                            [telegram_id] => 1110232211
                            [telegram_type] => 1
                            [telegram_uri] => @username
                            [telegram_uri_type] => 1
                            [telegram_title] => Name channel
                            [last_time_run] => 2023-12-06 14:46:30
                            [country] => 1
                            [sex] => 0
                            [speed] => 1
                            [count] => 13
                            [count_done] => 3
                            [pause] => 0
                            [status] => 3
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
