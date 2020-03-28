<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResourceRequest extends FormRequest {

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
