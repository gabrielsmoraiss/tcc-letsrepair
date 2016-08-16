<?php
namespace App\Http\Controllers\App;

use Auth;
use Requests;
use Google_Client;
use Hybrid_Auth;
use Hybrid_Endpoint;
use Google_Service_Datastore;
use Google_Service_Datastore_Query;
use Google_Service_Datastore_RunQueryRequest;
use Illuminate\Http\Request;
use Domain\User\UserRequest;
//use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;
use Domain\User\UserRepositoryInterface as User;

class AssistenceController extends BaseController
{
    protected $users;

    public function __construct(User $users)
    {
        $this->users = $users;
        $this->loggedUser = Auth::user();
        $this->tableAssistencesId = "1aPLJfYAPlL3L2KVVC-FyZaspqnpv4MWK-dYpgbPS"; 
        $this->tableAssistencesInfoId = "147rrTiq-rtQAKerNCIXV0V6rXQlrh3P-UHXu13vE"; 
        $this->tableAssistencesMergeId = "1dJbVTrkNi8lSqIYVy_AOSnAU0vtpTlTwoXRsV8rQ"; 
    }

    /**
     * Mostra a tela inicial
     *
     * @return Response
     */ 
    public function index()
    {
        $url = "https://www.googleapis.com/fusiontables/v2/query?sql=SELECT * FROM $this->tableAssistencesId&key=AIzaSyA9Up-4eYIsGn1cwwfMh-Zy1PAH-qPZJEc";

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
        return view('admin.assistence.create');
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

        if(is_null($this->loggedUser->tokenGoogle)) {
            return 'pegar o token';
        }
        $token = 'Bearer ' . $this->loggedUser->tokenGoogle;

        $url = "https://www.googleapis.com/fusiontables/v2/query";

        $headers = [
            'Accept' => 'application/json',
            'Authorization' => $token
        ];

        $optionsAssistence = "(name,category,Location,info,typeProduct,brandsAttended,fone,businessHours) VALUES ";
        $optionsAssistence .= "('$request->name','$request->typeAssist','$request->location','$request->info','$request->typeProduct','$request->brandsAttended','$request->fone','$request->businessHours')";

        $arry['sql'] = "INSERT INTO $this->tableAssistencesId $optionsAssistence;";
 
        $response = Requests::post($url, $headers, $arry);

        dd($response);
        if($response->success) {
            return $this->routeRedirectWithFlash('auth-google', '', "Assistência cadastrada com Sucesso!");
        } 
        return $this->backWithFlash("Ocorreu algum erro", 'danger');
    }

    /**
     * Lista uma pessoa especifica contendo seus planos e faturas
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //$pessoa = $this->pessoas->show($id);

        //return view('admin.pessoas.show', compact('pessoa'));
    }

    /**
     * Mostra a tela para editar uma pessoa especifica
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //$pessoa = $this->pessoas->show($id);

        //return view('admin.pessoas.edit', compact('pessoa'));
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
        /*$this->pessoas->save($request, $id);

        if (Auth::id() == $id) {
            return $this->routeRedirectWithFlash('admin.pessoas.show', $id, "Seu cadastro foi alterado com Sucesso!");
        }
        return $this->routeRedirectWithFlash('admin.pessoas.show', $id, "O cadastro de {$request->nomeRazao} foi alterado com Sucesso!");
        */
    }

    /**
     * Remove uma pessoa especifica
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {   /*if (Auth::id() == $id) {
            return $this->routeRedirectWithFlash('admin.pessoas.index', '', "Você não pode excluir a sua conta! Favor efetuar login com outro usuario.");
        }
        $this->pessoas->destroy($id);
        return $this->routeRedirectWithFlash('admin.pessoas.index', '', "Cadastro Excluido com Sucesso!");
        */
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
        //$urlLogout = route('logout-google');
        //return dump($profile, $provider) . '<a href="' . $urlLogout . '">Log Out</a>';

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
        return 'deslogou!';
    }

}
