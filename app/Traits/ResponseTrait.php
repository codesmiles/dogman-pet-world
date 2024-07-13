<?php
namespace App\Traits;

trait ResponseTrait
{
    function sendResponse($data, $response_code_object)
	{
        /*
        |--------------------------------------------------------------------------
        | add comments
        |--------------------------------------------------------------------------
        */
		$payload = $response_code_object->toString();
		$payload['data'] = $data;

        /*
        |--------------------------------------------------------------------------
        | add comments
        |--------------------------------------------------------------------------
        */
		return response()->json($payload, 200);

	}
}
