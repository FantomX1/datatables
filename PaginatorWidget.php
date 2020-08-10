<?php


namespace fantomx1\datatables;


class PaginatorWidget extends AbstractWidget
{
    private $data;

    private $perPageSettings =
        [
          1, 2, 3, 5, 10
        ];


    private $onPage = 1;

    private $page = 1;

    private $totalPages;

    private $parent;


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

    private function dataToTemplate()
    {

        return [
            'pages' => $this->totalPages,
            'perPageSettings' => $this->perPageSettings,
            'onPage' => $this->onPage,
            'page' => $this->page
        ];

    }








    public function calculatePagination($nbRecords)
    {

        $onPage = $this->changeOnPageEventHook();

        $maxPages = ceil($nbRecords / $onPage);

        if (isset($_GET['page']) AND $_GET['page'] <= $maxPages) {
            $this->page = intval($_GET['page']);
        }

        $this->totalPages = $maxPages;
    }


    private function changeOnPageEventHook()
    {


        $name = $this->parent->getName();




        if (isset($_GET['onPage'])) {
            $_SESSION[$name.'_onPage']  = intval($_GET['onPage']);
        }


        if (isset($_SESSION[$name.'_onPage'])) {

            $this->onPage = $_SESSION[$name.'_onPage'];
        }

        return $this->onPage;

    }



    public function getOnPage()
    {
        return $this->onPage;

    }

    public function getPage()
    {
        return $this->page;

    }


    public function getTotalPages()
    {
        return $this->totalPages;

    }


}
