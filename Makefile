# ========================
# CONFIG
# ========================
APP_NAME=laravel-app
PHP=php
COMPOSER=composer
NPM=npm
ARTISAN=$(PHP) artisan

# ========================
# SETUP PROJECT
# ========================

install:
	@echo "🚀 Installing dependencies..."
	$(COMPOSER) install
	$(NPM) install
	cp .env.example .env || true
	$(ARTISAN) key:generate
	@echo "✅ Done install"

fresh-install: install migrate seed

# ========================
# DATABASE
# ========================

migrate:
	@echo "📊 Running migrations..."
	$(ARTISAN) migrate

migrate-fresh:
	@echo "⚠️ Fresh migrate (drop all tables)..."
	$(ARTISAN) migrate:fresh

seed:
	@echo "🌱 Seeding database..."
	$(ARTISAN) db:seed

migrate-seed:
	$(ARTISAN) migrate --seed

# ========================
# DEVELOPMENT
# ========================

serve:
	@echo "🌐 Starting Laravel server..."
	$(ARTISAN) serve

vite:
	@echo "⚡ Starting Vite dev server..."
	$(NPM) run dev

dev:
	@echo "🔥 Running full dev (Laravel + Vite)..."
	make -j2 serve vite

# ========================
# BUILD
# ========================

build:
	@echo "🏗️ Building assets..."
	$(NPM) run build

# ========================
# CACHE
# ========================

cache-clear:
	@echo "🧹 Clearing cache..."
	$(ARTISAN) config:clear
	$(ARTISAN) cache:clear
	$(ARTISAN) route:clear
	$(ARTISAN) view:clear

optimize:
	@echo "⚡ Optimizing..."
	$(ARTISAN) config:cache
	$(ARTISAN) route:cache
	$(ARTISAN) view:cache

# ========================
# PERMISSIONS (Linux/Mac)
# ========================

perm:
	chmod -R 775 storage bootstrap/cache

# ========================
# RESET PROJECT
# ========================

reset:
	@echo "♻️ Reset project..."
	rm -rf vendor node_modules
	rm -f package-lock.json
	make install

# ========================
# HELP
# ========================

help:
	@echo ""
	@echo "📌 Available commands:"
	@echo " make install         - Install dependencies"
	@echo " make fresh-install   - Install + migrate + seed"
	@echo " make dev             - Run Laravel + Vite"
	@echo " make build           - Build assets"
	@echo " make migrate         - Run migrations"
	@echo " make seed            - Seed database"
	@echo " make cache-clear     - Clear cache"
	@echo " make optimize        - Optimize cache"
	@echo ""