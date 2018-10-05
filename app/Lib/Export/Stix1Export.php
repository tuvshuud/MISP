<?php

App::uses('StixExport', 'Export');

class Stix1Export extends StixExport
{
    protected $__attributes_limit = 15000;
    private $__script_name = 'misp2stix.py ';
    private $__baseurl = null;
    private $__org = null;

    protected function initiate_framing_params($return_type)
    {
        $this->__baseurl = escapeshellarg(Configure::read('MISP.baseurl'));
        $this->__org = escapeshellarg(Configure::read('MISP.org'));
        $framing_file = $this->__scripts_dir . 'misp_framing.py ';
        return 'python3 ' . $framing_file . $return_type . ' ' . $this->__baseurl . ' ' . $this->__org . ' xml' . $this->__end_of_cmd;
    }

    protected function __parse_misp_events($filename)
    {
        $scriptFile = $this->__scripts_dir . $this->__script_name;
        return shell_exec('python3 ' . $scriptFile . ' ' . $filename . ' xml ' . $this->__baseurl . ' ' . $this->__org . $this->__end_of_cmd);
    }
}