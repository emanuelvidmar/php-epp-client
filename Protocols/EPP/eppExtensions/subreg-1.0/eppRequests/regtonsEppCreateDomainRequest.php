<?php
namespace Metaregistrar\EPP;

class regtonsEppCreateDomainRequest extends eppCreateDomainRequest {



    function __construct($createinfo, $forcehostattr = false, $namespacesinroot=true) {
        parent::__construct($createinfo, $forcehostattr, $namespacesinroot);
    }

    function __destruct() {
        parent::__destruct();
    }

    function setParameters($parameters) {

        if(!is_array($parameters))return false;

        if (!$this->extension) {
            $this->extension = $this->createElement('extension');
            $this->getCommand()->appendChild($this->extension);
        }
        $create = $this->createElement('subreg:create');
        $create->setAttribute('xmlns:subreg', 'http://www.subreg.cz/epp/subreg-1.0');

        foreach($parameters as $key => $val) {
            $param = $this->createElement('subreg:param', $val);
            $param->setAttribute('name', $key);
            $create->appendChild($param);
        }

        $this->extension->appendChild($create);
        $this->addSessionId();
    }
}

