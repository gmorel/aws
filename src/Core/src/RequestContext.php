<?php

namespace AsyncAws\Core;

use AsyncAws\Core\Exception\InvalidArgument;

/**
 * Contains contextual information alongside a request.
 *
 * @author Jérémy Derussé <jeremy@derusse.com>
 *
 * @internal
 */
class RequestContext
{
    public const AVAILABLE_OPTIONS = [
        'operation' => true,
        'expirationDate' => true,
        'currentDate' => true,
    ];

    /**
     * @var string|null
     */
    private $operation;

    /**
     * @var \DateTimeInterface|null
     */
    private $expirationDate;

    /**
     * @var \DateTimeInterface|null
     */
    private $currentDate;

    /**
     * @param array{
     *  operation?: null|string
     *  expirationDate?: null|\\DateTimeInterface
     *  currentDate?: null|\\DateTimeInterface
     * }
     */
    public function __construct(array $options = [])
    {
        if (0 < \count($invalidOptions = \array_diff_key($options, self::AVAILABLE_OPTIONS))) {
            throw new InvalidArgument(\sprintf('Invalid option(s) "%s" passed to "%s". ', \implode('", "', \array_keys($invalidOptions)), __METHOD__));
        }

        foreach ($options as $property => $value) {
            $this->$property = $value;
        }
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function getCurrentDate(): ?\DateTimeInterface
    {
        return $this->currentDate;
    }
}
