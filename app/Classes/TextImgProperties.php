<?php

namespace App\Classes;

class TextImgProperties {
	
	private $X;
	private $Y;

	//args cames from imagettfbbox function
	public function __construct( $args ){
		$this->X = [
			"lower" => [
				"left"  => $args[0],
				"right" => $args[2]
			],
			"upper" => [
				"left"  => $args[6],
				"right" => $args[4]
			]
		];

		$this->Y = [
			"lower" => [
				"left"  => $args[1],
				"right" => $args[3]
			],
			"upper" => [
				"left"  => $args[7],
				"right" => $args[5]
			]
		];
	}

	public function width(){
		return ($this->X["lower"]["right"] - $this->X["lower"]["left"]);
	}

	public function height(){
		return ($this->X["lower"]["right"] - $this->X["lower"]["left"]);
	}
}