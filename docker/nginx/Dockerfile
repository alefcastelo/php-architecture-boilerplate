FROM nginx:stable

RUN apt-get update -y

RUN apt-get install -y software-properties-common && apt-get update -y

COPY ./docker/nginx/site.conf /etc/nginx/conf.d/default.conf

WORKDIR /application

COPY --from=local/api:latest /application /application

EXPOSE 80
