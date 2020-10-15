# User Registration (Havi Hackathon Solution)

Application can be accessed at: https://havi-hackthon.herokuapp.com/

Application support below functionality:
* Registration 
* Login

Different fields supported for Registration:

Username
Email
Date of Birth (DOB)
Phone NO
Password

This application is developed using PHP and Posetgres deployed on Heroku

## API Details

* `POST /login` - Validates useername and password  and allow th euser to login
* `POST /vsignup` Register the user with provided details

## Instruction to develop and deploy
* Login to heroku cli
* Clone this repository
* Run below commads after making changes:
```
git add .
git commit -m "Change message"
git push heroku main
```
