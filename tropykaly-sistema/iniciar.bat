@echo off
REM Script para iniciar o Tropykaly Sistema no Docker

cd /d "%~dp0"

echo.
echo ========================================
echo  TROPYKALY - Sistema de Pizzaria
echo ========================================
echo.

echo [*] Verificando Docker...
docker --version >nul 2>&1
if errorlevel 1 (
    echo [!] Docker nao encontrado! Instale o Docker Desktop
    pause
    exit /b 1
)

echo [+] Docker encontrado!
echo.
echo [*] Construindo imagem Docker...
docker-compose build

echo.
echo [*] Iniciando containers...
docker-compose up -d

echo.
echo [+] Container iniciado!
echo.
echo ========================================
echo [✓] Acesse em: http://localhost
echo ========================================
echo.
echo Para parar: docker-compose down
echo Para ver logs: docker-compose logs -f
echo.
pause
