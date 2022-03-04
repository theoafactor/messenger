## Messenger
### An email and message sender.

- Sends email and general message to users 



- Add the project 

```
	composer require theoafactor/messenger
```

- Add the following line at the top of your project:

```
use Messenger\Messenger;
```

- Create an instance of the Messenger class

```
	$messeger = new Messenger();
``` 

- Send your email.

```
	$messenger->sendMessage('recepient@email.com', 'Message Subject', $extra_data_array, "email_template.html");
```

### Author: Olu Adeyemo [theoafactor@gmail.com]
