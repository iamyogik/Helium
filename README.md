# Helium

This short piece of code will help you with creating your API and handling URL parameters with slashes like - 
```
http://example.com/param1/param2/param3?param4=xxx
```
Usually, this code will take you inside the param3 folder whose location is : *home/param1/param2/param3*.
But this library will help you to pass all the data as parameters or perform a particular action for different data given in the URL differentiated by the slashes.

Enough of talks lets get into some coding...


## Getting Started

Clone or download the repository to your local machine.The downloaded  folder will basically contain 3 folders:
```
├── home
    ├── src
    |   └──Helium.php
    ├── htaccess
    |   └──.htaccess
    └──examples
        └──index.php
```

## Installing

The installation is pretty simple. Just copy the .htaccess file to the root of your home directory. Move the file named __*Helium.php*__ from the __*src*__ to __*/Helium*__ in your root directory. Now you can either create a new index.php file in the root directory or copy the one from __*/example*__ folder. If you use the example file then you don't need to do the rest of the installation as most of the code if pre-written.

   #### If creating a new index.php
   
- Include the __*Helium.php*__ into the __*index.php*__
```
require __DIR__ . '/Helium/Helium.php';
```

- Instantiate the __*Helium*__ Class.
```
$mHelium = new Helium();
```
The basic setup is done here now let's move on to the code that handles the URL parameters.


## Get the Url (RUN)

The usual RUN code looks something like this:

```
$mHelium->Run("param1/param2/param3", function(){
  # code...
});
```
In the code above the __Run__ function takes in two parameters 
1. List of parameters that will be passed in the URL.
2. The function that will run if the above parameters match to the ones in the URL.

If the URL is: `http://example.com/param1/param2/param3` then the function passed above will run. Replace the "# code..." with your own code that you want to run. 


## Get the variable(changing) URL:

In case if one or more of the parameters of your URL keeps changing and you still want to run the same function on all of them then you can use this method.

Example: 
- `http://example.com/param1/cat/param3`
- `http://example.com/param1/dog/param3`
- `http://example.com/param1/rat/param3`

All these url with different second parameter can trigger the same function using the code below:

```
$mHelium->Run("param1/{animal}/param3", function($data){
  extract($data);
  # code...
});
```
The parameter inside __`"{ }"`__ will be treated as a variable. Here we need to pass the __`$data`__ inside the function as a parameter
and also use __`extract($data);`__ inside the function in order to get the parameter passed instead of `{animal}`.
After this, you can easily use the `$animal` inside your code which will give you the value of the passed parameter.

You can use multiple variable parmeters such as : `param1/{animal}/{food}/best/{type}/nutrients ........`
All you need to do is pass `$data` in the function and also `extract($data);` and you will get the values of parameters in variables as: $animal, $food, $type, .......


## The Blank Parameter

What if the user does not pass any parameter in the URL and just tries to open `http://example.com`.
Then you can use the code below to show a home page.

```
$mHelium->Run("", function(){
  # code...
});
```

## The Default Function

If your user passes a URL parameter for which you have not defined any Function then you want to show a default function.

```
$mHelium->setDefault(function(){
  # code...
});
```

The above code will run the function if the user enters an invalid URL which you have not defined in the `index.php`. You can use this in order to show a `404 error` or any other custom text that you may like.


## Trigger the Default Function

If the URL parameters are fine but still after processing the data you feel something wrong and want to show the user the default page/function then you can use this code.

```
$mHelium->Run("param1/param2/{checkSomething}", function(){
  extract($data);
    global $mHelium,
  
  $mHelium->triggerDefault();
});
```

The `$mHelium->triggerDefault();` will trigger the default function in and stop all the processes.

## Use For API

This Library has been made in such a way that you can easily use it for creating API with PHP without using any other MVC format library.

__Your thoughts and suggestions about the repo are valuable for us.__



## Authors

* **Yogesh Kumawat** 



## License

This project is licensed under the MIT License - see the LICENSE.md file for details

