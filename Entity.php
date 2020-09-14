<?php

/**
 * Created by PhpStorm.
 * User: wahbehw
 * Date: 2/1/2016
 * Time: 9:26 AM
 */

//namespace entity_object;


class Entity
{

	private $library = array('directions' => array('self', 'up', 'right', 'down', 'left'));
	private $ID = null;
	private $PASS;
	private $name;
	private $is_Parent = false;
	private $is_child = false;

	function __construct($name = null)
	{

		return $this->initiate($name);
	}

	/**
	 * possibilities??
	 * 1. COMMAND: initiation
	 * this command will create the object but requires few things:
	 *             a. the creator relation [up,down,right,left]
	 *             b. the creator ID
	 *             c. set of commands [initiate,destroy[commands],call[],identify,bounce[],pass[]]
	 *             d. listen
	 *             e. whisper
	 *
	 *
	 */

	/**
	 * @param int $length
	 *
	 * @return string
	 */
	protected function generate_code($length = 64)
	{

		$box_array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 'jhg', 'RTJ', 'ZCG', '{;G', 'KRA', '!', '@', '$', '%', '^', '&', '*', '(', ')', '_', '=', '+');
		$password = '';
		for ($x = 0; $x < $length; $x++) {
			$password .= $box_array[intval(array_rand($box_array))];
		}

		$this->PASS = $this->encrypt($password);

		return $password;
	}

	function encrypt($val)
	{
		return md5($val);
	}


	function initiate($name, $force = false)
	{

		if (is_null($this->ID)) {
			$this->ID = $this->generate_code(17);
		} elseif (!is_null($this->ID) && $force) {
			$this->ID = $this->generate_code(17);
		} else
			$this->ID = $this->generate_code(17);



		if (!is_null($name) && is_null($this->name))
			$this->name = $name;
		else
			$this->name = $this->identify();

		return $this->ID;
	}


	protected function run($params, $commands)
	{

		foreach ($params as $k => $v) {
			$this->{$k} = $v;
		}
		foreach ($commands as $command) {
			foreach ($command as $function => $args) {
				if (isset($this->{$function})) {
					return call_user_func_array($this->{$function}, $args);
				}
			}
		}
		return false;
	}


	public function identify()
	{

		return $this->ID;
	}

	function _create($commands, $params)
	{

		if (in_array($params['direction'], $this->library['directions'])) {
			if ($params['direction'] != 'self')
				return new Entity($params['direction'], $commands);
			else
				return $this->identify();
		}

		$this->initiate('self', 'identify');


		return $this->initiate('self', 'identify');
	}
}
