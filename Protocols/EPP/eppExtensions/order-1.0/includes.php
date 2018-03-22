<?php

$this->addCommandResponse('Metaregistrar\EPP\regtonsEppOrderInfoRequest', 'Metaregistrar\EPP\regtonsEppOrderInfoResponse');
$this->addCommandResponse('Metaregistrar\EPP\eppRenewRequest', 'Metaregistrar\EPP\regtonsEppOrderResponse');
$this->addCommandResponse('Metaregistrar\EPP\eppTransferRequest', 'Metaregistrar\EPP\regtonsEppOrderResponse');
$this->addCommandResponse('Metaregistrar\EPP\eppCreateDomainRequest', 'Metaregistrar\EPP\regtonsEppOrderResponse');
$this->addCommandResponse('Metaregistrar\EPP\eppUpdateDomainRequest', 'Metaregistrar\EPP\regtonsEppOrderResponse');

