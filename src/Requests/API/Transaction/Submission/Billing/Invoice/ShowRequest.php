<?php

namespace Projects\WellmedSatuSehat\Requests\API\Transaction\Submission\Billing\Invoice;

use Projects\WellmedSatuSehat\Requests\API\Transaction\Invoice\Environment;

class ShowRequest extends Environment
{

  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [];
  }
}
