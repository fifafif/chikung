<?php

/**
 * Objekt reprezentujici strankovani zaznamu na strance.
 *
 * @author XiXao
 */
class FPaginator {

    private $_rowsNum;
    private $_recordsByPage;
    private $_actualPageNum;
    private $_pageLink;
    private $_linkNameNext;
    private $_linkNamePrev;
    private $_linkNameFirst;
    private $_linkNameLast;

    /**
     * Nastaveni vsech potrebnych parametru pres konstruktor a ziskani poctu zaznamu z databaze.
     *
     * @param integer $recordsByPage Pocet zaznamu na stranku.
     * @param string $pageLink Odkaz na aktualni stranku.
     * @param integer $acutalPageNum Cislo aktualni stranky.
     */
    public function  __construct($rowsNum, $recordsByPage, $pageLink, $acutalPageNum) {
        $this->_rowsNum = $rowsNum;
        $this->_recordsByPage = $recordsByPage;
        $this->_pageLink = $pageLink;
        $this->_actualPageNum = $acutalPageNum;
        $this->setLinkNames();
    }

    public function getRecordsByPage() {
        return $this->_recordsByPage;
    }

    public function setRecordsByPage($recordsByPage) {
        $this->_recordsByPage = $recordsByPage;
    }

    /**
     * Zjisteni o kolik se maji data posunout.
     *
     * @return integer
     */
    public function getOffset() {
        return floor($this->_rowsNum / $this->_recordsByPage);
    }

    public function getActualPageNum() {
        return $this->_actualPageNum;
    }

    public function setActualPageNum($actualPageNum) {
        $this->_actualPageNum = $actualPageNum;
    }

    public function getPageLink() {
        return $this->_pageLink;
    }

    public function setPageLink($pageLink) {
        $this->_pageLink = $pageLink;
    }

    /**
     * Zjisteni posledni stranky.
     *
     * @return integer
     */
    public function getLastPageNum() {
        if ($this->_recordsByPage == 0) {
            return 0;
        }
        return ceil($this->_rowsNum / $this->_recordsByPage);
    }

    /**
     * Funkce pro zjisteni zacatku TIMITu dotazu.
     *
     * @return integer
     */
    public function getFrom() {
        return ($this->_actualPageNum * $this->_recordsByPage);
    }
    
    public function setLinkNames($next = 'next', $prev = 'previous', $first = 'first', $last = 'last') {
        $this->_linkNameNext = $next;
        $this->_linkNamePrev = $prev;
        $this->_linkNameFirst = $first;
        $this->_linkNameLast = $last;
    }
    
    public function getLinkNameNext() {
        return $this->_linkNameNext;
    }

    public function setLinkNameNext($_linkNameNext) {
        $this->_linkNameNext = $_linkNameNext;
    }

    public function getLinkNamePrev() {
        return $this->_linkNamePrev;
    }

    public function setLinkNamePrev($_linkNamePrev) {
        $this->_linkNamePrev = $_linkNamePrev;
    }

    public function getLinkNameFirst() {
        return $this->_linkNameFirst;
    }

    public function setLinkNameFirst($_linkNameFirst) {
        $this->_linkNameFirst = $_linkNameFirst;
    }

    public function getLinkNameLast() {
        return $this->_linkNameLast;
    }

    public function setLinkNameLast($_linkNameLast) {
        $this->_linkNameLast = $_linkNameLast;
    }

    public function toString() {
        return "actual page num: $this->_actualPageNum; records by page: $this->_recordsByPage;";
    }

}
?>
