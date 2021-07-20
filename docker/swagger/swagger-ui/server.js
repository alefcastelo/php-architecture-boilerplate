const express = require('express');
const swaggerUi = require('swagger-ui-express');
const yaml = require('yamljs');

const app = express();

const swaggerDocumentJson = yaml.load('/application/openapi/swagger.yaml')

const options = {
    explorer: true,
}

app.use('/', swaggerUi.serve, swaggerUi.setup(swaggerDocumentJson, options));

app.listen(3000, () => {
    console.log(`Server stated...`)
})