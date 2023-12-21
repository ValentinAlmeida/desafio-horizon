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

* Laravel Framework v10.38.1
* PHP v8.1.26
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
```

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

    cp .env.example .env

4.2. Crie o .env: (Windows)

    copy .env.example .env  

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

## 💻 Requisições da api com json prontas para teste

1. Surfistas:

```bash
    {
        "numero": 1,
        "nome": "Rani Lima",
        "pais": "Brasil"
    }
    {
        "numero": 2,
        "nome": "Vitor Goes",
        "pais": "Brasil"
    }
    {
        "numero": 3,
        "nome": "Jadson Santos",
        "pais": "Brasil"
    }
    {
        "numero": 4,
        "nome": "Jean Victor",
        "pais": "Brasil"
    }
```

    Url: http://localhost:8000/api/surfistas 
        Metodo: Post

2. Bateria:
```bash
    {
    "id": 1,
    "surfista1": 1,
    "surfista2": 2
    }
    {
    "id": 2,
    "surfista1": 3,
    "surfista2": 4
    }
    {
    "id": 3,
    "surfista1": 1,
    "surfista2": 3
    }
    {
    "id": 4,
    "surfista1": 2,
    "surfista2": 4
    }
```

    Url: http://localhost:8000/api/baterias 
        Metodo: Post

3. Ondas:
```bash
    {
    "id": 1,
    "bateria_id": 1,
    "surfista_id": 1
    }
    {
    "id": 2,
    "bateria_id": 1,
    "surfista_id": 2
    }
    {
    "id": 3,
    "bateria_id": 2,
    "surfista_id": 3
    }
    {
    "id": 4,
    "bateria_id": 2,
    "surfista_id": 4
    }
    {
    "id": 5,
    "bateria_id": 3,
    "surfista_id": 1
    }
    {
    "id": 6,
    "bateria_id": 3,
    "surfista_id": 3
    }
    {
    "id": 7,
    "bateria_id": 4,
    "surfista_id": 2
    }
    {
    "id": 8,
    "bateria_id": 3,
    "surfista_id": 4
    }
```

    Url: http://localhost:8000/api/ondas 
        Metodo: Post

4. Notas:

```bash
    {
    "id": 1,
    "onda_id": 1,
    "notaParcial1": 10,
    "notaParcial2": 9.8,
    "notaParcial3": 9.2
    }
    {
    "id": 2,
    "onda_id": 2,
    "notaParcial1": 7,
    "notaParcial2": 7.8,
    "notaParcial3": 7.2
    }
    {
    "id": 3,
    "onda_id": 3,
    "notaParcial1": 3,
    "notaParcial2": 2.8,
    "notaParcial3": 5.2
    }
    {
    "id": 4,
    "onda_id": 4,
    "notaParcial1": 7,
    "notaParcial2": 6.8,
    "notaParcial3": 8.2
    }
    {
    "id": 5,
    "onda_id": 5,
    "notaParcial1": 9,
    "notaParcial2": 9.8,
    "notaParcial3": 9.2
    }
    {
    "id": 6,
    "onda_id": 6,
    "notaParcial1": 5,
    "notaParcial2": 2.8,
    "notaParcial3": 5.2
    }
    {
    "id": 7,
    "onda_id": 7,
    "notaParcial1": 10,
    "notaParcial2": 8.8,
    "notaParcial3": 9.2
    }
    {
    "id": 8,
    "onda_id": 8,
    "notaParcial1": 1,
    "notaParcial2": 2,
    "notaParcial3": 4.3
    }
```

    Url: http://localhost:8000/api/notas 
        Metodo: Post

Url para obter o vencedor http://localhost:8000/api/baterias/{id}/vencedor