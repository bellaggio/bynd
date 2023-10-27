<?php

namespace App\Infra\Controller;

use App\Core\UseCase\SearchBook;
use App\Infra\Entity\Book;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book/search/{name}', name: 'app_book_search', methods: ['GET'])]
class BookSearchController extends AbstractController
{
    public function __construct(protected SearchBook $searchBook)
    {
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function __invoke(string $name): JsonResponse
    {
        try {
            $book = $this->searchBook->handler($name);

            if (!$book instanceof Book) {
                return $this->json([
                    'error' => 'Book ' . $name . ' not found!',
                ], 404);
            }

            return $this->json(['data' => $book ]);
        } catch (Exception $exception) {
            return $this->json([
                'error' => $exception->getMessage(),
            ], 404);
        }
    }
}
