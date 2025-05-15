@echo off
chcp 65001 > nul
title ✅ Iniciando ERP Laravel + Docker
echo ✅ Verificando pré-requisitos...

:: Verifica se o Docker está instalado
where docker > nul 2>&1
IF %ERRORLEVEL% NEQ 0 (
    echo ❌ Docker não está instalado ou não está no PATH.
    pause
    exit /b
)

:: Verifica se o Docker está em execução
docker info > nul 2>&1
IF %ERRORLEVEL% NEQ 0 (
    echo ❌ Docker não está em execução. Inicie o Docker Desktop.
    pause
    exit /b
)

:: Inicia os containers
echo 🔄 Iniciando containers com Docker Compose...
docker-compose up -d

:: Aguarda alguns segundos
timeout /t 5 > nul

:: Verifica se o container 'laravel_app' existe
docker ps -a --format "{{.Names}}" | findstr "laravel_app" > nul
IF %ERRORLEVEL% NEQ 0 (
    echo ❌ O container 'laravel_app' não foi encontrado. Verifique o docker-compose.yml.
    pause
    exit /b
)

:: Instala dependências
echo 📦 Instalando dependências Laravel...
docker exec -it laravel_app composer install

:: Roda migrations
echo 🧱 Executando migrations...
docker exec -it laravel_app php artisan migrate

:: Corrige permissões
docker exec -it laravel_app chmod -R 777 storage bootstrap/cache

:: Inicia o servidor Laravel dentro do container
echo 🚀 Iniciando o servidor Laravel em http://127.0.0.1:8000 ...
docker exec -it laravel_app php artisan serve --host=0.0.0.0 --port=8000

echo ✅ ERP Laravel iniciado com sucesso!
pause
