# Cloud Kitchen OMS  — Setup Guide

---

## Overview

This is the repository for the Cloud Kitchen OMS Project for — IS226 AY 2025-2026.

Tech Stack:
| Application  | Version |
|--------------|---------|
| PHP          | >=8.2   |
| CodeIgniter4 | 4.7.2   |
| mariadb      | 15.1    |


## Prerequisities

### 1. Install PHP

Download: https://www.php.net/downloads.php

1. Choose **Single Line Processor**
2. Uncheck *"I want to be able to compile everything from source"*
3. Copy and run the PowerShell script with the following options:
   - Architecture: **x64**
   - Thread Safety: **ThreadSafe**
   - Timezone: **Asia/Manila**
   - Install for: **Current User**
4. Close and reopen a new `cmd` prompt, then verify the installation:
   ```shell
   php -v
   ```

#### 1.1 Configure `php.ini`

Locate your `php.ini` file (e.g., `C:\Users\house\AppData\Local\Programs\PHP\8.5.4\ts\x64`) and uncomment the following extensions:

```ini
extension=intl
extension=mbstring
extension=mysqli
extension=openssl
extension=sqlite3
```

---

### 2. Install Composer

Download: https://getcomposer.org/download/

1. Create an installation folder:
   ```shell
   mkdir C:\Users\house\apps\composer
   ```

2. Open a `cmd` prompt, `cd` into the folder, and run:
   ```shell
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
   php -r "if (hash_file('sha384', 'composer-setup.php') === 'c8b085408188070d5f52bcfe4ecfbee5f727afa458b2573b8eaaf77b3419b0bf2768dc67c86944da1544f06fa544fd47') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
   php composer-setup.php
   php -r "unlink('composer-setup.php');"
   ```

3. Create a batch file for `composer.phar` in the composer directory:
   ```
   echo @php "%~dp0composer.phar" %*>composer.bat
   ```

4. Add the composer directory to your system `PATH`.

---

### 3. Change directory to ckoms and run composer install

```
composer install
```

---

### 4. Install and run mariadb
**Reference**
- [Download and Install Mariadb](https://mariadb.org/download/?t=mariadb)

## Creating REST Controllers

### 1. Creating Controllers

**References**
- [First Endpoint](https://codeigniter.com/user_guide/guides/api/first-endpoint.html)
- [Controller Concepts](https://codeigniter.com/user_guide/guides/api/controller.html)

1. Scaffold the controller:
   ```
   php spark make:controller Api/Ingredients
   ```

2. Edit the generated controller following the guides above (more on this later).

3. At this point you can run the app and go to your api http://localhost:8080/api/ingredients
   ```
   php spark serve
   ```

---

### 2. Database Setup

**References**
- [Creating the Database in the Command Line](https://codeigniter.com/user_guide/dbmgmt/forge.html#creating-databases-in-the-command-line)
- [Database Setup Guide](https://codeigniter.com/user_guide/guides/api/database-setup.html)

#### 2.1 Create the database
1. Open the .env file in your project root (if you don't have one, rename env to .env).Find and uncomment the following lines, replacing them with your credentials:

database.default.hostname = localhost
database.default.database = **ckoms**
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi

2. Create the database
```shell
php spark db:create ckoms
```

#### 2.2 Create Migration

1. Create and Run Migrations by following the above reference.

```
php spark make:migration CreateIngredientTable
```

2. Edit the generated file `<SomeDate>_CreateIngredientTable.php`

3. Run migrate to create db table.
```
php spark migrate
```

**Note:** To apply schema changes
```
php spark migrate:refresh
```
As a last resort, delete the `database.db` file (SQLite) to reset completely.

#### 2.3 Seed the Database  *(Test Only)*

1. Create the Seeder
```
php spark make:seeder IngredientSeeder
```
2. Make changes to the run method to add records.
Edit the `run()` method in `app/Seeds/IngredientSeeder.php`

Note: If you need to re-run again make sure to add truncate before the inserts.
3. Edit app/Seeds/DatabaseSeeder.php and add your table after other dependencies:
```php
public function run()
    {
...
        $this->call('BrandSeeder');
        $this->call('IngredientSeeder'); // added after brand dependency
...
    }
```

3.Run the database seeder:
```shell
php spark db:seed DatabasetSeeder
```
4. Update the run method of DatabaseSeeder.php to call your seeder. This is needed to run all seeders at the same time.

```php
$this->call('IngredientSeeder');
```
---

### 3. Create the Model

**Reference**
- [Database Setup Guide](https://codeigniter.com/user_guide/guides/api/database-setup.html)
1. Creat the model using the name of the table (camelCase) with Model suffix.
```shell
php spark make:model IngredientModel
```
2. Edit the model and add custom sql queries.
  
```php
   ...
   protected $primaryKey       = 'ingredient_id';
   protected $useAutoIncrement = true;
   protected $allowedFields    = ['brand_id', 'name', 'br...
   ...
   // Dates
   protected $useTimestamps = true;
   protected $dateFormat    = 'datetime';
   protected $createdField  = 'date_created';
   protected $updatedField  = 'date_updated';
   protected $deletedField  = null;
...
   public function getIngredients(int $brandId, ?string $category = null) {
      ...
   }
```
---

#### 2.4. Create Transformers

**References**
- [Controller Concepts — Transformers](https://codeigniter.com/user_guide/guides/api/controller.html)

1. Scaffold the transformer:
   ```
   php spark make:transformer IngredientTransformer
   ```

2. Implement the `toArray()` method:
   ```php
   public function toArray(mixed $resource): array
   ```

3. See the guide for complex transformations, including joining data from related tables.

---

#### 2.5 Database Queries

** References **
- [Database Queries](https://codeigniter.com/user_guide/database/queries.html)

---

## Unit Testing

**References**
- [Unit Testing Overview](https://www.codeigniter.com/user_guide/testing/overview.html)

1. Setup PhpUnit 
```
composer require --dev phpunit/phpunit

```

2. See unit tests in ckoms\tests\apps\Controllers\Api
