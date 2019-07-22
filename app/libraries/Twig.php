<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Twig {

	private $_loader;
	private $_twig;

	public function __construct()
	{
		$this->_loader = new \Twig\Loader\FilesystemLoader(VIEWPATH);
		$this->_twig   = new \Twig\Environment($this->_loader, [
			'debug' => ENVIRONMENT !== 'production',
		    'cache' => ENVIRONMENT === 'production' ? APPPATH . 'cache' : false,
		    'strict_variables' => ENVIRONMENT === 'testing' ? true : false,
		]);
	}

	public function load($file)
	{
		return $this->_twig->load($file);
	}

	public function render($file, $data = [])
	{
		return $this->_twig->render($file, $data);		
	}
}
