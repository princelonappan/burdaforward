## Overview

This application provides the following features.

- File based configuration for a router component
- Display and Validate the parameters
- Logic for to handling the routes based on the controllers

## Requirements and dependencies

- PHP >= 7.2

## Features
- The system will set routes dynamically based on controller files, controller file name should of the format `{Controllername}Controller.php` and the route will be dynamically set as `/controllername`.
- Need to add the index method (default method) in the controller and create the view files in the Views folder and pass and assign values to the view.
- Sample files are added in the Controllers folder.
- The parameters can be given `/controllername/{parameter1}/{parameter2}/parameter3`, and the parameters are validated in the number format.
- For example, the following routes will work in this current project.
- `http://localhost:8081/blog/2021/10/2`
- `http://localhost:8081/product/123`
- `http://localhost:8081`
- Upto 3 parameters has been rendered to view, but the count can be changed in the code.
- Twig template engine has been used to render the data in the application
- The base URL will be rendered from the Index controller. For all the controllers, the default method is added as 'index'.

## Installation

First, clone the repo:
```bash
$ git clone https://github.com/princelonappan/burdaforward.git
```

#### Running as a Docker container

The following docker command will run the application.

- Update the document path in the phpunit.xml.dist file

```
$ cd burdaforward
$ docker-compose up -d
```
This will start the application.

#### Run on local using without docker

The following docker command will run the application.

```
$ cd burdaforward
$ composer install
$ php -S localhost:8005
```
This will start the application.

#### Run Test

- Identify the container id by running '**docker ps**'
- Run the following command - 
- **docker exec -ti *containerid* bash**
- Run the command **php vendor/bin/phpunit tests/**

