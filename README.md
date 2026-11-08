# AppMarket

Docker stack: **nginx** → **Next.js** (UI) + **Laravel** (API / Filament paths), **PostgreSQL**, **Redis**, **RabbitMQ**, **Meilisearch**. Object storage: **Cloudflare R2** (outside Compose).

## Prerequisites

- Docker Compose v2
- Laravel app in `backend` (`composer.json`, `Dockerfile` / `Dockerfile.dev`)
- Next.js app in `frontend` (`output: 'standalone'` in `next.config.ts` for prod `Dockerfile`)

## Setup

```bash
cp .env.example .env
cp backend/.env.example backend/.env
cp frontend/.env.example frontend/.env.local
# After Laravel is installed: php artisan key:generate (in backend/)
```

Edit passwords in `.env` and `backend/.env`. `MEILISEARCH_KEY` in `backend/.env` must match `MEILI_MASTER_KEY` in root `.env`.

## Run (local dev)

```bash
cp docker-compose.override.example.yml docker-compose.override.yml   # once
docker compose up -d --build
```

Compose merges `docker-compose.yml` (prod base) with `docker-compose.override.yml` (dev mounts and `Dockerfile.dev`).

## Run (production / server)

No override file — only the base compose:

```bash
docker compose up -d --build
docker compose exec backend php artisan migrate --force
```

| URL | Service |
|-----|---------|
| http://localhost | Site (Next via nginx) |
| http://localhost/api | Laravel API |
| http://localhost:15672 | RabbitMQ management |
| http://localhost:7700 | Meilisearch (dev; do not expose in prod) |

## Notes

- Root `.env` — infra services only (Postgres, Meili, RabbitMQ).
- `backend/.env` — Laravel (`FILESYSTEM_DISK=s3`); DB/cache hosts in Docker: `postgres`, `redis`, `meilisearch`. **R2:** set `AWS_*` / endpoint in `backend/.env` (see `backend/.env.example`).
- `docker-compose.override.yml` is gitignored; use `docker-compose.override.example.yml` as a template.
- Files: **Cloudflare R2**, not nginx `/storage/`.
- HTTPS: terminate TLS on nginx (443 + certs); keep internal `http://frontend:3000` and FastCGI to `backend:9000`.
