## About Repository

This project provide graphql method for api on mvc structure with php



## Usage/Examples

1. Make type

2. Make query or mutation

3. Megister query and mutation on GraphqlController

4.
```bash 
php -S 0.0.0.0:8080 -t public
```

----
1. For make type of model, make a class such as below ...

```php
<?php
namespace any\path;
use \App\core\Rendering\Graphql\implementation\GraphModelInterface;
use GraphQL\Type\Definition\Type;
class UserType implements GraphModelInterface
{
      public static function makeModelType(): void
      {
        self::$modelType= new ObjectType([
            'name' => 'user',
            'description' => 'A user',
            'fields' => [
                    'id' => Type::id(),
                    'name' => Type::string(),
                    'email' => Type::string(),
                    'created_at' => Type::string(),
                    'updated_at' => Type::string(),
                ],
        ]); 
    }
    .
    .
    .
```
2. For make query make a class such as below ...

```php
<?php
namespace any\path;
use GraphQL\Type\Definition\Type;
use App\Models\User;
class UserQuery extend GraphqlType
{
  public function fields() {
     return [
            'user' => [
                'type' => UserType::getModelType(),
                'args' => [
                    'id' => Type::id(),
                ],
                'resolve' => function ($root, $args) {
                    return User::find($args['id'])->toArray();
                },
            ],
            'users' => [
                'type' => Type::listOf(UserType::getModelType()),
                'resolve' => function ($root, $args) {
                    return User::all()->toArray();
                },
            ]
        ];
  }
}
```

- And for make mutation make a class such as below ...

```php
<?php
namespace any\path;
use GraphQL\Type\Definition\Type;
use App\Models\User;
class UserMutation extend GraphqlType
{
  public function fields() {
    return [
      'addUser' => [
          'type' => UserType::getModelType(),
          'description' => 'Add a new user',
          'args' => [
              'name' => Type::string(),
              'email' => Type::string(),
              'password' => Type::string(),
          ],
          'resolve' => function ($root, $args) {
              $user= new User();
              $user->name= $args['name'];
              $user->email= $args['email'];
              $user->password= $args['password'];
              $user->save();
              return $user->toArray();
          },
      ],
    ]
  }
}
```

3. And then register them on controller/GraphqlController ...

```php
    /**
     * you can make query and mutation classes
     * such as --App\graphql\UserQuery-- and
     * register them in the below methods
     */
    public function setMutationFields(): void
    {
        (new userMutation())->setField();
    }
    public function setQueryFields(): void
    {
        (new userQuery())->setField();
    }
}
```



## Route

Also you can define your specific route in
-- router/routes.php ---
#### by default:
```http
  0.0.0.0:8080/graphql
```