<?php

namespace Domain\AssistenceRequest;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laracasts\Presenter\PresentableTrait;

class AssistenceRequest extends Model
{
    use PresentableTrait;

    /**
     * Presenter
     */
    protected $presenter = AssistenceRequestPresenter::class;
    
    protected $table = 'assistencesRequests';

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
