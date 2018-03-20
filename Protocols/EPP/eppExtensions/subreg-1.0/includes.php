<?php


$this->addExtension('subreg-1.0', 'http://www.subreg.cz/epp/subreg-1.0');

include_once(dirname(__FILE__) . '/eppRequests/regtonsEppRegistrarInfoRequest.php');
include_once(dirname(__FILE__) . '/eppResponses/regtonsEppRegistrarInfoResponse.php');

$this->addCommandResponse('Metaregistrar\EPP\regtonsEppRegistrarInfoRequest', 'Metaregistrar\EPP\regtonsEppRegistrarInfoResponse');
$this->addCommandResponse('Metaregistrar\EPP\eppCheckDomainRequest', 'Metaregistrar\EPP\regtonsEppCheckDomainResponse');
$this->addCommandResponse('Metaregistrar\EPP\regtonsEppPricelistRequest', 'Metaregistrar\EPP\regtonsEppPricelistResponse');
$this->addCommandResponse('Metaregistrar\EPP\regtonsEppSpecialPricelistRequest', 'Metaregistrar\EPP\regtonsEppSpecialPricelistResponse');


