<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Twig {

	private $_loader;
	private $_twig;

	protected $EXT = 'twig';

	public function __construct()
	{
		$this->_loader = new \Twig\Loader\FilesystemLoader(VIEWPATH);
		$this->_twig   = new \Twig\Environment($this->_loader, [
			'debug' => ENVIRONMENT !== 'production',
		    'cache' => ENVIRONMENT !== 'development' ? APPPATH . 'cache' : false,
		    'strict_variables' => ENVIRONMENT === 'testing' ? true : false,
		]);
	}

	public function load($file)
	{
		return $this->_twig->load($file . '.' . $this->EXT);
	}

	public function render($file, $data = [])
	{
		return $this->_twig->render($file . '.' . $this->EXT, $data);
	}
}
