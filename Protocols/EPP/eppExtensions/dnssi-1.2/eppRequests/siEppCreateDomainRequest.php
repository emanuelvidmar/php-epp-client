<?php
namespace Metaregistrar\EPP;


class siEppCreateDomainRequest extends eppCreateDomainRequest
{
    public function __construct($createinfo)
    {
        parent::__construct($createinfo);
        if ($createinfo instanceof eppDomain) {
            $this->createPw($createinfo);
        }
    }

    public function createPw(eppDomain $createinfo)
    {
        // Create PW tag even if there is no pw
        if (!strlen($createinfo->getAuthorisationCode())) {
            $authinfo = $this->createElement('domain:authInfo');
            $authinfo->appendChild($this->createElement('domain:pw', ""));
            $this->domainobject->appendChild($authinfo);
        }
    }

    public function updateDNSCheck($bool) {

        $dnsCheckValue = $bool ? 'true' : 'false';
        $ext = $this->createElement('extension');
        $dnsCheck = $this->createElement('dnsCheck:update');
        $domdata = $this->createElement('dnsCheck:check', $dnsCheckValue);
        $dnsCheck->appendChild($domdata);
        $ext->appendChild($dnsCheck);
        $this->getCommand()->appendChild($ext);
        parent::addSessionId();

    }
}