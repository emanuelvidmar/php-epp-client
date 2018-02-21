<?php
namespace Metaregistrar\EPP;
/*
 *
 <extension>
   <subreg:pricelist xmlns:subreg="http://www.subreg.cz/epp/subreg-1.0"/>
 </extension>

*/

class regtonsEppPricelistRequest extends eppRequest {

    function __construct() {
        parent::__construct();
        $ext = $this->createElement('extension');
        $el = $this->createElement('subreg:pricelist');
        $el->setAttribute('xmlns:subreg', 'http://www.subreg.cz/epp/subreg-1.0');
        $ext->appendChild($el);
        $this->getEpp()->appendChild($ext);
    }

}