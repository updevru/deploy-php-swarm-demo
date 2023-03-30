
# Разработка Symfony приложения с нуля до prod

Мы неачнем с пустого репозитория и закончим приложением работающем в продакшене.

Все сервисы будет запускать и разрабатывать в Docker, для запуска в продакшене будем использовать Docker swarm.

## Установка Symfony

Запустим контейнер composer и начнем установку в нем.

```bash
docker run -it --rm -v $(pwd):/app -w /app -u $(id -u ${USER}):$(id -g ${USER}) composer bash
```

Далее в нутри контейнера:

```bash
composer create-project symfony/skeleton:"6.3.*@dev" api
```

## DEV окружение

Создаем [Dockerfile](api/Dockerfile), [docker-compose.yml](docker-compose.yml) и необходимые конфиги для [nginx](docker/nginx).

Добавляем права на запуск `entrypoint.sh` и запускаем наше приложение.

```bash
cp .env.default .env
chmod +x api/entrypoint.sh
docker compose up
```

Заходим на http://localhost:4000/ и видим приветственную страничка Symfony. В консоле можем наблюдать лог приложения и nginx.

В дальнейшем для запуска dev окружения достаточно выполнить `docker compose up` и можно начинать разрабатывать.

## Сборка приложения

Для запуска приложения на других контурах необходимо его собрать и тем самым заффиксировать его состояние.

Сборка любого приложения в Docker состоит из следующих шагов:

1) Создание образа
2) Публикация образа в registry

В ручном режиме достаточно выполнить:

```bash
cd api/
docker build -t updev/example-web-app-api
docker push updev/example-web-app-api
```

Обычно этот процесс автоматизирует с помощью CI/CD систем. Пример для [github action](.github/workflows).