<?php

namespace App\Infra\Controller;

use App\Core\UseCase\AuthorFindByName;
use App\Core\UseCase\CreateUpdateBook;
use App\Core\UseCase\PublisherFindByName;
use App\Infra\Entity\Author;
use App\Infra\Entity\Publisher;
use App\Infra\Request\BookRequest;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book', name: 'app_book_create', methods: ['POST'])]
class BookCreateOrUpdateController extends AbstractController
{

    public function __construct(
        protected PublisherFindByName $publisherFindByName,
        protected AuthorFindByName    $authorFindByName,
        protected CreateUpdateBook    $createUpdateBook
    )
    {
    }

    public function __invoke(BookRequest $request): JsonResponse
    {
        $errors = $request->validate();

        if ($errors) {
            return $this->json([
                'errors' => $errors,
            ], 404);
        }
        $data = $request->getRequest()->toArray();

        $hasAuthor = $this->authorFindByName->handler($data['author']);

        $hasPublisher = $this->publisherFindByName->handler($data['publisher']);

        if (!$hasPublisher instanceof Publisher) {
            return $this->json([
                'errors' => 'The publisher ' . $data['publisher'] . ' not found!',
            ], 404);
        }

        if (!$hasAuthor instanceof Author) {
            return $this->json([
                'errors' => 'The author ' . $data['author'] . ' not found!',
            ], 404);
        }

        try {

            $this->createUpdateBook->handler($data, $hasAuthor, $hasPublisher);

            return $this->json([
                'message' => 'Book' . $data['name'] . ' was created/updated!',
            ]);
        } catch (Exception $exception) {
            return $this->json([
                'errors' => $exception->getMessage(),
            ], 404);
        }
    }
}
