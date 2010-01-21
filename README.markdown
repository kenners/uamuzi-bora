Uamuzi Bora
===========

A basic HIV Electronic Medical Record (EMR) system using CakePHP.

http://uamuzibora.com


Deploying
---------

We're going to assume that you have a standard installation of [CakePHP][1].  We
run the code using lighttpd and PostgreSQL; CakePHP is in what they term
"production mode" (so the document root is `/www/app/webroot`) with pretty URLs
via [mod_magnet][2].  If your setup differs to this then you'll need to adjust 
accordingly.

To get a copy of our code, you can either go to the [downloads page][3] over
at GitHub, or pull the latest development head directly from the repository:

    % git clone git://github.com/kenners/uamuzi-bora.git

Create `/www/app/config/database.php` with your database settings as per the 
[CakePHP manual][4].  Import `/schema.sql` into your database.  Visit the 
following two addresses to build some ACL-related tables:

    http://<domain>/users/buildAcl
    http://<domain>/users/initDB

This will set up the initial username/passwords of user/user and admin/admin.

Finally, if you're running in a production environment you'll want to tweak 
`/www/app/config/core.php` as required (look in particular at changing `debug` 
and `Security.salt`).

[1]: http://cakephp.org/ "CakePHP"
[2]: http://book.cakephp.org/view/782/Pretty-URLs-and-Lighttpd "CakePHP: Pretty URLs and Lighttpd"
[3]: http://github.com/kenners/uamuzi-bora/downloads "GitHub downloads"
[4]: http://book.cakephp.org/view/40/Database-Configuration "CakePHP: Database Configuration"


Contributing/Patches/Bug Fixes
------------------------------
 
* Fork the project.
* Make your feature addition or bug fix.
* Do not change stuff in /www/config directory.
* Commit.
* Send us a pull request.


Copyright
---------

Copyright (c) 2009 Uamuzi Bora. Licensed under the BSD License. See LICENSE.txt for details.
