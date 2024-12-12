<?php
require_once 'Controllers/BookController.php';

class Router {
    public function run() {
        $action = $_GET['action'] ?? 'index';

        switch ($action) {
            case 'index':
                (new BookController())->index();
                break;
            case 'create':
                (new BookController())->create();
                break;
            case 'delete':
                (new BookController())->delete();
                break;
            default:
                echo "Page non trouvée";
        }
    }
}


    

