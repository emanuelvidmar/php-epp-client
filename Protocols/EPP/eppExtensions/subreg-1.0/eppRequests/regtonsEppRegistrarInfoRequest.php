<?php
namespace Metaregistrar\EPP;
/*

<info>
    <registrar:info/>
</info>

*/

class regtonsEppRegistrarInfoRequest extends eppRequest {

    /**
     * euridEppCreateContactRequest constructor.
     * @throws eppException
     */
    function __construct( $username = '') {
        parent::__construct();
        $info = $this->createElement('info');
        $info->setAttribute('xmlns:registrar-info', 'urn:ietf:params:xml:ns:registrar-info-1.0');
        $el = $this->createElement('registrar-info:info');
        $id = $this->createElement('registrar-info:id', $username);
        $el->appendChild($id);
        $info->appendChild($el);
        $this->getCommand()->appendChild($info);
    }

}