<?php

namespace App\Http\Controllers\Traits;

use App\Exceptions\ValidatorException;

trait Helpers
{
    public function validator($rulesName, $needs = null)
    {
        $rules = config("rules.{$rulesName}");

        $needs = $needs ? : request()->only(array_keys($rules));

        $result = \Validator::make($needs, $rules);

        if (!$result->fails()) return $needs;

        throw new ValidatorException($result->errors()->first());
    }
}
