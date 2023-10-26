<?php

namespace App\Infra\Request;

use App\Infra\Request\Constraint as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class BookRequest extends BaseRequest
{

    #[NotBlank([])]
    #[Type('string')]
    protected $name;

    #[Type('integer')]
    #[NotBlank([])]
    protected $ISBN;

    #[Type('string')]
    #[NotBlank([])]
    protected $author;

    #[Type('string')]
    #[NotBlank([])]
    protected $publisher;
}