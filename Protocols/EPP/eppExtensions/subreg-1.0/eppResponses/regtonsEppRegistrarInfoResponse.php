<?php
namespace Metaregistrar\EPP;
/**
 * Class regtonsEppRegistrarInfoResponse
 * @package Metaregistrar\EPP
 *
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
<response>
<result code="1000">
<msg lang="en">Command completed successfully</msg>
</result>
<resData>
<registrar-info:infData xmlns:registrar-info="urn:ietf:params:xml:ns:registrar-info-1.0">
<registrar-info:id>AVANTSI</registrar-info:id>
<registrar-info:user>AVANTSI</registrar-info:user>
<registrar-info:ctID>AVANTSI</registrar-info:ctID>
<registrar-info:status s="ok"></registrar-info:status>
<registrar-info:portfolio>
<registrar-info:balance>0.00</registrar-info:balance>
<registrar-info:threshold>0.00</registrar-info:threshold>
</registrar-info:portfolio>
</registrar-info:infData>
</resData>
<trID>
<svTRID>SUBREG20180219T121108ZCDC</svTRID>
</trID>
</response>
</epp>


 */
class regtonsEppRegistrarInfoResponse extends eppResponse {

    function __construct() {
        parent::__construct();
    }

    public function getBalance() {
        $xpath = $this->xPath();
        $result = $xpath->query('//registrar-info:balance');
        if ($result->length > 0) {
            return $result->item(0)->nodeValue;
        } else {
            return null;
        }
    }
}