$ composer install
$ cp -r vendor/codeigniter/framework/application app
$ mkdir public && cp vendor/codeigniter/framework/index.php public/index.php
$ cp -r vendor/codeigniter/framework/user_guide public/guide # copy user guide to public
# edit public/index.php
line 100: $system_path = '../vendor/codeigniter/framework/system';
line 117: $application_folder = '../app';