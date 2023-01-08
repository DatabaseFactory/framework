<h1 style="text-align: center !important;"> 
<img src="https://www.svgrepo.com/show/224774/database.svg" alt="Logo" style="width: 9.0rem; margin-right: 0.5rem;"> 

DatabaseFactory
</h1>

<div style="text-align: justify !important; background: #ab5a1e; padding: .45rem; color: #f9f9f9;">
Please note that this library is still in heavy development stages and is in no way ready for production use.
</div>

<div style="text-align: justify !important;">

> The aim of DatabaseFactory is to give PHP application developers a means
> to securely and efficiently interact with, manage and manipulate their databases with a simple,
> and intuitive API.

### Goals

- **Security**:
    - **DatabaseFactory** is highly opinionated in one main area; security. It's built on top of the native PHP
      library; _PDO_. It uses prepared statements to
      ensure that your database transactions are protected and secure. Also, **DatabaseFactory** <u>requires</u> that a
      Dotenv
      library is properly configured within your project.
      <br /> <br />
      While **DatabaseFactory** does <u>not</u> dictate how you load
      your `env` config, it does mandate that you have it configured. This is done in order to ensure that developers
      are following recommended practices for building secure applications.
      If you are unable to add this dependency, or simply don't feel like doing so
      then fret not, a configurable library is provided for your use.
- **Efficiency**
    - Using _PDO_ at its core, **DatabaseFactory** aims to be as efficient as possible, where possible. This is done by
      issuing statements and executing queries _only_ when needed.
- **Accessibility**
    - **DatabaseFactory** aims to provide a simple API that works across a range of different database drivers. Using
      the
      Query Builder or the ORM (or both in conjunction with one another), you can interact with your databases with
      ease.
- **Modularity**
    - This library is intended to be manipulated and extended with very little effort. Customizing DatabaseFactory is
      extremely simple and gives developers full control over the API.
- **Documentation**
    - **DatabaseFactory** aims to be well documented. The main repository contains a Wiki folder, which contains the
      libraries
      corresponding documentation files in _markdown_ format.

</div>

### Features

- Object Relational Mapper (ORM)
- Intuitive query builder
- Entity based system

### Coming Soon

- Database Seeder
- Migration Manager

### Requirements

- PHP 8.2
- PDO

### How to get started

#### configure an `.env` file and assign your credentials

```dotenv
DB_HOSTNAME=127.0.0.1
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=password
DB_DRIVER=mysql
```

#### set up the library

> **DatabaseFactory** is extremely easy to set up. With just a few lines of code, you'll
> be up and running in not time flat. Simply configure your `env`, start a PDO connection
> and you're ready to work with your data.

```php
// first, we load the env configuration variables
DatabaseFactory\Helpers\Env::init(__DIR__); // path to the .env file

// next, we establish a new connection
DatabaseFactory\Facades\DB::connect();

// now, we're ready to get started!
// ...
```

<div style="text-align: justify !important;">

### Retrieving data

> The **DatabaseFactory** API provides several methods for returning data. This includes returning JSON, XML and raw
> PHP.
> These methods are `get()`, `toArray()`, `toJSON()` and `toXML()`.

</div>

##### using the ORM

```php
// generate the query
$mapper = User::where('name', '<>', '');

// dump the data
Helpers\Debug::dump($mapper->get());
```

##### using the query builder

```php
// generate the query
$builder = Facades\DB::table('users');
$builder->select('email')->where('name', '=', 'Mark');

// dump the data
Helpers\Debug::dump($builder->get());
```

##### using the ORM _with_ the query builder

```php
// generate the query
$combined = User::where('name', '<>', '')->limit(5)->offset(5);

// dump the data
Helpers\Debug::dump($combined->get());
```

### Creating and updating data

##### create a new entity object

```php 
// this class MUST extend the base entity class
class User extends \DatabaseFactory\Entity 
{
    // all fields you want to work with are properties 
    // within this class
    public string $name; 
    public string $email; 
}
```

##### creating data using the entity object

```php
$user = new User();
$user->name = 'Manny Moreno';
$user->email = 'mmoreno@gmail.com';
$user->save();
```

##### updating data using the entity object

```php
// we pass through the ID of the record we want
// to work with
$user = new User(15);
$user->name = 'Garry Williams';
$user->email = 'gwilliamslas@gmail.com';
$user->save();
```

#### Advanced Usage

<div style="text-align: justify !important;">

> **DatabaseFactory** is meant to be extremely robust. Using the ORM and the query builder
> in conjunction with one another, you can build some rather complex queries. For example,
> here is a more comprehensive query that can be generated with **DatabaseFactory**.
>
> For example ...

</div>

```php
App\Entities\User::join('users_roles', 'users.id, users.name, users.email', ['users_roles.user_id', 'users.id'])
	->and('users.email', '<>', '')
	->andLike('users.email', 'proton')
	->notLike('users.email', 'gmail')
	->groupBy('users_roles.user_id, users.id')
	->orderBy('users.id', 'DESC')
	->limit(10)
	->offset(5);
```

> ... would execute the following query:

```mysql
SELECT users.id, users.name, users.email
FROM users
         INNER JOIN users_roles ON users_roles.user_id = users.id
    AND users.email <> ''
    AND users.name <> ''
    AND users.email LIKE '%proton%'
WHERE users.email NOT LIKE '%gmail%'
GROUP BY users_roles.user_id, users.id
ORDER BY users.id DESC
LIMIT 10 OFFSET 5
```

### License

<div style="text-align: justify !important;">

&copy; 2022 - **DatabaseFactory** is released under the MIT license

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

</div>