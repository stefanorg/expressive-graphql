# Zend Expressive GraphQL Doctrine Demo

This is a demo application that show how to integrate php `graphql-middleware` with zend expressive and doctrine

Like [Youshido/GraphQLDemoApp](https://github.com/Youshido/GraphQLDemoApp) demo app, this demo mimic the [React TODO app](http://todomvc.com/examples/react)

# Running the application

## Docker Container

You can you use docker to run the application. Copy `docker-compose.local.dist` to `docker-compose.local` and modify to your needs.

### start the container

* `./contaniner.sh start` or `docker-compose up`

### install deps

* `./contaniner.sh composer install`

## Configurations setup

* Copy `config/autoload/doctrine.local.php.dist` to `config/autoload/doctrine.local.php` by default sqlite is used and the db is stored in `data/sqlite.db`
* Setting up the db with:

```
./contaniner.sh php bin/doctrine orm:schema-tool:update --force
```


## GraphiQL

Opening your browser to `http://localhost` or your docker environment address, you can use the GraphiQL interface to interact with the server.

## Sending Requests

You can send:

 * `GET` request to the `/graphql` uri

 ```
 http://localhost/graphql?query={todos}
 ```

 * `POST` request using the `application/graphql` header

 ```
 curl -X POST -H "Content-Type: application/json" -H "Content-Type: application/graphql" -d '{
 	todos {
 		id,
 		title
 	}
 }' "http://localhost/"
 ```

# Credits:

This demo is build to show how to use php [GraphQL Middleware](https://github.com/stefanorg/graphql-middleware) with zend expressive

    * GraphQL PHP Implementation: [https://github.com/Youshido/GraphQL](https://github.com/Youshido/GraphQL)
    * GraphQL Middleware [https://github.com/stefanorg/graphql-middleware](https://github.com/stefanorg/graphql-middleware)
    * GraphiQL Extension for Zend Expressive [https://github.com/stefanorg/zend-expressive-graphiql](https://github.com/stefanorg/zend-expressive-graphiql)
