<?php
require_once '../Models/Book.php';
require_once '../Models/Author.php';
require_once '../Models/Category.php';

// Assurez-vous d'importer les classes Twig nécessaires
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class BookController {
    public function index() {
        $books = Book::getAll();
        $authors = Author::getAll();
        $categories = Category::getAll();

        $loader = new FilesystemLoader('../Views');
        $twig = new Environment($loader);

        echo $twig->render('index.twig', [
            'books' => $books,
            'authors' => $authors,
            'categories' => $categories
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $author_name = $_POST['author'] ?? '';
            $category_name = $_POST['category'] ?? '';

            // Vérifier si l'auteur existe, sinon ajouter
            $author_id = Author::getIdByName($author_name);
            if (!$author_id) {
                $author_id = Author::create($author_name);
            }

            // Vérifier si le genre existe, sinon ajouter
            $category_id = Category::getIdByName($category_name);
            if (!$category_id) {
                $category_id = Category::create($category_name);
            }

            // Vérifier que tous les champs sont remplis
            if (!empty($title) && !empty($author_id) && !empty($category_id)) {
                Book::create($title, $author_id, $category_id);
                header('Location: ?action=index');
                exit;
            } else {
                echo "Veuillez remplir tous les champs.";
            }
        } else {
            $loader = new \Twig\Loader\FilesystemLoader('../Views');
            $twig = new \Twig\Environment($loader);

            echo $twig->render('create.twig');
        }
    }




public function delete() {
    $id = $_GET['id'] ?? null;
    if ($id) {

        $book = Book::getById($id);  

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            Book::delete($id);
            header('Location: ?action=index');
            exit;
        } else {

            $loader = new \Twig\Loader\FilesystemLoader('../Views');
            $twig = new \Twig\Environment($loader);

            echo $twig->render('delete.twig', ['book' => $book]);
        }
    } else {

        header('Location: ?action=index');
        exit;
    }
}

}
