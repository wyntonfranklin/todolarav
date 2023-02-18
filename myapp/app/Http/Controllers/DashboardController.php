<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // get data from database order by id
        $data = DB::table('users')->orderBy('id', 'asc')->get()->toArray();
        return view('dashboard', ['data' => $data]);
    }

    // add new user
    public function add()
    {
        $json = $this->api("https://app.wftutorials.com/api/tutorials");
        $data = json_decode($json);
        // forloop to get data from api
        foreach ($data->tutorials as $key => $value) {
            // pretty print
            echo "<pre>";
            echo print_r($value);
            echo "</pre>";
        }
    }

    // simple view
    public function tutorials(){
        $json = $this->apiRequest("https://app.wftutorials.com/api/tutorials?page=2");
        $data = json_decode($json);
        return view('tutorials',['tutorials'=>$data->tutorials]);
    }

    public function table(){
        $json = $this->apiRequest("https://app.wftutorials.com/api/tutorials?page=2");
        $data = json_decode($json, true);
        $tutorialsJson = json_encode($data["tutorials"]);
        return view('table',['tutorials'=>$tutorialsJson]);
    }

    public function api(){
        // get request param if null set to 1
        $page = request()->get('page') ?? 1;
        // return response as json
        $json = $this->apiRequest("https://app.wftutorials.com/api/tutorials?page=" . $page);
        $data = json_decode($json, true);
        return response()->json($data);
    }



    public function view(){
        // return view
        return view('api');
    }



    // connect to api using curl
    private function apiRequest($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }

}
