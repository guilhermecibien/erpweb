FROM node:24-alpine AS assets

WORKDIR /var/www/html
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY vite.config.js ./
RUN npm run build

FROM nginx:1.28-alpine

COPY public /var/www/html/public
COPY --from=assets /var/www/html/public/css /var/www/html/public/css
COPY --from=assets /var/www/html/public/js /var/www/html/public/js
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
