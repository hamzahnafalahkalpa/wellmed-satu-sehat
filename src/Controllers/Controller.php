<?php

namespace Projects\WellmedSatuSehat\Controllers;

use App\Http\Controllers\Controller as MainController;
use Projects\WellmedSatuSehat\Concerns\HasUser;

abstract class Controller extends MainController
{
    use HasUser;
}
