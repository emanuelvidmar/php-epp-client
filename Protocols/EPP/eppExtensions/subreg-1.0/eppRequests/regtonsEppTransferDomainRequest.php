<?php
namespace Metaregistrar\EPP;

/*
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
 <command>
  <transfer op="request">
   <domain:transfer xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
    <domain:name>yourdomain.cz</domain:name>
    <domain:period unit="y">1</domain:period>
    <domain:ns>
     <domain:hostAttr>
      <domain:hostName>ns.example.com</domain:hostName>
     </domain:hostAttr>
     <domain:hostAttr>
      <domain:hostName>ns.example.net</domain:hostName>
     </domain:hostAttr>
    </domain:ns>
    <domain:registrant>G-000249</domain:registrant>
    <domain:contact type="admin">G-000249</domain:contact>
    <domain:authInfo>
     <domain:pw>lbQZJemn</domain:pw>
    </domain:authInfo>
   </domain:transfer>
  </transfer>
  <extension>
    <subreg:transfer xmlns:subreg="http://www.subreg.cz/epp/subreg-1.0">
      <subreg:param name="idnum">12345678</subreg:param>
      <subreg:param name="internal">true</subreg:param>
    </subreg:transfer>
  </extension>
  <clTRID>SUBREG20120218T024613Z691</clTRID>
 </command>
</epp>
 */


class regtonsEppTransferDomainRequest extends eppTransferRequest {
    function __construct($operation, eppDomain $domain) {
        parent::__construct($operation,$domain);
        $this->addContacts($domain);
        parent::addSessionId();

    }

    private function addContacts(eppDomain $domain) {
        $command = $this->getCommand();
        $transfer = $command->firstChild->firstChild;

        // Set Nameservers at Transfer if needed
        $nsobjects = $domain->getHosts();
        if ($domain->getHostLength() > 0) {
            $nameservers = $this->createElement('domain:ns');
            foreach ($nsobjects as $nsobject) {
                /* @var $nsobject \Metaregistrar\EPP\eppHost */
                $attr = $this->createElement('domain:hostAttr');
                $c = $this->createElement('domain:hostName', $nsobject->getHostname());
                $attr->appendChild($c);

                $nameservers->appendChild($attr);
            }
            $transfer->appendChild($nameservers);
        }

        if($domain->getRegistrant() != "") {
            $c = $this->createElement('domain:registrant', $domain->getRegistrant());
            $transfer->appendChild($c);
        }

        foreach ($domain->getContacts() as $contact) {
            /* @var $contact \Metaregistrar\EPP\eppContactHandle */
            $c = $this->createElement('domain:contact',$contact->getContactHandle());
            $c->setAttribute('type',$contact->getContactType());
            $transfer->appendChild($c);
        }

        $ai = $this->getElementsByTagName('domain:authInfo')[0];
        $ai->parentNode->removeChild($ai);

        if (strlen($domain->getAuthorisationCode())) {
            $authinfo = $this->createElement('domain:authInfo');
            $authinfo->appendChild($this->createElement('domain:pw', $domain->getAuthorisationCode()));
            $transfer->appendChild($authinfo);
        }

    }


}