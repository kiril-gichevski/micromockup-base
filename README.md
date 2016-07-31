# micromockup-base

A small snippet for fast show cases using PHP

## Why making this micro mockup

It should be used only for fast show cases. I usually use it when I go to job interviews. You have to code something 
and you have to do it fast but the time is limitted and you are not allowed to use a framework, composer, twig, .htaccess....
You just have to do it in the old plain PHP way.But still you want some separation of concerns. The micromockuop-base is a small
MVC "framework" that will help you just start right away not loosing time to make your own structure. 
<b>Time is precious in a conding job interview.</b>

## Usage
You don't need .htaccess.<br/>
You don't need composer.<br/>
Just clone the project from github and you are ready to go. Serve the files on some web server (Apache, Nginx).

## Navigation
The micromockup is just a small MVC so navigation is done through a front controller (index.php).
Beacuse we don't use .htaccess you have to call the index.php in every of your URLs.<br/>
Navigation is done in the next order <b>/index.php/controller/action/argument1/argument2....</b></br>
Navigating to a <b>controllers/page.php</b> and calling the <b>showpages action</b> with an argument <b>5</b> 
would be done like this:<br/>
```js
/index.php/page/showpages/5
```
By default the <b>page controller</b> with the  <b>index action</b> is called.</br>
Note that when passing arguments the function would have to accept the same number of arguments.</br>
For example when navigation to <b>/index.php/page/showpages/5/10</b> your function would look like this:<br/>
```php
public function showpages($firstArgument, $secondArgument)
{
  //logic
}
```

### Assets
#### JavaScript
The JS lives in the <b>assets/js</b> directory
Currently there is a <b>page.js</b> snippet. The page.js uses the singleton pattern but you can write JS your style.
#### CSS
The CSS lives in the <b>assets/css</b> directory.
Currently no snippet is provided.
#### IMG
Place your images in the <b>assets/img</b> directory.

###Config
All the config needed is placed in the config directory.<br/>
What you have to configure is placed in the <b>config/config.php</b>
This is the config used for the database
```php
class Config {
    const DB_HOST = 'localhost';
    const DB_NAME = 'testdb';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = 'root';
}
```
Also you will have to configure the routes in the project.
To do that edit the <b>router.php</b>
```php
$map = [
    'page' => 'Controllers\Page'
];
```
Just add more routes pointing to your controllers.

### Controllers
All the controllers live in the <b>controllers</b> directory.<br/>
Calling a controller in a browser is explained in the [Navigation](#navigation) section. </br>
Currently there is the snippet for the page.php controller.<br/>
Every controller has to inherit from <b>Config\Init</b>.<br/>
In the constructor I usually init the Models I need.<br/>
You will also want to render something on the page so use the <b>render function</b>.<br/>
Small snippet for the render function.
Here is a small snippet.
```php
 public function index()
    {
        $this->render('Name of the view', 'Title of the page', [array of variables]);
        //example
         $this->render('page', 'page', ['page'=>'First page']);
    }
}
```
The complete Controller snippet.
```php
<?php
namespace Controllers;

use Config\Init;
use Db\models\Page as PageModel;

class Page extends Init{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new PageModel($this->connection);
    }
    
    public function index()
    {
        $this->render('page', 'page', ['page'=>'First page']);
    }
}
```
### Models
The modesl live in the <b>db/models</b> directory.<br/>
Make sure to init the PDO connection in the Construstor.
Then just write a normal PDO queries.

###Views
The views live in the <b>views/page</b> directory. <br/>
I won't use any templating engine so we will write a php in our html files. Because we are mixing some php and html the views
should have the <b>.phtml</b> extension.<br/>
In your controllers you pass the variables that you want to access in your view.You pass an array of variables. Accesing the variables
in the views is done by the keys of the array.
```php
<h1><?php echo $vars['page']; ?></h1>
```
Reference your css in the <b>views/head.html</b>.<br/>
Reference your JS in the <b>views/foot.html</b>



