<?php
namespace Metaregistrar\EPP;

use \DOMElement;

class regtonsEppCheckDomainResponse extends eppCheckDomainResponse {

    /**
     *
     * @return array of checked domains with status true/false
     */
    public function getCheckedDomains() {
        $result = null;
        if ($this->getResultCode() == self::RESULT_SUCCESS) {
            $result = array();
            $xpath = $this->xPath();
            $domains = $xpath->query('/epp:epp/epp:response/epp:resData/domain:chkData/domain:cd');
            foreach ($domains as $domain) {
                $childs = $domain->childNodes;
                $checkeddomain = array('domainname' => null, 'available' => false, 'reason' => null);
                foreach ($childs as $child) {
                    if ($child instanceof DOMElement) {
                        if ($child->localName=='name') {
                            $available = $child->getAttribute('avail');
                            switch ($available) {
                                case '0':
                                case 'false':
                                    $checkeddomain['available'] = false;
                                    break;
                                case '1':
                                case 'true':
                                    $checkeddomain['available'] = true;
                                    break;
                            }
                            $checkeddomain['domainname'] = $child->nodeValue;
                        }
                        if ($child->localName=='reason') {
                            $checkeddomain['reason'] = $child->nodeValue;
                        }
                    }
                }
                $result[] = $checkeddomain;
            }
            $xpath->registerNamespace('subreg', 'http://www.subreg.cz/epp/subreg-1.0');
            $domainse = $xpath->query('//subreg:price');
            $i=0;
            foreach($domainse as $domain) {
                $premium = $xpath->query('.//subreg:premium', $domain)[0]->nodeValue;
                $price = floatval($xpath->query('.//subreg:amount', $domain)[0]->nodeValue);
                $result[$i]['premium'] = $premium;
                $result[$i]['price'] = $price;
                $i++;
            }
        }
        return ($result);
    }

}