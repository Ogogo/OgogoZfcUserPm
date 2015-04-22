OgogoZfcUserPm
=======
[![Build Status](https://travis-ci.org/Ogogo/OgogoZfcUserPm.svg?branch=master)](https://travis-ci.org/Ogogo/OgogoZfcUserPm)
[![Code Climate](https://codeclimate.com/github/Ogogo/OgogoZfcUserPm/badges/gpa.svg)](https://codeclimate.com/github/Ogogo/OgogoZfcUserPm)
[![Test Coverage](https://codeclimate.com/github/Ogogo/OgogoZfcUserPm/badges/coverage.svg)](https://codeclimate.com/github/Ogogo/OgogoZfcUserPm)
[![Latest Stable Version](https://poser.pugx.org/ogogo/ogogo-zfc-user-pm/v/stable.svg)](https://packagist.org/packages/ogogo/ogogo-zfc-user-pm)
[![Latest Unstable Version](https://poser.pugx.org/ogogo/ogogo-zfc-user-pm/v/unstable.svg)](https://packagist.org/packages/ogogo/ogogo-zfc-user-pm)
[![Total Downloads](https://poser.pugx.org/ogogo/ogogo-zfc-user-pm/downloads.svg)](https://packagist.org/packages/ogogo/ogogo-zfc-user-pm)
[![License](https://poser.pugx.org/ogogo/ogogo-zfc-user-pm/license.svg)](https://packagist.org/packages/ogogo/ogogo-zfc-user-pm)

Introduction
------------
OgogoZfcUserPm is a basic private message module which allows for sending of messages between users.   

By default this module works with Doctrine ORM(through the DoctrineORM mapper). 
It's very easy to add your own mapper, ZendDb for example.   
1. Create your custom mapper   
2. Change the mapper in the config, to point to your custom mapper

Note: This module is meant to be very basic and only contain very basic, common, functionality.
More functionality will be available through extensions, please see below.

Functionality
------------
* Send messages between users
* Group conversations
* Delete conversations(not deleted from database, only from user)

Requirements
------------
#### Hard
- PHP 5.4
- [OgogoBase](https://github.com/Ogogo/OgogoBase)
- [ZfcUser](https://github.com/ZF-Commons/ZfcUser)

#### Soft
- [ZfcUserDoctrineORM](https://github.com/ZF-Commons/ZfcUserDoctrineORM) For use with Doctrine mapper

Installation
------------
#### With composer

1. Add this project composer.json:

    ```json
    "require": {
        "ogogo/ogogo-zfc-user-pm": "dev-master"
    }
    ```

2. Now tell composer to download the module by running the command:

    ```bash
    $ php composer.phar update
    ```
    
3. Copy config/ogogo.zfcuser.pm.global.php.dist to your autoload folder (`config/autoload/`)

4. Import the database schema into your database. A SQL schema is located in `data/schema.sql`

5. Enable it in your `application.config.php` file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'Ogogo\ZfcUser\Pm'
        ),
        // ...
    );
    ```
    
Extensions
------------
- [OgogoZfcUserPmFolders](https://github.com/Ogogo/OgogoZfcUserPmFolders) - Put conversations into folders
- [OgogoZfcUserPmSearch](https://github.com/Ogogo/OgogoZfcUserPmSearch) - Search for conversations
- [OgogoZfcUserPmStar](https://github.com/Ogogo/OgogoZfcUserPmSearch) - Star important conversations
