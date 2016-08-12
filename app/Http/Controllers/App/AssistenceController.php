<?php
namespace App\Http\Controllers\App;

use Requests;
use Google_Client;
use Google_Service_Datastore;
use Google_Service_Datastore_Query;
use Google_Service_Datastore_RunQueryRequest;
use Illuminate\Http\Request;
use Domain\User\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;

class AssistenceController extends BaseController
{
    /**
     * Mostra a tela inicial
     *
     * @return Response
     */ 
    public function index()
    {   
        $url = 'https://www.googleapis.com/fusiontables/v2/query?sql=SELECT * FROM 1dJbVTrkNi8lSqIYVy_AOSnAU0vtpTlTwoXRsV8rQ&key=AIzaSyA9Up-4eYIsGn1cwwfMh-Zy1PAH-qPZJEc';

        $assistences = [];
        $headers = ['Accept' => 'application/json'];

        $options = [    
            'sql' => 'SELECT * FROM 1dJbVTrkNi8lSqIYVy_AOSnAU0vtpTlTwoXRsV8rQ',
            'key' => 'AIzaSyA9Up-4eYIsGn1cwwfMh-Zy1PAH-qPZJEc'
        ];

        $response = Requests::get($url, $headers, $options);

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
    public function store(Request $requestView)
    {   

        //$url = "https://www.googleapis.com/fusiontables/v2/query?key=AIzaSyA9Up-4eYIsGn1cwwfMh-Zy1PAH-qPZJEc&sql=INSERT INTO 1aPLJfYAPlL3L2KVVC-FyZaspqnpv4MWK-dYpgbPS (name) VALUES ('louco')";

        
        $url = "https://www.googleapis.com/fusiontables/v2/query";
        $headers = ['Accept' => 'application/json'];
        $arry['sql'] = "INSERT INTO 1aPLJfYAPlL3L2KVVC-FyZaspqnpv4MWK-dYpgbPS (name,category) VALUES ('teste','loco')";
        $arry['key'] = "AIzaSyA9Up-4eYIsGn1cwwfMh-Zy1PAH-qPZJEc";
        $response = Requests::post($url, $headers, $arry);
        dd($response);
        //$url = 'INSERT INTO <table_id> (<column_name> {, <column_name>}*) VALUES (<value> {, <value>}*)'

        //tableAssistencias
        //$url = 'https://www.googleapis.com/fusiontables/v2/query';

        //$data = ['name' => 'teste'];
    
        

        //$this->pessoas->save($request->all());

        //return $this->routeRedirectWithFlash('admin.pessoas.index', '', "Pessoa {$request->nomeRazao} cadastrada com Sucesso!");
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

}
