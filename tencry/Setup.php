<?php

class Setup {

	private $app_dir = 'app2';
	private $public_dir = 'public2';

	private function copyApp()
	{
		exec("cp -r vendor/codeigniter/framework/application {$this->app_dir}");
		exec("mkdir {$this->public_dir} && cp vendor/codeigniter/framework/index.php {$this->public_dir}/index.php");
	}

	private function configApp()
	{

		// edit public/index.php file
		$index_file = file_get_contents("{$this->public_dir}/index.php");
		$index_file = str_replace(
			[
				"\$system_path = 'system';", 
				"\$application_folder = 'application';"
			], 
			[
				"\$system_path = '../vendor/codeigniter/framework/system';", 
				"\$application_folder = '../{$this->app_dir}';"
			], 
			$index_file);
		file_put_contents("{$this->public_dir}/index.php", $index_file);

		// create public/.htaccess file
		file_put_contents("{$this->public_dir}/.htaccess", "
SetEnv CI_ENV development
#SetEnv CI_ENV testing
#SetEnv CI_ENV production

RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
		");

		// edit app/config/config.php
		$config_file = file_get_contents("{$this->app_dir}/config/config.php");
		$config_file = str_replace(
			"\$config['composer_autoload'] = FALSE;",
			"\$config['composer_autoload'] = realpath(FCPATH . '../vendor/autoload.php');",
			$config_file
		);
		file_put_contents("{$this->app_dir}/config/config.php", $config_file);

	}

	private function installLibs()
	{
		exec("cp tencry/libraries/Twig.php {$this->app_dir}/libraries/Twig.php");
	}

	public function run()
	{
		if (PHP_OS !== 'Linux') die('Setup runs on Linux only.'.PHP_EOL);

		// install CI3
		$this->copyApp();

		// config CI3
		$this->configApp();

		// install my libraries
		$this->installLibs();
	}
}

(new Setup())->run();