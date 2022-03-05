## Messenger
### An email and message sender.

1. Sends email and general message to users 



2. Add the project 

```
	composer require theoafactor/messenger
```

3. Add the following line at the top of your project:

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
	You can set environmental values with .env file at the root of your project. Please use the .env.example file as an example.




### Using Email Templates


### Author: Olu Adeyemo [theoafactor@gmail.com]
