<?php

namespace App\Module\Api\Entity;

use Kentron\Entity\Template\AApiEntity;
use Kentron\Facade\DT;

final class SearchEntity extends AApiEntity
{
    public const SEARCH_IN_TITLE       = 0b01;
    public const SEARCH_IN_DESCRIPTION = 0b10;

    public const SEARCH_OPTION_SENSITIVE = 0b0001;
    public const SEARCH_OPTION_BOUNDARIES = 0b0010;

    public const DEFAULT_SEARCH_OPTIONS = 0;
    public const DEFAULT_SEARCH_IN_MASK = self::SEARCH_IN_TITLE;

    protected $propertyMap = [
        "q" => [
            "get" => "getQuery",
            "set" => "setQuery"
        ],
        "so" => [
            "get" => "getSearchOptions",
            "set" => "setSearchOptions"
        ],
        "sm" => [
            "get" => "getSearchMask",
            "set" => "setSearchMask"
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
    private $searchOptions = self::DEFAULT_SEARCH_OPTIONS;
    private $searchMask = self::DEFAULT_SEARCH_IN_MASK;
    private $dateFrom;
    private $dateTo;

    /**
     * Getters
     */

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getSearchOptions(): int
    {
        return $this->searchOptions;
    }

    public function getSearchMask(): int
    {
        return $this->searchMask;
    }

    public function getDateFrom(): int
    {
        return $this->dateFrom;
    }

    public function getDateTo(): int
    {
        return $this->dateTo;
    }

    public function getDTDateFrom(): DT
    {
        return DT::then($this->dateFrom);
    }

    public function getDTDateTo(): DT
    {
        return DT::then($this->dateTo);
    }

    /**
     * Setters
     */

    public function setQuery(string $query): void
    {
        $this->query = $query;
    }

    public function setSearchOptions(int $searchOptions): void
    {
        $this->searchOptions = $searchOptions;
    }

    public function setSearchMask(int $searchMask): void
    {
        $this->searchMask = $searchMask;
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

    public function searchBoundaries (): bool
    {
        return !!($this->searchOptions & self::SEARCH_OPTION_BOUNDARIES);
    }

    public function searchSensitive (): bool
    {
        return !!($this->searchOptions & self::SEARCH_OPTION_SENSITIVE);
    }

    public function searchInTitle (): bool
    {
        return !!($this->searchMask & self::SEARCH_IN_TITLE);
    }

    public function searchInDescription (): bool
    {
        return !!($this->searchMask & self::SEARCH_IN_DESCRIPTION);
    }

    public function hasSearchText (): bool
    {
        return is_string($this->text);
    }
}
