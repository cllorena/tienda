<?php


namespace Nextend\Framework\Localization\Joomla\Pomo;


class POMO_FileReader extends POMO_Reader {

    protected $_f;

    /**
     * @param string $filename
     */
    function __construct($filename) {
        parent::__construct();
        $this->_f = fopen($filename, 'rb');
    }

    /**
     * @param int $bytes
     */
    function read($bytes) {
        return fread($this->_f, $bytes);
    }

    /**
     * @param int $pos
     *
     * @return boolean
     */
    function seekto($pos) {
        if (-1 == fseek($this->_f, $pos, SEEK_SET)) {
            return false;
        }
        $this->_pos = $pos;

        return true;
    }

    /**
     * @return bool
     */
    function is_resource() {
        return is_resource($this->_f);
    }

    /**
     * @return bool
     */
    function feof() {
        return feof($this->_f);
    }

    /**
     * @return bool
     */
    function close() {
        return fclose($this->_f);
    }

    /**
     * @return string
     */
    function read_all() {
        $all = '';
        while (!$this->feof()) $all .= $this->read(4096);

        return $all;
    }
}
