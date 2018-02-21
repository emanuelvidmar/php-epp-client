<?php
namespace Metaregistrar\EPP;
/**
 * Class regtonsEppPricelistResponse
 * @package Metaregistrar\EPP
 *
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
<response>
<result code="1000">
<msg lang="en">Command completed successfully</msg>
</result>
<resData>
<subreg:pricelistData xmlns:subreg="http://www.subreg.cz/epp/subreg-1.0">
<subreg:tld name="com">
<subreg:minyear>1</subreg:minyear>
<subreg:maxyear>10</subreg:maxyear>
<subreg:local_presence>0</subreg:local_presence>
<subreg:price item="register">57.55</subreg:price>
<subreg:price item="renew">57.55</subreg:price>
<subreg:price item="restore">361.21</subreg:price>
<subreg:price item="transfer">57.55</subreg:price>
<subreg:param name="lang" required="0" desc="3-letter language settings for domain holder (cze,slo,eng,...)"/>
</subreg:tld>
<subreg:tld name="cz">
<subreg:minyear>1</subreg:minyear>
<subreg:maxyear>10</subreg:maxyear>
<subreg:local_presence>0</subreg:local_presence>
<subreg:price item="register">43</subreg:price>
<subreg:price item="renew">43</subreg:price>
<subreg:param name="keyset" required="0" desc="Set of DNSSEC keys, already existing object"/>
</subreg:tld>
</subreg:pricelistData>
</resData>
<trID>
<svTRID>SUBREG20120818T191110Z319</svTRID>
</trID>
</response>
</epp>


 */
class regtonsEppPricelistResponse extends eppResponse {

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
                    'minyear' => $xpath->query('.//subreg:minyear', $item)[0]->nodeValue,
                    'maxyear' => $xpath->query('.//subreg:maxyear', $item)[0]->nodeValue,
                    'local_presence' => $xpath->query('.//subreg:local_presence', $item)[0]->nodeValue,
                    'price' => [],
                    'param' => []
                ];
                $xprice = $xpath->query('.//subreg:price', $item);
                if($xprice->length > 0) {
                    foreach($xprice as $p) {
                        $data['price'][$p->getAttribute('item')] = $p->nodeValue;
                    }
                }
                $xparam = $xpath->query('.//subreg:param', $item);
                if($xparam->length > 0) {
                    foreach($xparam as $p) {
                        $data['param'][$p->getAttribute('name')] = ['required' => $p->getAttribute('required'), 'desc' => $p->getAttribute('desc')];
                    }
                }
                $domains[$item->getAttribute('name')] = $data;
            }
        }
        return $domains;
    }
}