<?php

namespace App\Infra\Request;

use App\Infra\Request\Constraint as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class BookRequest
{
    #[NotBlank([])]
    #[Type('string')]
    public string $name;
    #[Type('integer')]
    #[NotBlank([])]
    public mixed $ISBN;

    #[Type('string')]
    #[NotBlank([])]
    public string $author;

    #[Type('string')]
    #[NotBlank([])]
    public string $publisher;
}
