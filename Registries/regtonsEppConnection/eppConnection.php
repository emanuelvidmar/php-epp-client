<?php
namespace Metaregistrar\EPP;

class regtonsEppConnection extends eppConnection {

    public function __construct($logging = false, $settingsfile = null) {
        parent::__construct($logging, $settingsfile);

        //parent::enableDnssec();
        parent::setServices(array('urn:ietf:params:xml:ns:domain-1.0' => 'domain', 'urn:ietf:params:xml:ns:contact-1.0' => 'contact', "urn:ietf:params:xml:ns:registrar-info-1.0" => "registrar-info"));
        parent::useExtension('subreg-1.0');
        parent::useExtension('order-1.0');

    }

}
