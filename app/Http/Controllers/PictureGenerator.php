<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

use App\Classes\TextImgProperties;
use App\Models\Picture;

class PictureGenerator extends Controller {

	private $imageManager;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
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

		$imagePath = 'I-believe-'. md5(uniqid()) .'.jpeg';
		while( file_exists(storage_path() . '/app/images/' . $imagePath) ){
			$imagePath = 'I-believe-'. md5(uniqid()) .'.jpeg';
		}
		$img->save( storage_path() . '/app/images/' . $imagePath );

		$picture = new Picture;
		$picture->filename = $imagePath;
		$picture->save();

		$imageUrl = action('PictureGenerator@showImage', [ 'id' => $picture->id ]);

		return response()->json([
			"message"		=> "Created successfully",
			"picture"		=> $picture,
			"imageUrl"	=> $imageUrl,
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$picture = Picture::findOrFail( $id );
		$data = [
			'picture' => $picture,
		];

		return \View::make('picture.show', $data);
	}

	/**
	 * Display the image
	 */
	public function showImage($id){
		$picture = Picture::findOrFail( $id );

		header("Content-type: image/jpeg");
		echo readfile($picture->getImagePath());
		return;
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

}
