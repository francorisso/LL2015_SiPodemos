<?php namespace App\Http\Controllers;

use App\Models\Picture;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = [];
		return \View::make("home", $data);
	}

	public function show($id)
	{
		try {
			$picture = Picture::findOrFail($id);
			$image = action('PictureGenerator@showImage', [ 'id' => $picture->id ]);
			$ogtags = $this->ogtags([
				'description' => "Hace click en la imagen y generá tu propio cartel. Juntos podemos desafiar la vieja política y recuperar los sueños de nuestra ciudad. #SíPodemos.",
				'url' => 'http://sipodemos.lisandrolicari2015.com.ar/'.$picture->id,
				'image' => $image,
			]);
		}
		catch(\Exception $e){
			$picture = null;
			$ogtags = $this->ogtags();
		}
		$data = [];
		$data['ogtags'] = $ogtags;

		return \View::make("home", $data);
	}

	private function ogtags($tags=[])
	{
		$tags = array_merge([
			'type'	=> 'website',
			'title' => 'Sí Podemos - Lisandro Licari 2015',
			'url'   => 'http://sipodemos.lisandrolicari2015.com.ar/',
			'description' => "Hace click en la imagen y generá tu propio cartel. Juntos podemos desafiar la vieja política y recuperar los sueños de nuestra ciudad. #SíPodemos.",
			'image' => '',
 		], $tags);

 		return $tags;
	}

}
