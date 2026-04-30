# Отчёт по лабораторной работе №8
## Переход с JSON на реляционную базу данных (PDO, CRUD)
## Цель работы

Перенести хранение данных проекта с файла data.json на реляционную базу данных с использованием PDO, реализовать CRUD-операции и обеспечить безопасность работы с БД.

### Шаг 1. Создание базы данных

Была создана база данных recipes_db со следующими таблицами:
```sql
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    prep_time INT,
    difficulty VARCHAR(50),
    created_at DATE,
    author VARCHAR(100),
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);
```

 Связь: один ко многим

одна категория → много рецептов
### Шаг 2. Подключение к базе данных

Создан класс Database, реализующий подключение через PDO:
```php
class Database
{
    public static function connect(): PDO
    {
        $config = require __DIR__ . '/../config.php';

        return new PDO(
            "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
            $config['user'],
            $config['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }
}
```

Параметры подключения вынесены в config.php.

### Шаг 3. Реализация CRUD-операций

В файле functions.php реализованы функции:

createRecord($data) — добавление записи
getAllRecords() — получение всех записей
getRecordById($id) — получение записи по ID
updateRecord($id, $data) — обновление записи
deleteRecord($id) — удаление записи
searchRecords($query) — поиск (опционально)

 Все запросы выполнены с использованием подготовленных выражений (prepared statements).

### Шаг 4. Обновление интерфейса
Страница списка (index.php)
отображает все записи
кнопка Редактировать → edit.php?id=X
кнопка Удалить → POST-форма
Страница редактирования (edit.php)
загружает данные записи
отображает форму с текущими значениями
после отправки обновляет запись и делает редирект:
header('Location: index.php');
exit;
### Шаг 5. Безопасность
Использованы prepared statements → защита от SQL-инъекций
Проверка и валидация входных данных

### Контрольные вопросы

1. Что такое PDO и чем он отличается от mysqli_*?
PDO — это универсальный интерфейс для работы с разными СУБД, тогда как mysqli работает только с MySQL.

2. Что такое подготовленные выражения и зачем они нужны?
Подготовленные выражения — это способ выполнения SQL-запросов с параметрами, который защищает от SQL-инъекций.

3. Что такое транзакция в базе данных?
Транзакция — это группа операций, которая выполняется как единое целое (либо всё, либо ничего).

4. Чем отличается fetch() от fetchAll() в PDO?
fetch() возвращает одну запись, а fetchAll() — сразу все записи.

### Вывод

В ходе работы была успешно реализована работа с базой данных через PDO, настроены связи между таблицами, реализованы CRUD-операции и обеспечена безопасность приложения.