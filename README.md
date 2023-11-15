# Pokemon Network

## Table of Contents
- [Installation Locally](#installation-locally)
  - [Requirements](#requirements)

## Installation Locally
###
Before proceeding with the project setup, make sure that you have all the indicated requirements below.

|Requirements                |
|----------------------------|
|__PHP 8.1__                 |
|__MySQL/Database__          |
|__NPM__                     |
|__Node-gyp__                |
|__VS Build Tools__          |
|__Cmder__                   |

### Clone the Repository


### Checkout the working branch

### Install packages

```shell
composer install
npm install
```

### Setup ENV
- Create an ENV file (`.env`) and place the necessary database information

### DB Migration
```shell
php artisan migrate:fresh
```

## Run locally
- To run locally, you should then have to run the NPM and laravel (if you want to use `laravel serve`)
```shell
npm run dev
```
- Open new terminal and run `artisan serve`
```shell
php artisan serve
```


