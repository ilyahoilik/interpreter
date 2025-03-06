# Интерпретатор

Данный репозиторий содержит решение тестового задания на позицию Middle+ PHP Developer. Необходимо было написать простой
интерпретатор функционального языка. Полное описание задачи можно
найти [здесь](docs/task.md).

### Установка

```
composer install
```

### Использование

```
php main.php world
```

### Архитектура

Проект состоит из трёх частей – код интерпретатора в папке `interpreter`, код функций в папке `functions` и код
приложения в папке `app`. Рассмотрим подробнее каждую из этих частей.

### Интерпретатор

Интерпретатор содержит три модуля:

* **Lexer** – лексический анализатор, который проходится по исходному коду и разбивает его на токены
* **Parser** – конвертер, который проходится по списку токенов и составляет абстрактное статическое дерево
* **Evaluator** – модуль, который запускает выполнение всех функций в статическом дереве

В модуле **Lexer** есть несколько базовых классов:

* **Reader** – отвечает за посимвольное чтение исходного кода
* **Token** – отвечает за сущности кода (скобки, запятые, ключевые слова, константы)
* **TokenCollection** – отвечает за коллекцию токенов единым списком
* **Lexer** – основной класс, который читает символы из **Reader** и создаёт необходимые **Token**

В модуле **Parser** стоит обратить внимания на:

* **AST** – содержит узлы синтаксического дерева: функции и константы (строки, числа, булевы значения и null)
* **Parser** – проходится по списку токенов из **TokenCollection** и строит синтаксическое дерево

И последний модуль – это **Evaluator**. Он содержит лишь один класс, который запускает выполнение всего
дерева и возвращает результат корневой функции пользователю.

### Функции

Название функции разбивается по символу `.` и каждая часть приводится в формат CamelCase. Например, функция
`bk.action.map.Make` будет располагаться в классе `Bk\Action\Map\Make`. Все классы функций являются вызываемыми.

### Приложение

Простейший класс `Application` с методом `run`, который инициализирует все необходимые классы, запускает нужные методы и
возвращает конечный результат.

Входной точкой является файл `main.php` в корне проекта.

### Список задач

Есть очевидные задачи, на которые просто не хватило времени:

- Протестировать интерпретатор с другой комбинацией входного кода.
- Установить PestPHP и покрыть интерпретатор unit и функциональными тестами.
- Токены `True`, `False`, `Null`, `String` и `Integer` нужно объединить в единый `Constant`.
- Выбрасывать из интерпретатора исключения с номером строки, на которой произошла ошибка.
- Отлавливать исключения и отображать читабельную информацию пользователю.
- Добавить развёртывание через Docker и инструкцию по использованию.
- В строках не поддерживается множественное экранирование кавычек.