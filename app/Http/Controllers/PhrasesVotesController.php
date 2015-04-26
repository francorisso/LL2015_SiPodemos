<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Phrases;
use App\Models\PhrasesVotes;
use Auth;

class PhrasesVotesController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$user = Auth::user();
		if (!$user)
		{
		    return response()->json(['error' => 'Not authenticated'],403);
		}

		$phrase_id = $request->input("phrase_id");
		if(empty( $phrase_id )){
			return response()->json(['error' => 'Empty phrase id'], 400);	
		}

		$phrase = Phrases::find($phrase_id);
		if(!$phrase){
			return response()->json(['error' => "Phrase doesn't exists"], 400);		
		}

		$phrase->votes++;
		$phrase->save();

		$phraseVotes = new PhrasesVotes;
		$phraseVotes->user_id = $user->id;
		$phraseVotes->phrase_id = $phrase->id;

		return response()->json(["message"=>"Created successfully", "votes"=>$phrase->votes]);
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
