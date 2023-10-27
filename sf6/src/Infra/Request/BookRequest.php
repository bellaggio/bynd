<?php

namespace App\Infra\Request;

use App\Infra\Request\Constraint as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class BookRequest
{

    #[NotBlank([])]
    #[Type('string')]
    public $name;
    #[Type('integer')]
    #[NotBlank([])]
    public $ISBN;

    #[Type('string')]
    #[NotBlank([])]
    public $author;

    #[Type('string')]
    #[NotBlank([])]
    public $publisher;
}