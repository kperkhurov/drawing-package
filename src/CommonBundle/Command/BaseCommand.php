<?php

namespace CommonBundle\Command;

use CommonBundle\Dto\ApiRequestFactoryInterface;
use CommonBundle\Dto\ApiRequestInterface;
use CommonBundle\Dto\ApiResponseInterface;
use CommonBundle\Extractor\ExtractorInterface;
use CommonBundle\ObjectBuilder\ObjectBuilderInterface;
use CommonBundle\Service\ServiceInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

abstract class BaseCommand extends Command
{
    use LoggerAwareTrait;

    /**
     * @var ApiRequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var ObjectBuilderInterface
     */
    private $objectBuilder;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var ExtractorInterface
     */
    private $extractor;

    /**
     * @var ServiceInterface
     */
    private $service;

    /**
     * @param string $name
     * @param string $description
     * @param ApiRequestFactoryInterface $requestFactory
     * @param ObjectBuilderInterface $objectBuilder
     * @param ValidatorInterface $validator
     * @param ExtractorInterface $extractor
     * @param ServiceInterface $service
     * @param LoggerInterface $logger
     */
    public function __construct(
        string $name,
        string $description,
        ApiRequestFactoryInterface $requestFactory,
        ObjectBuilderInterface $objectBuilder,
        ValidatorInterface $validator,
        ExtractorInterface $extractor,
        ServiceInterface $service,
        LoggerInterface $logger
    ) {
        parent::__construct($name);

        $this->setDescription($description);
        $this->setLogger($logger);

        $this->requestFactory = $requestFactory;
        $this->objectBuilder = $objectBuilder;
        $this->validator = $validator;
        $this->extractor = $extractor;
        $this->service = $service;
    }

    /**
     * @param ApiResponseInterface $response
     * @param OutputInterface $output
     * @return void
     */
    abstract protected function render(ApiResponseInterface $response, OutputInterface $output): void;

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->log("Starting '{commandName}' command execution");

        try {
            $this->logger->info('Transforming input parameters to request');
            $request = $this->createRequest($input);

            $this->logger->info('Validating request');
            $errors = $this->validator->validate($request);

            if (count($errors) > 0) {
                $this->log(
                    "Request has error(s): '{validationErrors}'",
                    [
                        'validationErrors' => (string) $errors
                    ]
                );

                return 1;
            }

            $this->logger->info('Executing a business logic');

            $this->render($this->service->behave($request), $output);
        } catch (Throwable $e) {
            $this->log(
                "An error occurred while executing '{commandName}' command",
                [
                    'exception' => $e,
                ],
                LogLevel::ERROR
            );

            return 1;
        }

        $this->log("'{commandName}' command execution finished");

        return 0;
    }

    /**
     * @param InputInterface $input
     * @return ApiRequestInterface
     */
    private function createRequest(InputInterface $input): ApiRequestInterface
    {
        return
            $this->objectBuilder->build(
                $this->requestFactory->createRequest(),
                $this->requestFactory->createRequestFormType(),
                $this->extractor->extract(
                    array_merge($input->getOptions(), $input->getArguments())
                )
            );
    }

    /**
     * @param string $message
     * @param mixed[] $context
     * @param string $logLevel
     * @return void
     */
    private function log($message, array $context = [], $logLevel = LogLevel::INFO): void
    {
        $this->logger->log(
            $logLevel,
            $message,
            array_merge(
                ['commandName' => $this->getName()],
                $context
            )
        );
    }
}
