# DatabaseFactory

> The aim of DatabaseFactory is to give PHP application developers a dependency-free means
> to securely and efficiently interact with, manage and manipulate their databases with a simple,
> and intuitive API.

Please note that this library is still in heavy development stages and is **not yet ready**
for production use.

| Travis                                                                                                                                                      | API Docs                                                  | Wiki Pages                                                     |
|-------------------------------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------|----------------------------------------------------------------|
| [![Build Status](https://app.travis-ci.com/jason-napolitano/DatabaseFactory.svg?branch=master)](https://app.travis-ci.com/jason-napolitano/DatabaseFactory) | [View Here](https://databasefactory.github.io/framework/) | [View Here](https://github.com/DatabaseFactory/framework/wiki) |

### Goals

- **Security**:
    - **DatabaseFactory** is highly opinionated in one main area; security. It's built on top of the native PHP
      library; _PDO_. It uses prepared statements to
      ensure that your database transactions are protected and secure. Also, **DatabaseFactory** <u>requires</u> that a
      Dotenv
      library is properly configured within your project.
      <br /> <br />
      While **DatabaseFactory** does _not dictate_ how you load
      your `env` config, it _does_ mandate that you have it configured. This is done in order to ensure that developers
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
    - **DatabaseFactory** aims to be well documented. The main repository contains
      a [Wiki section](https://github.com/DatabaseFactory/framework/wiki), which contains the
      libraries
      corresponding documentation files in _markdown_ format.

### Features

- Object Relational Mapper (ORM)
- Intuitive query builder
- Entity based system

### Coming Soon

- Database Seeder
- Migration Manager

### Requirements

- PHP 8.1 (or greater)
- PDO Extension

### License

&copy; 2023 - **DatabaseFactory** and all related components are released under
the MIT license

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