<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Twig {

	private $_loader;
	private $_twig;

	protected $EXT = '.twig';

	public function __construct()
	{
		try {
			$this->_loader = new \Twig\Loader\FilesystemLoader(VIEWPATH);
			
			$this->_twig   = new \Twig\Environment($this->_loader, [
				'debug' => ENVIRONMENT !== 'production',
			    'cache' => ENVIRONMENT !== 'development' ? APPPATH . 'cache' : false,
			    'strict_variables' => ENVIRONMENT === 'testing' ? true : false,
			]);
		} catch (Exception $e) {
			show_error($e->getMessage(), 500, 'Twig Exception');
		}
	}

	public function load($file)
	{
		return $this->_twig->load($file . '.' . $this->EXT);
	}

	public function render($file, $data = [])
	{
		try {
			return $this->_twig->render($file . $this->EXT, $data);
		} catch (Exception $e) {
			show_error($e->getMessage(), 500, 'Twig Exception');
		}
	}

	public function add_function($name, $function = NULL)
	{
		if ( $function === NULL ) {
			$function = $name;
		}
		$function = new \Twig\TwigFunction($name, $function);
		$this->_twig->addFunction($function);
	}
}
