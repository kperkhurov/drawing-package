<?php

namespace CommonBundle\Extractor;

interface ExtractorInterface
{
    /**
     * @param mixed[] $data
     * @return mixed[]
     */
    public function extract(array $data): array;
}
