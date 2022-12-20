<?php

namespace App\Traits\Services;

trait RollCallListTrait
{
    /**
     * getQueryParams
     *
     * @return array $oa_result the array contains various keys,
     * the keys and descriptions are listed in sequence.
     * 'eager_relations': array; the syntax is as follows
     * ```[relation,|Model\.relation,]+```
     *   e.g.,  [courseusers, User.userlevels]
     * 'where_clause': array; the syntax is array()
     * ```[["column_name", "relation", "value"]]```
     *   e.g., [["user_name", "=", "Nick"]]
     */
    function getSearchingParams() : array
    {
        return [
            'eager_relations' => [],
            'where_clauses' => [],
        ];
    }
}
