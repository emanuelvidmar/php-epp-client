<?php
namespace Metaregistrar\EPP;
/**
 * Class regtonsEppOrderInfoResponse
 * @package Metaregistrar\EPP
 *
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
<response>
<result code="1000">
<msg lang="en">Command completed successfully</msg>
</result>
<resData>
<order:infData xmlns:order="http://www.subreg.cz/epp/order-1.0">
<order:id>856274</order:id>
<order:domain>yourdomain.cz</order:domain>
<order:type>Modify_Domain</order:type>
<order:status>Pending_Authorization</order:status>
<order:lastupdate>2012-02-18T02:02:03.0Z</order:lastupdate>
<order:message>jdoe@example.com</order:message>
<order:payed>1</order:payed>
<order:amount>0.00</order:amount>
</order:infData>
</resData>
<trID>
<clTRID>SUBREG20120218T020501Z217</clTRID>
<svTRID>SUBREG20120218T020501Z315</svTRID>
</trID>
</response>
</epp>


 */
class regtonsEppOrderInfoResponse extends eppResponse {

    function __construct() {
        parent::__construct();
    }

    public function getInfo() {
        $xpath = $this->xPath();
        $xpath->registerNamespace('order', 'http://www.subreg.cz/epp/order-1.0');
        $result = $xpath->query('//order:infData/*');
        if ($result->length > 0) {
            $data = [];
            foreach ($result as $item) {
                $key = str_replace('order:', '', $item->nodeName);
                $data[$key] = $item->nodeValue;
            }
            return $data;
        }

        return null;
    }
}