<?php

namespace App\Module\Api\Entity;

use Kentron\Entity\Template\AApiEntity;
use Kentron\Facade\DT;

final class SearchEntity extends AApiEntity
{
    protected $propertyMap = [
        "q" => [
            "get" => "getQuery",
            "set" => "setQuery"
        ],
        "l" => [
            "get" => "getLimit",
            "set" => "setLimit"
        ],
        "p" => [
            "get" => "getPage",
            "set" => "setPage"
        ],
        "t" => [
            "get" => "getType",
            "set" => "setType"
        ],
        "df" => [
            "get" => "getDateFrom",
            "set" => "setDateFrom"
        ],
        "dt" => [
            "get" => "getDateTo",
            "set" => "setDateTo"
        ]
    ];

    /**
     * @var string
     */
    private $query;
    private $limit = 10;
    private $page = 1;
    private $type = null;
    private $dateFrom;
    private $dateTo;

    /**
     * Getters
     */

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function getDateFrom(): int
    {
        return $this->dateFrom;
    }

    public function getDateTo(): int
    {
        return $this->dateTo;
    }

    public function getDTDateFrom(): ?DT
    {
        return $this->dateFrom ? DT::then($this->dateFrom) : null;
    }

    public function getDTDateTo(): ?DT
    {
        return $this->dateTo ? DT::then($this->dateTo) : null;
    }

    /**
     * Setters
     */

    public function setQuery(string $query): void
    {
        $this->query = $query;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function setDateFrom(int $dateFrom): void
    {
        $this->dateFrom = $dateFrom;
    }

    public function setDateTo(int $dateTo): void
    {
        $this->dateTo = $dateTo;
    }

    /**
     * Helpers
     */

    public function iterateQueries(): iterable
    {
        foreach (explode(" ", $this->query) as $query) {
            yield $query;
        }
    }

    public function getOffset(): int
    {
        return $this->limit * ($this->page - 1);
    }
}
