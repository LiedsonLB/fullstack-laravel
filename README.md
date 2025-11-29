# Desafio Fullstack Laravel - API de Encurtamento de URLs (Francisco Liédson)

## Sobre o Projeto

Este projeto consiste em uma API RESTful desenvolvida em Laravel para encurtamento e gerenciamento de URLs.
A aplicação permite criar URLs curtas, redirecioná-las para o endereço original, consultar todas as URLs cadastradas e acompanhar o número de acessos (hits) de cada link encurtado.

O sistema foi criado com foco em boas práticas de arquitetura, separação de camadas (Service Layer), validações robustas, logs, e uso adequado de status HTTP.

## Tecnologias Utilizadas

<div style="display: flex; flex-wrap: wrap; gap: 5px; justify-content: center"> <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" height="30" width="40" alt="PHP"/> 
            <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" height="30" width="40" />
           <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg" height="30" width="40" alt="PostgreSQL"/> <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg" height="30" width="40" alt="Docker"/> <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/insomnia/insomnia-original.svg" height="30" width="40" alt="Insomnia"/> <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg" height="30" width="40" alt="GitHub"/> </div>

## Objetivos do Desafio

- Criar uma API REST para encurtamento de URLs
- Registrar quantidade de acessos por URL
- Redirecionar URLs curtas para seus destinos originais
- Implementar validações, logs e respostas coerentes

## Funcionalidades

1. Criar URL encurtada.
2. Redirecionar URL curta.
3. Listar URLs criadas.
4. Contabilizar acessos (hits).
5. Expiração opcional por data ou dias.
6. Validações com Form Request.
7. Arquitetura orientada a serviços (Service Layer).

## Endpoints

Responsável pelo gerenciamento de URLs, incluindo criação, consulta, atualização e exclusão de URLs.

### Headers
- Content-Type: application/json
- Accept: application/json

| **Método** | **Endpoint**         | **Descrição**                                     |
| ---------- | -------------------- | ------------------------------------------------- |
| POST       | `/api/v1/urls`       | Cria uma nova URL encurtada                       |
| GET        | `/api/v1/urls`       | Lista todas as URLs criadas                       |
| GET        | `/{code}`            | Redireciona para a URL original e incrementa hits |
| GET        | `/api/v1/urls/{id}`  | Retorna detalhes de uma URL                       |
| PUT        | `/update-event/{id}` | Atualiza um evento pelo ID                        |
| DELETE     | `/delete-event/{id}` | Exclui um evento pelo ID (verifica ingressos)     |

---
Dados de Entrada: 
```javascript
{
  "original_url": "https://liedsonbarros.vercel.app"
} 
```
Dados de Saída:
```javascript
{
  "id": 1,
  "code": "xY7kL",
  "short_url": "http://127.0.0.1:8000/xY7kL",
  "original_url": "https://liedsonbarros.vercel.app",
  "expires_at": null,
  "hits": 0,
  "created_at": "2025-11-28T18:01:05.000000Z"
}
 
```
---

## Configuração do Projeto

### Pré-requisitos

- PHP 8.3.28
- Composer 2.8.6
- Laravel 12.40.2
- PostgreSQL 14
- Docker (opcional): Caso prefira não instalar o PostgreSQL localmente, você pode usar o container Docker fornecido no `docker-compose.yml` para rodar o banco de dados criando uma pasta como volume no próprio projeto.

### Extensões PHP necessárias

- mbstring
- curl
- openssl
- pdo
- json
- xml
- fileinfo

### Passos para Executar Localmente

####  Clone o repositório:
```bash
git clone https://github.com/LiedsonLB/fullstack-laravel.git
```

### Rodando o banco de dados com Docker (opcional)
Na raiz do projeto, execute:
```bash
docker compose up -d
```

#### Instale as dependências do Composer:
```bash
cd fullstack-laravel
composer install
```

#### Configure o arquivo .env:
```bash
cp .env.example .env
```
Edite o arquivo `.env` para configurar a conexão com o banco de dados PostgreSQL (Mas a .env não está no .gitignore):
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=encurtador
DB_USERNAME=admin
DB_PASSWORD=admin
```

## Estrutura do Banco de Dados
### Tabelas
- short_urls
  - id (bigint, primary key)
  - code (string, unique)
  - short_url (string, unique)
  - original_url (string)
  - expires_at (timestamp, nullable)
  - hits (integer, default 0)
  - created_at (timestamp)
  - updated_at (timestamp)
  
## Imagens do Projeto

## Tabela do Banco de Dados
![Tabela do Banco de Dados imagem](/snapshots/database.png)

<!-- aqui vai ser a requisição POST -->
### Requisição POST para criar URL encurtada
![Requisição POST imagem](/snapshots/post%20link.PNG)

### Requisição GET para Listar informações da URL encurtada
![Resposta POST imagem](/snapshots/get%20link.PNG)

### Requisição GET para Listar as URLs encurtada
![Requisição GET imagem](/snapshots/get%20links.PNG)


## Deployment
O projeto ainda está sendo implementado para deployment em servidores de produção como o Render. até a presente data (28/11/2025).

## Releases

- Release v1.0 ✅