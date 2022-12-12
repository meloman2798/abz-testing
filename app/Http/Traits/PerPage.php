<?php

namespace App\Http\Traits;

/**
 *
 */
trait PerPage
{
    /**
     * @return int[]
     */
    public function perPage(): array
    {
        return [
            10,
            20,
            40,
            60,
            80,
            100,
        ];
    }
}
