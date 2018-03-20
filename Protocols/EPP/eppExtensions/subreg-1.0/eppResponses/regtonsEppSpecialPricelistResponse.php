<?php
namespace Metaregistrar\EPP;
/**
 * Class regtonsEppSpecialPricelistResponse
 * @package Metaregistrar\EPP
 *
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
<response>
<result code="1000">
<msg lang="en">Command completed successfully</msg>
</result>
<resData>
<subreg:specialPricelistData xmlns:subreg="http://www.subreg.cz/epp/subreg-1.0">
<subreg:tld name="eu">
<subreg:currency>CZK</subreg:currency>
<subreg:dateto>2018-03-10<subreg:dateto>
<subreg:price item="register">75.74</subreg:price>
<subreg:price item="transfer">75.74</subreg:price>
</subreg:tld>
<subreg:tld name="sk">
<subreg:currency>CZK</subreg:currency>
<subreg:dateto>2018-03-10<subreg:dateto>
<subreg:price item="register">297.89</subreg:price>
<subreg:price item="transfer">75.74</subreg:price>
</subreg:tld>
</subreg:specialPricelistData>
</resData>
<trID>
<svTRID>SUBREG20180314T085524Z4FF</svTRID>
</trID>
</response>
</epp>


 */
class regtonsEppSpecialPricelistResponse extends eppResponse {

    function __construct() {
        parent::__construct();
    }

    public function getPricelist() {
        $xpath = $this->xPath();
        $xpath->registerNamespace('subreg', 'http://www.subreg.cz/epp/subreg-1.0');
        $result = $xpath->query('//subreg:tld');
        $domains = [];
        if ($result->length > 0) {
            foreach($result as $item) {
                $data = [
                    'currency' => $xpath->query('.//subreg:currency', $item)[0]->nodeValue,
                    'dateto' => $xpath->query('.//subreg:dateto', $item)[0]->nodeValue,
                    'price' => []
                ];
                $xprice = $xpath->query('.//subreg:price', $item);
                if($xprice->length > 0) {
                    foreach($xprice as $p) {
                        $data['price'][$p->getAttribute('item')] = $p->nodeValue;
                    }
                }
                $domains[$item->getAttribute('name')] = $data;
            }
        }
        return $domains;
    }
}