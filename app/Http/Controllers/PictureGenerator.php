<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

use App\Classes\TextImgProperties;
use App\Models\Phrases;

class PictureGenerator extends Controller {

	private $imageManager;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = [];

		$data['phrasesTop'] = Phrases::orderBy("votes","desc")->take(10)->get();

		return \View::make("home", $data);
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
	public function store(Request $request, ImageManager $imageManager)
	{
		$image = $request->input('image');
		$img = $imageManager->make($image);

		$img->save(storage_path() . '/app/images/test.jpg');

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
		$phrase = Phrases::findOrFail( $id );

		return \View::make("phrases.show",[
			"phrase"=>$phrase
		]);
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


	public function createImgWithText($id){

		header('Content-Type: image/jpeg');

		$phrase = Phrases::findOrFail( $id );

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
		$lines = preg_split("/<br.?\/\>/", trim($phrase->phrase));
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
