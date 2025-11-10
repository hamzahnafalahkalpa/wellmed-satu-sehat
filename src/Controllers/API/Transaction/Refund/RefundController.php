<?php

namespace Projects\WellmedSatuSehat\Controllers\API\Transaction\Refund;

use Projects\WellmedSatuSehat\Requests\API\Transaction\Refund\{
    ViewRequest, ShowRequest
};

class RefundController extends EnvironmentController{
    public function index(ViewRequest $request){
        return $this->getRefundPaginate();
    }

    public function show(ShowRequest $request){
        return $this->showRefund();
    }
}