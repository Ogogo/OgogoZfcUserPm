basic private messages

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
 
