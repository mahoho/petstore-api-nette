Pet Store Nette Test Project
=================

Simple API based on Nette framework to implement https://petstore3.swagger.io/ Swagger schema.
Project uses DataModels generated from schema using [OpenApi Generator](https://www.npmjs.com/package/@openapitools/openapi-generator-cli), with some changes. 

Instead of database connection, XML files are used. 

To add more fields, adjust proper DataModel classes.

Start from `/users/createFromList` to create users and make subsequent requests. 
