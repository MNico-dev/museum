<?php

namespace App\Repositories;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;

class PaintingRepository
{

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function all($columns = array('*'))
    {
        $access_token = Auth::user()->api_token;

        $options = [
            'headers' => [
                'Authorization' => 'Bearer'." ".$access_token,
                'X-HTTP-USER-ID' => Auth::user()->id,
            ]
        ];

        return $this->guzzleRequest('GET','cuadros',$options);

    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate();
    }

    public function create(array $data)
    {

        $access_token = Auth::user()->api_token;
        $options = [
            'headers' => [
                'Authorization' => 'Bearer'." ".$access_token,
                'X-HTTP-USER-ID' => Auth::user()->id
            ],
            'form_params' => [
                "name" => $data['name'],
                "painter" => $data['painter']
            ]
        ];

        return $this->guzzleRequest('POST','cuadros',$options);
    }

    public function update(array $data, $id)
    {
        $name = $data['name'];
        $painter = $data['painter'];

        $access_token = Auth::user()->api_token;
        $options = [
            'headers' => [
                'Authorization' => 'Bearer'." ".$access_token,
                'X-HTTP-USER-ID' => Auth::user()->id
            ],
            'form_params' => [
                "name" => $name,
                "painter" => $painter
            ]
        ];

        return $this->guzzleRequest('PUT','cuadros/'.$id,$options);

    }

    public function delete($id)
    {
        $access_token = Auth::user()->api_token;
        $options = [
                'headers' => [
                    'Authorization' => 'Bearer'." ".$access_token,
                    'X-HTTP-USER-ID' => Auth::user()->id
                ]
        ];

       return $this->guzzleRequest('DELETE','cuadros/'.$id,$options);

    }

    public function find($id, $columns = array('*'))
    {
        $access_token = Auth::user()->api_token;

        $options = [
            'headers' => [
                'Authorization' => 'Bearer'." ".$access_token,
                'X-HTTP-USER-ID' => Auth::user()->id
            ]
        ];
        return $this->guzzleRequest('GET','cuadros/'.$id,$options);

    }

    public function findBy($filter, $value, $fields = array('*'))
    {
        return $this->model->where($filter, '=', $value)->first($fields);
    }

    public function search()
    {
        // TODO: Implement search() method.
    }


    protected function guzzleRequest($method,$url,$requestContent = null){

        try{
            $response = $this->client->request($method,$url,$requestContent);

        }catch(RequestException  $exception){
            return false;
        }
        return json_decode($response->getBody()->getContents());

    }
}
