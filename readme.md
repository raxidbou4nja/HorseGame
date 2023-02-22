# Simple MVC PHP
This is a simple Model-View-Controller (MVC) PHP application that provides a basic framework for building web applications. The purpose of this project is to provide an easy-to-understand example of how MVC works in PHP and to serve as a starting point for building more complex applications.

## Getting Started
To get started with this application, you need to have PHP and a web server (such as Apache) installed on your machine. You can then clone the repository and run the application locally.

bash
``` 
git clone https://github.com/raxidbou4nja/smvc.git
cd smvc
```

Import the file mvc.sql from /db_file folder to your database.
Connect your project to database by editing app/config/config.php

``` 
  // DB Params
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'mvc');

  // App Root
  define('APPROOT', dirname(dirname(__FILE__)));
  // URL Root
  define('URLROOT', 'http://localhost/FOLDER');
  // Site Name
  define('SITENAME', 'Project Name');
  // App Version
  define('APPVERSION', '1.0.0');
``` 
## Structure
``` 
.htaccess
readme.md
├── app
      ├── config
      ├── controllers
      ├── helpers
      ├── libraries
      ├── models
      ├── views
      .htaccess
      bootstrap.php
├── public
      ├── css
      ├── img
      ├── js
      .htaccess
      index.php
``` 
The application is structured according to the MVC pattern. The index.php file serves as the entry point for the application and is responsible for routing requests to the appropriate controller. The app directory contains the application code, organized into the following directories:

controllers: Contains the controller classes that handle incoming requests and generate responses.
models: Contains the model classes that interact with the database or other data sources.
views: Contains the view files that display the data to the user.

### Routing
The index.php file defines the routing logic for the application. It reads the URL of the incoming request and determines which controller and method to call based on the URL. For example, a request to http://localhost/user/edit/1 would be routed to the UserController and the edit method with a parameter of 1.

### Controllers
The controller classes in the controllers directory handle incoming requests and generate responses. Each method in a controller corresponds to a particular action that the user can take, such as displaying a page, submitting a form, or processing a search query. The controller methods interact with the model classes to retrieve and manipulate data, and then pass the data to the appropriate view for display.

### Models
The model classes in the models directory represent the data and business logic of the application. They interact with the database or other data sources to retrieve and store data, and provide methods for manipulating that data.

### Views
The view files in the views directory display the data to the user. They are responsible for generating the HTML and CSS that make up the user interface. Views receive data from the controller and use it to dynamically generate the HTML that is sent to the user's browser.

## Conclusion
This simple MVC PHP application provides a basic framework for building web applications. It demonstrates the separation of concerns between the model, view, and controller, and shows how they work together to create a functional application. By building upon this framework, you can create more complex applications with additional features and functionality.
