# Verfico [Under Dev]
A lightweight PHP email verification plugin for your current user system. 

### About
Verfico is a very lightweight PHP system that is fully contained and can be set up in under five minutes. It provides another layer of security for your website and can restrict users based on whether or not they're verified.

### Setup
1. Fill in the settings.php session variables. These are used throughout Verfico. 
2. Run ```setup.php``` with the ```?setup=1``` flag to create tables and other dependancies. 
3. See integration below to see how to add the system to your website. 

### Integration
Integration is pretty simple, there are a few standard functions that you'll need to know:<br>
* ```$ver->verifyUser(); ```: Used by verify.php in order to set the user to 'Verified' status in the DB.
* ```$ver->isVerified($uid); ```: Used to check if the user is verified. Will return true/false depending on result. _Optional: Add a UID parameter in the params to specify a user. Otherwise will default to current user._
* ```$ver->requestVerification($email) ```: Sends a verification request to the user via the mail() function. I will be looking at a better way to do this as the standard mail() function is awful.
* ```$ver->resendVerification($email) ```: Used if a user requests that their verification email is resent. It resets the verifykey and deletes previous instances of a verification request. 
* ```$ver->cancelVerification($email)```: 

### Usage
The following describes the general 'flow' of the system from the user's point of view. <br>
1. Email verification email will be requested or dispatched depending on your needs. 
2. The user will click the link in their email. 
3. They will be sent to verify.php that checks their details. 
4. If correct, the User will be verified.
