<?php

$this->addExtension("dnsCheck", "http://www.arnes.si/xml/epp/DNScheck-1.0");

include_once(dirname(__FILE__) . '/eppRequests/siEppUpdateDomainRequest.php');

$this->addCommandResponse('Metaregistrar\EPP\siEppUpdateDomainRequest', 'Metaregistrar\EPP\eppUpdateDomainResponse');
