<?php
$this->addExtension('nsgroup', 'http://www.dns.be/xml/epp/nsgroup-1.0');

include_once(dirname(__FILE__) . '/eppRequests/dnsbeEppCreateNsgroupRequest.php');
include_once(dirname(__FILE__) . '/eppResponses/dnsbeEppCreateNsgroupResponse.php');

$this->addCommandResponse('Metaregistrar\EPP\dnsbeEppCreateNsgroupRequest', 'Metaregistrar\EPP\dnsbeEppCreateNsgroupResponse');

