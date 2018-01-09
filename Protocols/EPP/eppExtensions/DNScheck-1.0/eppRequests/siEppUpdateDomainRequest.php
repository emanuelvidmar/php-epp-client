<?php
namespace Metaregistrar\EPP;

/*

<extension>
    <dnsCheck:update>
        <dnsCheck:check>true/false</dnsCheck:check>
    </dnsCheck:update>
</extension>

*/


class siEppUpdateDomainRequest extends eppUpdateDomainRequest {


    function __construct($objectname, $addinfo = null, $removeinfo = null, $updateinfo = null, $forcehostattr=false, $namespacesinroot=true) {
        parent::__construct($objectname, $addinfo, $removeinfo, $updateinfo, $forcehostattr, $namespacesinroot);
        parent::addSessionId();
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