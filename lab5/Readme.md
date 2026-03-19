# Лабораторная работа №5  
## Объектно-ориентированное программирование в PHP
## Цель работы

Освоить основы объектно-ориентированного программирования в PHP, научиться:

- создавать собственные классы;
- использовать инкапсуляцию;
- разделять ответственность между классами;
- применять интерфейсы для гибкой архитектуры.

---

## Условие

Разработать приложение для управления банковскими транзакциями, которое позволяет:

- хранить транзакции;
- добавлять новые транзакции;
- удалять транзакции;
- искать транзакции;
- сортировать транзакции;
- выполнять вычисления;
- выводить данные в виде HTML-таблицы.

---

## Используемые технологии

- PHP (strict types)
- ООП (классы, интерфейсы)
- DateTime
- HTML

---

## Архитектура приложения

Приложение реализовано с использованием следующих компонентов:

- `Transaction` — модель транзакции  
- `TransactionRepository` — хранение данных  
- `TransactionManager` — бизнес-логика  
- `TransactionTableRenderer` — вывод данных  
- `TransactionStorageInterface` — интерфейс хранилища  

---

## Задание 1 — Strict Types

В начале каждого файла используется:

```php
declare(strict_types=1);
````


## Задание 2 — Класс Transaction

Реализован класс, описывающий транзакцию:

**Свойства:**

* id
* date (DateTime)
* amount
* description
* merchant

**Особенности:**

* все свойства `private`
* доступ через getter-методы
* конструктор для инициализации

**Метод:**

```php
getDaysSinceTransaction(): int
```

Возвращает количество дней с момента транзакции.

---

## Задание 3 — TransactionRepository

Класс отвечает за хранение и доступ к данным.

**Методы:**

* addTransaction()
* removeTransactionById()
* getAllTransactions()
* findById()

**Особенности:**

* приватный массив транзакций
* доступ только через методы

---

## Задание 4 — TransactionManager

Класс реализует бизнес-логику.

**Зависимость:**
Передаётся через конструктор (Dependency Injection):

```php
public function __construct(
    private TransactionStorageInterface $repository
)
```

**Методы:**

* calculateTotalAmount()
* calculateTotalAmountByDateRange()
* countTransactionsByMerchant()
* sortTransactionsByDate()
* sortTransactionsByAmountDesc()

---

## Задание 5 — TransactionTableRenderer

Отвечает за вывод HTML.

**Метод:**

```php
render(array $transactions): string
```

**Выводит таблицу со столбцами:**

* ID
* Date
* Amount
* Description
* Merchant
* Category
* Days Ago

Класс объявлен как `final`.

---

## Задание 6 — Начальные данные

Создано 10 транзакций:

* разные даты
* разные суммы
* разные описания
* разные получатели

Все транзакции добавлены в `TransactionRepository`.

---

## Задание 7 — Интерфейс

Создан интерфейс:

```php
TransactionStorageInterface
```

**Методы:**

* addTransaction()
* removeTransactionById()
* getAllTransactions()
* findById()

**Реализация:**

* `TransactionRepository` реализует интерфейс
* `TransactionManager` использует интерфейс вместо конкретного класса


## Вывод

В ходе работы:

* реализована ООП-архитектура
* применены принципы инкапсуляции и разделения ответственности
* использован интерфейс для гибкости
* создано рабочее приложение для управления транзакциями