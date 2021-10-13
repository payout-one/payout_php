<?php

namespace Payout;

use Exception;

class Refund
{
    public function create($data)
    {
        if (!is_array($data)) {
            throw new Exception('Payout error: Wrong checkout parameters.');
        }

        $refund_required = array(
            'checkout_id',
            'payout_id',
            'iban',
            'statement_descriptor'
        );

        foreach ($refund_required as $required_attribute) {
            if (!key_exists($required_attribute, $data)) {
                throw new Exception("Payout error: Missing required parameter \"$required_attribute\".");
            }
        }

        return $data;
    }
}
