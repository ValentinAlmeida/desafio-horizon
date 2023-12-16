![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Horizon](https://img.shields.io/badge/Horizon-yellow?style=for-the-badge)

# Desafio Horizon Inovação e Tecnologia

![version](https://img.shields.io/badge/version-1.0-blue.svg?longCache=true&style=flat-square)
![license](https://img.shields.io/badge/license-MIT-green.svg?longCache=true&style=flat-square)
![contributors](https://img.shields.io/badge/Contributors-1-brightgreen?style=flat-square)

![logo](https://d2bxzineatl84k.cloudfront.net/storage/files/logos/PyioC4SYIClCgM1q2xFHVtTcrOF0uCGh4V0YUwYW.png)

>Este projeto consiste em desenvolver uma aplicação web para gerenciar competições de surf, seguindo as especificações fornecidas. A aplicação será construída utilizando o framework Laravel na sua versão mais recente, e o banco de dados escolhido pode ser PostgreSQL, MongoDB ou qualquer outro, seja SQL ou NoSQL.

## 💻 Pré-requisitos

Antes de começar, verifique se você atendeu algumas informações do projeto:

* Laravel Framework 9.52.16
* PHP 8.0.30 (cli)
* Composer version 2.6.6
* Docker version 24.0.7
* Docker Compose version v2.23.3

## 🚀 Instalando o Desafio com make

Para instalar o desafio, siga estas etapas:

1. Clone o repositório:

    ```bash
    git clone https://github.com/ValentinAlmeida/desafio-horizon.git
    ```

2. Acesse o diretório do projeto:

    ```bash
    cd desafio-horizon
    ```

3. Instale as dependências e configure o ambiente:

    ```bash
    make install
    ```

    Isso realizará as seguintes etapas automaticamente:
    - Instalar dependências do Composer.
    - Copiar o arquivo de ambiente de exemplo e gerar uma chave de aplicativo para o Laravel.
    - Iniciar o banco de dados com as Migrates.
    - Finaliza com o Seed.

> Lembre que se for instalar no windows para rodar o make é recomendado usar o mingw32, instalado com o msys2(baixe no site oficial), abrindo o programa e rodando o:

        
    pacman -Syu
    pacman -Su
    pacman -S mingw-w64-x86_64-toolchain
    export PATH=$PATH:/c/msys64/mingw64/bin
    mingw32-make install
    

4. Se precisar iniciar os containers Docker:

    ```bash
    make up
    ```

Agora, o projeto está instalado e configurado. Você pode iniciar os containers Docker, executar migrações e semear o banco de dados com apenas um comando:

```bash
make install

## 🚀 Instalando o Desafio sem make

Para instalar o desafio, siga estas etapas:

1. Clone o repositório:

    ```bash
    git clone https://github.com/ValentinAlmeida/desafio-horizon.git
    ```

2. Acesse o diretório do projeto:

    ```bash
    cd desafio-horizon
    ```

3. Faça a instalação do composer:

    ```bash
    composer install
    ```

4.1. Crie o .env: (Linux)

    ```bash
    cp .env.example .env
    ```

4.2. Crie o .env: (Windows)

     ```bash
    copy .env.example .env
    ```   

5. Gere a key do artisan:

     ```bash
    php artisan key:generate
    ```    

6. Inicie o Docker:

     ```bash
    docker-compose up --build
    ```    

7. Rode a migrate:

     ```bash
    docker-compose exec app php artisan migrate
    ```   

8. Rode a Seed:

     ```bash
    docker-compose exec app php artisan db:seed
    ```   

### Contribuidor
| [<img src="https://avatars.githubusercontent.com/u/85695651?s=400&u=d9da951fa99581e5dfbd44e3fb4f847451efcfbb&v=4"><br><sub>Valentin Almeida</sub>](https://github.com/ValentinAlmeida) |:-:|