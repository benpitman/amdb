<?php

namespace App\Module\Core\Title\Repository;

use Kentron\Facade\DT;
use Kentron\Template\ARepository;

final class TitleRepository extends ARepository
{
    protected $modelClass = \App\Core\Model\Title::class;

    private const OPERATOR_LIKE = "like";
    private const OPERATOR_REGEXP = "regexp";
    private const OPERATOR_BINARY = "binary";

    private $useBoundaries = false;
    private $sensitive = false;

    public function whereImdbId(string $imdbId): void
    {
        parent::where("title_imdb_id", $imdbId);
    }

    public function whereDateCreatedGreaterThan (DT $date): void
    {
        parent::where("title_start_year", $date, ">");
    }

    public function whereDateCreatedLessThan (DT $date): void
    {
        parent::where("title_start_year", $date, "<");
    }

    public function whereTitle (string $contains): void
    {
        [$operator, $searchText] = $this->formatParam($contains);
        if ($this->useBoundaries) {
            parent::whereRaw("title_primary {$operator} '{$searchText}'");
            parent::orWhereRaw("title_original {$operator} '{$searchText}'");
        }
        else {
            parent::where("title_primary", $searchText, $operator);
            parent::orWhere("title_original", $searchText, $operator);
        }
    }

    public function whereDescription (string $contains): void
    {
        [$operator, $searchText] = $this->formatParam($contains);
        if ($this->useBoundaries) {
            parent::whereRaw("title_description {$operator} '{$searchText}'");
        }
        else {
            parent::where("title_description", $searchText, $operator);
        }
    }

    public function orWhereDescription (string $contains): void
    {
        [$operator, $searchText] = $this->formatParam($contains);
        if ($this->useBoundaries) {
            parent::orWhereRaw("title_description {$operator} '{$searchText}'");
        }
        else {
            parent::orWhere("title_description", $searchText, $operator);
        }
    }

    public function updateDescription(string $description): void
    {
        parent::addUpdate("title_description", $description);
    }

    /**
     * Helpers
     */

    public function setBoundaries (): void
    {
        $this->useBoundaries = true;
    }

    public function setSensitive (): void
    {
        $this->sensitive = true;
    }

    /**
     * Private methods
     */

    private function formatParam (string $searchText): array
    {
        if ($this->useBoundaries) {
            $operator = self::OPERATOR_REGEXP;
            $searchText = "\\\b{$searchText}\\\b";
        }
        else {
            $operator = self::OPERATOR_LIKE;
            $searchText = "%{$searchText}%";
        }

        if ($this->sensitive) {
            $operator .= " " . self::OPERATOR_BINARY;
        }

        return [$operator, $searchText];
    }
}
