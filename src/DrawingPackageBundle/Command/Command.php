<?php

namespace DrawingPackageBundle\Command;

use CommonBundle\Command\BaseCommand;
use CommonBundle\Dto\ApiResponseInterface;
use DrawingSdkPackageBundle\Operation\Draw\Dto\Response\Response;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

final class Command extends BaseCommand
{
    /**
     * {@inheritdoc}
     * @param Response $response
     */
    protected function render(ApiResponseInterface $response, OutputInterface $output): void
    {
        $table = new Table($output);

        $table->setHeaders(['Current Drawing']);

        foreach ($response->getDrawingResult() as $result) {
            $table->addRow([$result]);
        }

        $table
            ->setStyle('borderless')
            ->render();
        ;
    }
}
