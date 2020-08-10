<?php


namespace fantomx1\datatables;


use fantomx1\iohandlers\handlers\GetHandler;
use fantomx1\iohandlers\handlers\SessionHandler;

/**
 * Class PaginatorWidget
 * @package fantomx1\datatables
 */
class PaginatorWidget extends AbstractWidget
{

    /**
     * @var
     */
    private $data;

    /**
     * @var array
     */
    private $perPageSettings =
        [
          1, 2, 3, 5, 10
        ];


    /**
     * @var int
     */
    private $onPage = 1;

    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var
     */
    private $totalPages;

    /**
     * @var
     */
    private $parent;


    /**
     * PaginatorWidget constructor.
     * @param $parent
     */
    public function __construct($parent)
    {

        $this->parent = $parent;
    }


    /**
     * @return string
     */
    protected function getViewsDir()
    {
        return $this->getDefaultViewsDir("./templates/DataTable");
    }



//    public function setData($data)
//    {
//
//        $this->data = $data;
//    }


    /**
     * @return mixed|void
     */
    public function run()
    {
        // $this->data['perPageSettings']  =$this->perPageSettings;

        $this->render("index",
            $this->dataToTemplate()
        );
    }



//    public function renderOnPageElement()
//    {
//
//
//        $this->render("onPageElement",
//            $this->dataToTemplate()
//        );
//
//    }

    /**
     * @return array
     */
    private function dataToTemplate()
    {
        return [
            'pages'           => $this->totalPages,
            'perPageSettings' => $this->perPageSettings,
            'onPage'          => $this->onPage,
            'page'            => $this->page
        ];

    }


    /**
     * @param $nbRecords
     */
    public function calculatePagination($nbRecords)
    {

        $onPage = $this->changeOnPageEventHook();

        $maxPages = ceil($nbRecords / $onPage);

        $gpage = GetHandler::get('page');

        if ($gpage AND $gpage<= $maxPages) {
            $this->page = intval($gpage);
        }

        $this->totalPages = $maxPages;
    }


    /**
     * @return int|mixed
     */
    private function changeOnPageEventHook()
    {
        $name = $this->parent->getName();

        $gOnpage = GetHandler::get('onPage');
        if ($gOnpage) {
            //$_SESSION[$name.'_onPage']  = intval($gOnpage);
            SessionHandler::set($name.'_onPage', intval($gOnpage));
        }

        $sOnpage = SessionHandler::get($name.'_onPage');

        if ($sOnpage) {

            $this->onPage = $sOnpage;
        }

        return $this->onPage;

    }


    /**
     * @return int
     */
    public function getOnPage()
    {
        return $this->onPage;

    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;

    }


    /**
     * @return mixed
     */
    public function getTotalPages()
    {
        return $this->totalPages;

    }


}
