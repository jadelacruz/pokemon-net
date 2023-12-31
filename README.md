# Pokemon Network

## Table of Contents
- [Installation Locally](#installation-locally)
  - [Requirements](#requirements)
  - [Clone the Repository](#clone-the-repository)
  - [Checkout the working branch](#checkout-the-working-branch)
  - [Install Packages](#install-packages)
  - [Setup ENV](#setup-env)
  - [DB Migration](#db-migration)
- [Run Locally](#run-locally) 

## Installation Locally
### Requirements
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
```shell
git clone https://github.com/jadelacruz/pokemon-net.git
```

### Checkout the working branch
```shell
git checkout master # or develop
```

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


