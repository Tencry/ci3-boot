<?php

class Remove {

	private $app_dir = 'app2';
	private $public_dir = 'public2';

	public function app()
	{
		if (PHP_OS !== 'Linux') die('Setup runs on Linux only.'.PHP_EOL);

		exec("rm -r {$this->app_dir} {$this->public_dir}");
	}
}

(new Remove())->app();
