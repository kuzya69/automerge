# automerge

Написано на PHP, пользоваться аккуратно:
1) Клонируйте репозиторий automerge
2) Клонируйте репозиторий widgets из git.amoCRM...
3) В файле automerge/config укажите путь к папке из пункта 2
4) В widgets/.git/info/exclude добавить
    .DS*
    __MACOSX/
Так можно игнорировать файлы macosx, ничего не меняя в репозитории widgets
5) В папку .ssh вашего http сервера добавить rsa ключи от репозитория widgets

Можно пользоваться
