<?php

return [
    'laravel_common_validation' => [
		'string_required' => 'required|min:2|max:64',
		'numeric_required' => 'required|numeric',
		'flag_zero_or_one_required' => 'required|numeric|min:0|max:1',
		'string_nullable' => 'nullable|min:2|max:64',
		'phone_number_nullable' => 'nullable',
	]
];
