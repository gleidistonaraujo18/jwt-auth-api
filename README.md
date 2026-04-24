# JWT Auth API

Stateless authentication service built with Laravel and JSON Web Tokens.

[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![License](https://img.shields.io/badge/license-MIT-green?style=flat-square)](LICENSE)

---

## Stack

- **PHP** 8.3+
- **Laravel** 13.x
- **MySQL** 8.x
- **php-open-source-saver/jwt-auth**
- **Pest** — testes

---

## Instalação

### Com Docker

Suba os containers da API e do MySQL:

```bash
docker compose up -d --build
```

Prepare a aplicação dentro do container:

```bash
docker compose exec app php artisan key:generate
docker compose exec app php artisan jwt:secret
docker compose exec app php artisan migrate
```

A API ficará disponível em:

```text
http://localhost:8000
```

Para parar os containers:

```bash
docker compose down
```

### Sem Docker

```bash
git clone https://github.com/seu-usuario/jwt-auth-api.git
cd jwt-auth-api

composer install

cp .env.example .env
php artisan key:generate
```

Configure o `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jwt_auth
DB_USERNAME=root
DB_PASSWORD=

JWT_SECRET=sua_chave_secreta_aqui
```

```bash
php artisan migrate
php artisan serve
```

---

## Endpoints

### Públicos

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/api/health` | Verifica se a API está respondendo |
| `POST` | `/api/auth/register` | Criar conta |
| `POST` | `/api/auth/login` | Login e recebimento do token JWT |

### Protegidos

> Requer `Authorization: Bearer <token>` e `Accept: application/json`.

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/api/auth/me` | Dados do usuário autenticado |
| `POST` | `/api/auth/logoff` | Invalidar token atual |

---

## Testes

```bash
php artisan test
```
---

## Licença

MIT — veja [LICENSE](LICENSE).

---

## Autor

**Seu Nome**
[github.com/seu-usuario](https://github.com/seu-usuario) · [linkedin.com/in/seu-perfil](https://linkedin.com/in/seu-perfil)
