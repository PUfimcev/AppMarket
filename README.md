# AppMarket

Docker stack: **nginx** → **Next.js** (UI) + **Laravel** (API / Filament paths), **PostgreSQL**, **Redis**, **RabbitMQ**, **MinIO**, **Meilisearch**.

## Prerequisites

- Docker Compose v2
- Laravel app in `backend1` (with `composer.json`, `Dockerfile` build context)
- Next.js app in `frontend1` (prod `Dockerfile` needs `output: 'standalone'` in `next.config`)

## Setup

```bash
cp .env.example .env
cp backend/.env.example backend/.env
cp frontend/.env.example frontend/.env.local
# After Laravel is installed: php artisan key:generate (in backend/)
```

Edit passwords in `.env` and `backend1`. `MEILISEARCH_KEY` in `backend1` must match `MEILI_MASTER_KEY` in root `.env`.

## Run

```bash
docker compose up -d --build
```

| URL | Service |
|-----|---------|
| http://localhost | Site (Next via nginx) |
| http://localhost/api | Laravel API |
| http://localhost:9001 | MinIO console |
| http://localhost:15672 | RabbitMQ management |
| http://localhost:7700 | Meilisearch (dev; do not expose in prod) |

## Local frontend dev (optional)

```bash
cp docker-compose.override.example.yml docker-compose.override.yml
docker compose up -d --build frontend
```

## Notes

- Root `.env` — infra services only (Postgres, MinIO, Meili, RabbitMQ).
- `backend1` — Laravel (DB hosts are **Docker service names**: `postgres`, `redis`, `minio`, `meilisearch`).
- Files: S3-compatible **MinIO**, not nginx `/storage/`.
- HTTPS: terminate TLS on nginx (443 + certs); keep internal `http://frontend:3000` and FastCGI to `backend:9000`.
