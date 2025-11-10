<?php

namespace Projects\WellmedSatuSehat\Requests\API\Transaction\Submission\Billing;

use Projects\WellmedSatuSehat\Requests\API\Transaction\Billing\Environment;

class ViewRequest extends Environment
{

  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
    ];
  }
}