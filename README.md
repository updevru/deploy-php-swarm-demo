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

Создаем [Dockerfile](api/Dockerfile), [docker-compose.yml](docker-compose.yml) и необходимые конфиги для nginx.

Добавляем права на запуск `entrypoint.sh` и запускаем наше приложение.

```bash
cp .env.default .env
chmod +x api/entrypoint.sh
docker compose up
```

Заходим на http://localhost:4000/ и видим приветственную страничка Symfony. В консоле можем наблюдать лог приложения и nginx.

