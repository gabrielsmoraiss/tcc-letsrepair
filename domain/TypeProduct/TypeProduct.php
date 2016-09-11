<?php

namespace Domain\TypeProduct;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laracasts\Presenter\PresentableTrait;

class TypeProduct extends Model
{
    use PresentableTrait;

    /**
     * Presenter
     */
    protected $presenter = TypeProductPresenter::class;
    
    protected $table = 'typeProducts';

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
