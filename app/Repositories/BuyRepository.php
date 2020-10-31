<?php

namespace App\Repositories;

use App\Models\Buy;
use App\Repositories\BaseRepository;

/**
 * Class BuyRepository
 * @package App\Repositories
 * @version October 25, 2020, 6:14 pm UTC
*/

class BuyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Buy::class;
    }
}
