<?php

include 'config.php';

class Remove {

	private $app_dir = 'application';
	private $public_dir = 'public_html';

	public function __construct()
	{
		global $config;

		if (isset($config['app_dir'])) {
			$this->app_dir = $config['app_dir'];
		}

		if (isset($config['public_dir'])) {
			$this->public_dir = $config['public_dir'];
		}
	}

	public function app()
	{
		if (PHP_OS !== 'Linux') die('Setup runs on Linux only.'.PHP_EOL);

		exec("rm -r {$this->app_dir} {$this->public_dir}");
	}
}

(new Remove())->app();
