<?php
//        $paginator = new PaginatorWidget();
//        $paginator->setData(
//             [
////                'pages' => $totalPages,
////                'page' => $page
//            ]
//        );

use fantomx1\datatables\PaginatorWidget;

$this->paginator = $paginator = new PaginatorWidget($this);
$paginator->calculatePagination($count[0]['FOUND_ROWS()']);
