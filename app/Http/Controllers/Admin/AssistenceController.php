<?php
namespace App\Http\Controllers\Admin;

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

        return view('admin.assistence.index', compact('assistences'));
    }

    /**
     * Abre o formulario para cadastro de pessoas
     *
     * @return Response
     */
    public function create()
    {
        $typeProducts = $this->typeProducts->listForSelect();
        $brandsAttendeds = $this->brandsAttendeds->listForSelect();

        return view('admin.assistence.create', compact('typeProducts', 'brandsAttendeds'));
    }

    /**
     * Cria uma nova pessoa
     *pessoas
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {  
        $request->typeProduct = $request->typeProduct ? json_encode($request->typeProduct) : null;
        $request->brandsAttended = $request->brandsAttended ? json_encode($request->brandsAttended) : null;
        $request->brandsAttendedWarranty = $request->brandsAttendedWarranty ?
            json_encode($request->brandsAttendedWarranty) : null;

        $request->active = 1;

        if(is_null($this->loggedUser->tokenGoogle)) {
            return 'pegar o token';
        }
        $token = 'Bearer ' . $this->loggedUser->tokenGoogle;

        $url = "https://www.googleapis.com/fusiontables/v2/query";

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => $token
        ];

        $optionsAssistence = "(name,category,Location,info,typeProduct,brandsAttended," .
            "brandsAttendedWarranty,fone,active,businessHoursDate,hoursStart,hoursEnd ) " .
            "VALUES ";

        $optionsAssistence .= "(
            '$request->name',
            '$request->typeAssist',
            '$request->location',
            '$request->info',
            '$request->typeProduct',
            '$request->brandsAttended',
            '$request->brandsAttendedWarranty',
            '$request->fone',
            '$request->active',
            '$request->businessHoursDate',
            '$request->hoursStart',
            '$request->hoursEnd'
        )";

        $arry['sql'] = "INSERT INTO $this->tableAssistencesId $optionsAssistence;";
 
        $response = Requests::post($url, $headers, $arry);

        if($response->success) {
            return $this->routeRedirectWithFlash('auth-google', '', "Assistência cadastrada com Sucesso!");
        } else {
            dd('Erro:', $response);
        }
        return $this->backWithFlash("Ocorreu algum erro", 'danger');
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
     * Mostra a tela para editar uma pessoa especifica
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $url = "https://www.googleapis.com/fusiontables/v2/query?";
        $url .= "sql=SELECT ROWID, name, category, Location, typeProduct, brandsAttended, " .
            "brandsAttendedWarranty, fone, info, active, businessHoursDate, hoursStart, hoursEnd ";
        $url .= "FROM $this->tableAssistencesId WHERE rowid=$id&key=AIzaSyA9Up-4eYIsGn1cwwfMh-Zy1PAH-qPZJEc";


        $assistences = [];
        $headers = ['Accept' => 'application/json'];

        //$options = [    
            //'sql' => "SELECT * FROM $this->tableAssistencesId",
            //'key' => 'AIzaSyA9Up-4eYIsGn1cwwfMh-Zy1PAH-qPZJEc'
        //];

        $response = Requests::get($url, $headers);

            //dd($response);
        if($response->success) {

            $assistenciasJson = json_decode($response->body);
            foreach ($assistenciasJson->rows as $key => $assistenciaJson) {

                $assistencia[] = collect(array_combine($assistenciasJson->columns, $assistenciaJson));
            }
            $assistencia = $assistencia[0];
        } else {
            dd('Erro:', $response);
        }

        $typeProducts = $this->typeProducts->listForSelect();
        $brandsAttendeds = $this->brandsAttendeds->listForSelect();

        return view('admin.assistence.edit', compact('assistencia', 'typeProducts', 'brandsAttendeds'));
    }

    /**
     * Altera uma pessoa especifica
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->typeProduct = $request->typeProduct ? json_encode($request->typeProduct) : null;
        $request->brandsAttended = $request->brandsAttended ? json_encode($request->brandsAttended) : null;
        $request->brandsAttendedWarranty = $request->brandsAttendedWarranty ? json_encode($request->brandsAttendedWarranty) : null;

        if(is_null($this->loggedUser->tokenGoogle)) {
            return 'pegar o token';
        }
        $token = 'Bearer ' . $this->loggedUser->tokenGoogle;

        $url = "https://www.googleapis.com/fusiontables/v2/query";

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => $token
        ];

        $optionsAssistence = "name = '$request->name',
            category = '$request->typeAssist',
            Location = '$request->location',
            info = '$request->info',
            typeProduct = '$request->typeProduct',
            brandsAttended = '$request->brandsAttended',
            brandsAttendedWarranty = '$request->brandsAttendedWarranty',
            fone = '$request->fone',
            active = '$request->active',
            businessHoursDate = '$request->businessHoursDate',
            hoursStart = '$request->hoursStart',
            hoursEnd = '$request->hoursEnd'
        ";

        $arry['sql'] = "UPDATE $this->tableAssistencesId SET $optionsAssistence WHERE ROWID = '$id';";
 
        $response = Requests::post($url, $headers, $arry);
        if($response->success) {
            return $this->routeRedirectWithFlash('auth-google', '', "Assistência atualizada com Sucesso!");
        } else {
            if($response->status_code == 401) {
                return $this->getGoogleLogout();
                //$urlLogout = route('logout-google');
                //return dump($provider) . '<a href="' . $urlLogout . '">Log Out</a>';
            }
            dd('Erro:', $response);
        }
        return $this->backWithFlash("Ocorreu algum erro", 'danger');
    }

    /**
     * Remove uma pessoa especifica
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {   
        if(is_null($this->loggedUser->tokenGoogle)) {
            return 'pegar o token';
        }
        $token = 'Bearer ' . $this->loggedUser->tokenGoogle;

        $url = "https://www.googleapis.com/fusiontables/v2/query";

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => $token
        ];

        $arry['sql'] = "DELETE FROM $this->tableAssistencesId WHERE ROWID = '$id'";
        //dd($arry['sql']);
 
        $response = Requests::post($url, $headers, $arry);
        //dd($response);
        if($response->success) {
            return $this->routeRedirectWithFlash('auth-google', '', "Assistência excluida com Sucesso!");
        } else {
            //401
            dd('Erro:', $response);
        }
        return $this->backWithFlash("Ocorreu algum erro", 'danger');
    }

    /**
     * Obtem login do google, permissão para acesar o fusion tables
     * Armazena o token de acesso no usuário logado.
     *
     */
    public function getGoogleLogin($auth = null)
    { 
        if ($auth == 'auth') {
            try {
                Hybrid_Endpoint::process();

                return;
            } catch (Exception $e) {
                return 'deu pau';
            }
        } 
        $oAuth = new Hybrid_Auth(config_path() . '/google_auth.php');
        $provider = $oAuth->authenticate('Google');
        //dd($provider);
        $token = $provider->adapter->api->access_token;
        $this->users->saveTokenGoogle(Auth::user()->id, $token);
        
        //$profile = $provider->getUserProfile();
        $urlLogout = route('logout-google');
        //return dump($provider) . '<a href="' . $urlLogout . '">Log Out</a>';

        //Chama o index redirecionando para o index de assistencias
        return $this->index();
    }

    /**
     * Obtem login do google
     *
     */
    public function getGoogleLogout()
    {  
        $gauth = new Hybrid_Auth(config_path() . '/google_auth.php');
        $gauth->logoutAllProviders();

        return $this->getGoogleLogin(null);
        //return $this->backWithFlash("O token expirou por favor tente novamente", 'danger');
    }

}
