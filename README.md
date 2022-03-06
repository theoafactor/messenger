## Messenger
### An email and message sender.

1. Easily sends emails to users 


2. Add the project 

```
	composer require theoafactor/messenger
```

3. Add the following lines at the top of your project:

```
require "vendor/autoload.php";

use Messenger\Messenger;
```

4. Create an instance of the Messenger class

```
	$messeger = new Messenger();
``` 

5. Send your email.

```
	$messenger->sendMessage('recepient@email.com', 'Message Subject', $extra_data_array, "email_template.html");
```

6. The sendMessage() method takes the following arguments:
	
	 - recepient's email address
	 - email subject
	 - some extra data in the form of associative array
	 - the file path of email template to be used

7. Of all the arguments, the recepient's email address and email subject are compulsory, while the others are not. But it's a good thing to set these arguments.


### Setting Environmental Values

1. You should set the environmental values with .env file at the root of your project. Please use the .env.example file as an example.

2. Create a .env file and copy the sample from .env.example file inside theoafactor/messenger/src directory over.

3. Supply the data.




### Using Email Templates

1. The package uses a mini template engine. The engine will look for your email template in the root of the directory.

2. Variables are outputted with {{ variable_name }} within the template.

3. Variables data come from the extra data associative array passed to the sendMessage() method. For example, in the code below, we have set the extra data associate array to have the firstname and lastname keys.
	
```
	$userData = [

		"firstname" => "James",
		"lastname"  => "John"

	];

```

4. In the email template, we can reference the firstname key by using:

	```
		<body>

			<h2>Welcome {{ firstname }}</h2>

		</body>

	```


### Loops

1. This package uses basic looping mechanism and only supports the foreach loop. To loop through an array in the template, follow the sample below:

```
	@foreach(arrayKey as item)
		{{ item }}
	@endforeach
```

2. Remember that the *arrayKey* comes from the data you passed to the sendMessage() method.

3. Support for *nested loops* has not been added.

4. Support for *conditional statements* has not been added.


### Note

1. This project is actively under development. You may use it for your project. You may also contribute to this project by creating a pull request.

2. Please report any security issue as soon as you spot one. 



### Author: Olu Adeyemo [theoafactor@gmail.com]
