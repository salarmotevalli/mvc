
## About Repository

This project provide graphql method for api on mvc base with php



## Usage/Examples

1. make type

2. make query or mutation

3. register query and mutation on GraphqlController

4.
```bash 
php -S 0.0.0.0 -t public
```

----
2. for make query, make a class such as below ...

```php
<?php

namespace any\path;

class CompanyQuery extend GraphqlType
{
  public function fields() {
    return [
      company => [
        'type' => 'Query',
        'args' => [

        ],
        'resolver' => [],
      ]
    ]
  }
}
```

- and for make mutation make a class such as below ...

```php
<?php

namespace any\path;

class CompanyMutation extend GraphqlType
{
  public function fields() {
    return [
      company => [
        'type' => 'Query',
        'args' => [

        ],
        'resolver' => [],
      ]
    ]
  }
}
```
3. and then register them on controller/GraphqlController ...

```php
    /**
     * you can make query and mutation classes
     * such as --App\Graphql\UserQuery-- and
     * register them in the below methods
     */

    public function setMutationFields(): void
    {
        (new CompanyMutation())->setField();
    }

    public function setQueryFields(): void
    {
        (new CompanyQuery())->setField();
    }
}

```



## Route

also you can define your specific route in
-- router/routes.php ---
#### by default:


```http
  0.0.0.0/graphql
```