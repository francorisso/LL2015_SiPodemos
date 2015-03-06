<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Classes\TextImgProperties;

class PhrasesGenerator extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return \View::make("home");
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (!Auth::check())
		{
		    return response()->json(['error' => 'Not authenticated'],403);
		}

		$text = Request::input("text");

		

		return response()->json(["message"=>"Created successfully"]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	public function createImgWithText($text){
		
		header('Content-Type: image/jpeg');

		//create img from source
		$imgSize = [
			"width" 	=> 770,
			"height" 	=> 403,
		];
		$im = imagecreatefromjpeg( public_path() . "/images/patricia.jpg" );

		//some colors to play along
		$white = imagecolorallocate($im, 255, 255, 255);
		$grey = imagecolorallocate($im, 128, 128, 128);
		$black = imagecolorallocate($im, 0, 0, 0);

		//parse text into lines
		$text = mb_strtoupper( $text, 'UTF-8');
		$lines = preg_split("/::/", trim($text));
		$cleaner = function($value){
			return trim( preg_replace("/([^A-Za-z0-9 ]*)/", "", $value));
		};
		$lines = array_map( $cleaner, $lines );

		//my font
		putenv( 'GDFONTPATH=' . public_path().'/fonts/' );
		$font = 'Black-Regular.ttf';

		// Add lines of text
		$top = 5;
		$fontSize = 50;
		$lineSpacing = 0.2;
		for($i=0; $i<count($lines); $i++){
			$textImgProperties = new TextImgProperties( imagettfbbox($fontSize, 0, $font, $lines[$i]) );
			$left = ($imgSize['width'] - $textImgProperties->width()) / 2.0;
			imagettftext($im, $fontSize, 0, $left, $top + $fontSize, $white, $font, $lines[$i]);
			$top = $top + $fontSize + $fontSize * $lineSpacing;
		}

		imagejpeg($im);
		imagedestroy($im);

		return null;
	}

}
