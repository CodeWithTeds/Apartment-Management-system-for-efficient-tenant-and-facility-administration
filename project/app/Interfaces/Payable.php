<?php

namespace App\Interfaces;

interface Payable
{
    public function getPayableName();
    public function getPayableEmail();
    public function getPayableAmount();
    public function getPayableDescription();
    public function getSuccessUrl();
    public function getCancelUrl();
}
