FROM nginx:alpine

COPY conf.d/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/html
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]