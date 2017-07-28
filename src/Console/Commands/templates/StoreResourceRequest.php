<?php

namespace App\Http\Requests;

class StoreResourceRequest extends FormRequestApi {

	public function rules()
	{
		return [
			'street'       => 'required',
			'number'       => 'required',
			'complement'   => '',
			'zip_code'     => 'required',
			'neighborhood' => '',
			'city'         => '',
			'state'        => '',
			'latitude'     => '',
			'longitude'    => '',
		];
	}
}
