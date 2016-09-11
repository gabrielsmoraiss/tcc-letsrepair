<?php

namespace Domain\AssistenceRequest;

use Laracasts\Presenter\Presenter;

class AssistenceRequestPresenter extends Presenter
{
    public function businessHours() {
    	$dia = '';
    	if ($this->businessHoursDate == 'SEG-SEX') {
    		$dia = 'De Segunda á Sexta';
    	} elseif ($this->businessHoursDate == 'SEG-SAB') {
    		$dia = 'De Segunda á Sábado';
    	} elseif ($this->businessHoursDate == 'DOM-DOM') {
    		$dia = 'De Domingo á Domingo';
    	}

    	return $dia;
    }
}