<?php

namespace CommonBundle\Dto;

use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ValidationExceptionApiResponse implements ApiResponseInterface
{
    use ErroneousApiResponse;

    /**
     * @var ConstraintViolationListInterface
     */
    private $errors;

    /**
     * @return ConstraintViolationListInterface
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param ConstraintViolationListInterface $errors
     * @return ValidationExceptionApiResponse
     */
    public function setErrors(ConstraintViolationListInterface $errors)
    {
        $this->errors = $errors;

        return $this;
    }
}
