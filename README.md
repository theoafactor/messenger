# DRAGON:
### An email and message sender.

- Sends email and general message to users 



- Add the project 

```
	composer require theoafactor/dragon
```

- Add the following line at the top of your project:

```
use Dragon\Dragon;
```

- Create an instance of the Dragon class

```
	$dragon = new Dragon();
``` 

- Send your email.

```
	$dragon->sendMessage('recepient@email.com', 'Message Subject', $extra_data_array, "email_template.html");
```

### Author: Olu Adeyemo [theoafactor@gmail.com]