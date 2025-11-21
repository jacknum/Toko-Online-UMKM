# Build stage
FROM node:20 AS node-builder
WORKDIR /app
COPY . .
RUN npm install && npm run build

# PHP stage
FROM dunglas/frankenphp

WORKDIR /app

COPY . .
COPY --from=node-builder /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader
