# Phalcon\Mvc\Router\Config
Provides the ability to perform the Routing from configuration

## Install

```json
{
    "require": {
        "iwai/phalcon-mvc-router-config": "*"
    }
}
```

## Recommended

Recommended the use of Phalcon\Config\Adapter\Yaml in incubator, 
of course, it is possible even otherwise.

### Example configuration of yaml file.

```yaml
# Example:
# user_view:
#   method:     [ GET, POST ]
#   url:        /user/view/{user_id}
#   controller: user
#   action:     view
#   namespace:  \App\FrontendController

# Route for UserController::indexAction mapped url for /user
user_index:
  method: GET
  url:        /user
  controller: user
  action:     index
# Same as in the example above, can be omitted `index` and `url`,`controller`,`action`
user:
  method: GET

# Route for UserController::viewAction mapped url for /user/view
user_view:
  method: GET

# Route for ShopController::viewAction, mapped url for /shop/view/1234
# can be define names to route parameters
# see: http://docs.phalconphp.com/en/latest/reference/routing.html#parameters-with-names
shop_view:
  method: GET
  url:    /shop/view/{shop_id}

shop_create:
  method: [ GET, POST ]
  url:    /shop/create

```

```php

$di['router'] = function() {
    // Use the config router
    $router = new \Phalcon\Mvc\Router\Config();
    $router->build(
        new Phalcon\Config\Adapter\Yaml('path/route.yml')
    );
    return $router;
};

```