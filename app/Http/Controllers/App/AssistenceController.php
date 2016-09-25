<?php
namespace App\Http\Controllers\App;

use Auth;
use Requests;
use Google_Client;
use Hybrid_Auth;
use Hybrid_Endpoint;
use Illuminate\Http\Request;
use Domain\User\UserRequest;
use App\Http\Controllers\BaseController;
use Domain\User\UserRepositoryInterface as User;
use Domain\TypeProduct\TypeProductRepositoryInterface as TypeProduct;
use Domain\BrandsAttended\BrandsAttendedRepositoryInterface as BrandsAttended;

class AssistenceController extends BaseController
{
    protected $users;
    protected $typeProducts;
    protected $brandsAttendeds;

    public function __construct(User $users, TypeProduct $typeProducts, BrandsAttended $brandsAttendeds)
    {
        $this->users = $users;
        $this->loggedUser = Auth::user();
        $this->typeProducts = $typeProducts;
        $this->brandsAttendeds = $brandsAttendeds;
        $this->tableAssistencesId = "1aPLJfYAPlL3L2KVVC-FyZaspqnpv4MWK-dYpgbPS";
    }

    /**
     * Mostra a tela inicial
     *
     * @return Response
     */ 
    public function index()
    {
        $url = "https://www.googleapis.com/fusiontables/v2/query?";
        $url .= "sql=SELECT ROWID, name, category, Location, typeProduct, brandsAttended, " .
            "brandsAttendedWarranty, businessHoursDate, hoursStart, hoursEnd, active ";
        $url .= "FROM $this->tableAssistencesId&key=AIzaSyA9Up-4eYIsGn1cwwfMh-Zy1PAH-qPZJEc";

        $assistences = [];
        $headers = ['Accept' => 'application/json'];

        //$options = [    
            //'sql' => "SELECT * FROM $this->tableAssistencesId",
            //'key' => 'AIzaSyA9Up-4eYIsGn1cwwfMh-Zy1PAH-qPZJEc'
        //];

        $response = Requests::get($url, $headers);

        if($response->success) {

            $assistenciasJson = json_decode($response->body);

            foreach ($assistenciasJson->rows as $key => $assistenciaJson) {

                $assistences[] = collect(array_combine($assistenciasJson->columns, $assistenciaJson));
            }
        }

        return view('admin.assistence.search-index', compact('assistences'));
    }

    /**
     * Lista uma assistencia especifica.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $url = "https://www.googleapis.com/fusiontables/v2/query?";
        $url .= "sql=SELECT ROWID, name, category, Location, typeProduct, brandsAttended, " .
            "brandsAttendedWarranty, fone, info, active, businessHoursDate, hoursStart, hoursEnd ";
        $url .= "FROM $this->tableAssistencesId WHERE rowid=$id&key=AIzaSyA9Up-4eYIsGn1cwwfMh-Zy1PAH-qPZJEc";


        $assistences = [];
        $headers = ['Accept' => 'application/json'];

        $response = Requests::get($url, $headers);

        if($response->success) {

            $assistenciasJson = json_decode($response->body);
            foreach ($assistenciasJson->rows as $key => $assistenciaJson) {

                $assistencia[] = collect(array_combine($assistenciasJson->columns, $assistenciaJson));
            }
            $assistencia = $assistencia[0];
        } else {
            dd('Erro:', $response);
        }

        if($assistencia['typeProduct']) {
            $assistencia['typeProduct'] = $this->typeProducts
                ->index()
                ->whereIn('id', array_map('intval', json_decode($assistencia['typeProduct'])))
                ->pluck('description');

            $assistencia['typeProduct'] = implode(', ', $assistencia['typeProduct']->all());
        }

        if($assistencia['brandsAttended']) {
            $assistencia['brandsAttended'] = $this->brandsAttendeds
            ->index()
            ->whereIn('id', array_map('intval', json_decode($assistencia['brandsAttended'])))
            ->pluck('description');

            $assistencia['brandsAttended'] = implode(', ', $assistencia['brandsAttended']->all());
        }

        if($assistencia['brandsAttendedWarranty']) {
            $assistencia['brandsAttendedWarranty'] = $this->brandsAttendeds
                ->index()
                ->whereIn('id', array_map('intval', json_decode($assistencia['brandsAttendedWarranty'])))
                ->pluck('description');

            $assistencia['brandsAttendedWarranty'] = implode(', ', $assistencia['brandsAttendedWarranty']->all());
        }

        return view('admin.assistence.search-show', compact('assistencia', 'typeProducts', 'brandsAttendeds'));
    }

    /**
     * Lista uma assistencia especifica.
     *
     * @param  int $id
     * @return Response
     */
    public function store(Request $request)
    {
        $url = "https://www.googleapis.com/fusiontables/v2/query?";
        $url .= "sql=SELECT ROWID, name, category, Location, typeProduct, brandsAttended, " .
            "brandsAttendedWarranty, fone, info, active, businessHoursDate, hoursStart, hoursEnd ";
        $url .= "FROM $this->tableAssistencesId WHERE Location like '$request->Location'&key=AIzaSyA9Up-4eYIsGn1cwwfMh-Zy1PAH-qPZJEc";

        $assistences = [];
        $headers = ['Accept' => 'application/json'];

        $response = Requests::get($url, $headers);

        if($response->success) {
            $assistenciasJson = json_decode($response->body);
            foreach ($assistenciasJson->rows as $key => $assistenciaJson) {

                $assistencia[] = collect(array_combine($assistenciasJson->columns, $assistenciaJson));
            }
            $assistencia = $assistencia[0];
        } else {
            dd('Erro:', $response);
        }
        return $assistencia;
    }
}
