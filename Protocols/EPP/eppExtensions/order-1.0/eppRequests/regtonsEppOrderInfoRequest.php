<?php
namespace Metaregistrar\EPP;
/*

<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
 <command>
  <info>
   <order:info xmlns:order="http://www.subreg.cz/epp/order-1.0">
    <order:id>856274</order:id>
   </order:info>
  </info>
  <clTRID>SUBREG20120218T020501Z217</clTRID>
 </command>
</epp>

*/

class regtonsEppOrderInfoRequest extends eppRequest {

    function __construct( $orderId) {
        parent::__construct();
        $info = $this->createElement('info');
        $el = $this->createElement('order:info');
        $el->setAttribute('xmlns:order', 'http://www.subreg.cz/epp/order-1.0');
        $id = $this->createElement('order:id', $orderId);
        $el->appendChild($id);
        $info->appendChild($el);
        $this->getCommand()->appendChild($info);
    }

}