<?php

namespace Domain\BrandsAttended;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laracasts\Presenter\PresentableTrait;

class BrandsAttended extends Model
{
    use PresentableTrait;

    /**
     * Presenter
     */
    protected $presenter = BrandsAttendedPresenter::class;
    
    protected $table = 'brandsAttendeds';

    protected $guarded = [];

    /**
     * Dates Mutators
     *
     * @var array
     */
    protected $dates = [
            'created_at',
            'updated_at'
        ];

}
