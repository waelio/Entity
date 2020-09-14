<?php

/**
 * Created by PhpStorm.
 * User: wahbehw
 * Date: 3/5/2016
 * Time: 11:26 AM
 */




class Idea
{
	private $library = array('directions' => array('self', 'up', 'right', 'down', 'left'));
	private $unaryTagArray = array('area', 'base', 'br', 'col', 'command', 'embed', 'hr', 'img', 'input', 'keygen', 'link', 'meta', 'param', 'source', 'track', 'wbr');
	private $type;
	private $attributes;
	private $innerHtml;
	private $ID = null;
	private $name = null;
	private $PASS;

	public function __construct($type = null, $attributeArray = array())
	{

		$this->setType($type);
		$this->initiate($attributeArray);
		foreach ($attributeArray as $attribute => $value) {
			$this->setAttribute($attribute, $value);
		}
	}


	/**
	 * Set an array, can pass an array or a key, value combination
	 *
	 * @param array|string $attribute
	 * @param string $value
	 * @return object $this
	 */
	public function setAttribute($attribute, $value = "")
	{
		if (!is_array($attribute)) {
			$this->attributes[$attribute] = $value;
		} else {
			$this->attributes = array_merge($this->attributes, $attribute);
		}

		return $this;
	}

	/**
	 * Create Password
	 *
	 * @param int $length
	 *
	 * @return string
	 */
	protected function generate_code($length = 64)
	{

		$box_array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '!', '@', '$', '%', '^', '&', '*', '(', ')', '_', '=', '+');
		$password = '';
		for ($x = 0; $x < $length; $x++) {
			$password .= $box_array[intval(array_rand($box_array))];
		}

		$this->PASS = md5($password);

		return $password;
	}



	/**
	 * Initiate
	 *
	 * @param $attributeArray
	 * @param bool|false $force
	 *
	 * @return null|string
	 */
	function initiate($attributeArray)
	{


		$force = (isset($attributeArray['force'])) ? $attributeArray['force'] : false;
		$name = (isset($attributeArray['name'])) ? $attributeArray['name'] : null;

		if (is_null($this->ID)) {
			$this->ID = $this->generate_code(17);
		} elseif (!is_null($this->ID) && $force) {
			$this->ID = $this->generate_code(17);
		} else {
			$this->ID = $this->generate_code(17);
		}



		if (!is_null($name) || !isset($this->attributes['name']))
			$this->attributes['name'] = $name;
		else
			$this->attributes['name'] = $this->identify();

		$this->attributes['id'] = $this->ID;
		$this->attributes['class'] = 'test_div';

		$this->name = ((is_null($this->name)) && (!is_null($this->getAttribute('name')))) ? $this->getAttribute('name') : 'NA';

		return $this->ID;
	}

	public function identify()
	{

		return $this->ID;
	}
	/**
	 * Override/Set Element Type
	 *
	 * @param string $type
	 * @return $this
	 */
	public function setType($type)
	{
		$t = strval($type);
		try {

			$this->type = strtolower($t);
		} catch (exception $e) {
		}

		return $this;
	}

	/**
	 * Get Element Type
	 *
	 * @return string
	 */
	public function getType()
	{
		return ucfirst(strval($this->type));
	}

	/**
	 * Returns the specific Attribute
	 *
	 * @param $attribute
	 * @return mixed
	 */
	public function getAttribute($attribute)
	{
		return $this->attributes[$attribute];
	}

	/**
	 * @return array
	 */
	function displayAttributes()
	{
		return $this->attributes;
	}

	/**
	 * Remove an attribute from an element
	 *
	 * @param $attribute
	 * @return $this
	 */
	function removeAttribute($attribute)
	{
		if (isset($this->attributes[$attribute])) {
			unset($this->attributes[$attribute]);
		}
		return $this;
	}

	/**
	 * Clear an Element Attributes
	 *
	 * Clear all of the element's attributes
	 */
	function clearAttributes()
	{
		$this->attributes = array();
		return $this;
	}

	/**
	 * Set the innerHtml of an element
	 *
	 * @param object || string $object
	 * @return $this
	 */
	function set_content($object)
	{
		$this->innerHtml = $object;
		return $this;
	}

	/**
	 * Echoes out the element
	 *
	 * @return string
	 */
	function display()
	{
		echo $this->build();
		return true;
	}

	/**
	 * Builds the element
	 *
	 * @return string
	 */
	function build()
	{

		// Start the html tag
		$element = "<" . $this->type;

		// Add attributes
		if (count($this->attributes)) {
			foreach ($this->attributes as $key => $value) {
				$element .= " " . $key . "=\"" . $value . "\"";
			}
		}
		$this->attributes['data-name'] = $this->name;
		// Close the element
		if (!in_array($this->type, $this->unaryTagArray)) {
			$element .= ">" . $this->innerHtml . "</" . $this->type . ">\n";
		} else {
			$element .= " />\n";
		}
		return $element;
	}
}
