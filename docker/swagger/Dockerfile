FROM node

WORKDIR /application

COPY ./docs/openapi/* ./data/
COPY ./docker/swagger/swagger-ui/package*.json ./
COPY ./docker/swagger/swagger-ui/* ./

RUN yarn install

EXPOSE 3000

ENTRYPOINT ["yarn", "dev"]