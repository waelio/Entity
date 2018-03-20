<?php
/**
 * Created by PhpStorm.
 * User: wahbehw
 * Date: 3/5/2016
 * Time: 1:10 PM
 */

//namespace Idea;


class Element
{
	private $type;
	private $unaryTagArray = array('area','base','br','col','command','embed','hr','img','input','keygen','link','meta','param','source','track','wbr');
	private $attributes;
	private $innerHtml;
	private $children;

	/**
	 * Element constructor.
	 * @param $type string
	 * @param array $attributeArray
	 */
	public function Element($type = null, $attributeArray = array())
	{
		$this->attributes = array();
		if(!is_null($type)){
			$this->type = strtolower(strval($type));
			foreach($attributeArray as $attribute => $value) {
				$this->setAttribute($attribute, $value);
			}
		}else{
			$this-> type = 'temp';
			foreach($attributeArray as $attribute => $value) {
				$this->setAttribute($attribute, $value);
			}
		}
		return $this;
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
		if(!is_array($attribute)) {
			$this->attributes[$attribute] = $value;
		}
		else {
			$this->attributes = array_merge($this->attributes, $attribute);
		}

		return $this;
	}

	/**
	 * Get Element Type
	 *
	 * @return string
	 */
	public function getType(){
		return ucfirst(strval($this->type));
	}

	/**
	 * Override/Set Element Type
	 *
	 * @param string $type
	 * @return $this
	 */
	public function setType($type){
		$this->type = strtolower($type);

		return $this;
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
	function displayAttributes(){
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
		if(isset($this->attributes[$attribute])) {
			unset($this->attributes[$attribute]);
		}
		return $this;
	}

	/**
	 * Clear an Element Attributes
	 *
	 * Clear all of the element's attributes
	 */
	function clearAttributes() {
		$this->attributes = array();
		return $this;
	}

	/**
	 * Inject an Element into the current Element
	 *
	 * @param $object
	 * @return $this
	 */
	function inject($object)
	{
		if(@get_class($object) == __class__) {

			$this->innerHtml .= $object->build();

		}elseif(is_string($object)){

			$this->innerHtml .= $object;

		}
		return $this;
	}

	/**
	 * Set Inline Styling
	 *
	 * @param string $cssAt
	 * @param string $value
	 *
	 * @return object
	 */
	function  setStyle($cssAt,$value){
		//@TODO enhance this functionality to allow additions/modifications and deletion
		$this->setAttribute("style", "$cssAt:$value;");


		return $this;
	}


	/**
	 * Set the innerHtml of an element
	 *
	 * @param object|string $object
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
	}

	/**
	 * Builds the element
	 *
	 * @return string
	 */
	function build(){
		// Start the tag
		$element = "<".$this->type;
		// Add attributes
		if(count($this->attributes)) {
			foreach($this->attributes as $key => $value) {
				$element .= " ".$key."=\"".$value."\"";
			}
		}
		// Close the element
		if(!in_array($this->type, $this->unaryTagArray)) {
			$element.= ">" . $this->innerHtml . "</".$this->type.">\n";
		}
		else {
			$element.= " />\n";
		}
		return $element;
	}


}
