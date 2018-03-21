<?php
namespace Metaregistrar\EPP;

class regtonsEppRenewResponse extends eppResponse {
    function __construct() {
        parent::__construct();
    }

    function __destruct() {
        parent::__destruct();
    }

    public function getOrderId() {

        $xpath = $this->xPath();
        $xpath->registerNamespace('order', 'http://www.subreg.cz/epp/order-1.0');
        $result = $xpath->query('//order:creData/order:id');
        if (is_object($result) && ($result->length > 0)) {
            return trim($result->item(0)->nodeValue);
        } else {
            return null;
        }
    }


}
