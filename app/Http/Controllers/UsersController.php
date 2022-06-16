<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class UsersController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->paginate(10);

        return view('index', [
            'users' => $users,
        ]);
    }

    // public function api()
    // {
    //     $ipaymu = new PaymentController();
    //     $ipaymu->getPayment();
    //     // return $ipaymu;
    // }

    public function edit($id)
    {
        $users = DB::table('users')->where('id', $id)->get();
        return view('edit', [
            'users' => $users,
        ]);
    }


    public function update(Request $request)
    {
        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->name,
            'jobs' => $request->jobs,
            'birthdate' => $request->birthdate,
        ]);
        return redirect('/')->with('success', 'Data Pegawai berhasil diedit.');
    }
    public function add()
    {
        return view('add', []);
    }

    public function shop()
    {
        return view('shop', []);
    }
    public function store(Request $request)
    {
        DB::table('users')->insert([
            'id' => Uuid::uuid4()->getHex(),
            'name' => $request->name,
            'jobs' => $request->jobs,
            'birthdate' => $request->birthdate,
        ]);
        return redirect('/')->with('success', 'Data Pegawai berhasil ditambahkan.');
    }
    public function delete($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect('/')->with('failed', 'Data berhasil dihapus.');
    }
    public function search(Request $request)
    {
        $cari = $request->search;

        $users = DB::table('users')
            ->where('name', 'like', "%" . $cari . "%")
            ->orWhere('jobs', 'like', "%" . $cari . "%")
            ->paginate(10);
        return view('index', [
            'users' => $users,
        ]);
    }

    public function filter(Request $request)
    {
        $filter = $request->filter;

        if ($filter == "genap") {
            $users = DB::select('select * from users where DAY(birthdate) % 2 = 0');
            // $users = DB::table('users')
            //     ->whereday('birthdate',)
            //     ->paginate(10);
            return view('index', [
                'users' => $users,
                'filter' => 'Genap'
            ]);
        } else if ($filter == "ganjil") {
            $users = DB::select('select * from users where DAY(birthdate) % 2 <> 0');
            // $users = DB::table('users')
            //     ->whereday('birthdate',)
            //     ->paginate(10);
            return view('index', [
                'users' => $users,
                'filter' => 'Ganjil'
            ]);
        }
    }

    public function getPayment(Request $request)
    {
        // SAMPLE HIT API iPaymu v2 PHP //

        $va           = env('IPAYMU_VA'); //get on iPaymu dashboard
        $secret       = env('IPAYMU_API_KEY'); //get on iPaymu dashboard
        $url          = 'https://sandbox.ipaymu.com/api/v2/payment'; //url
        $method       = 'POST'; //method

        //Request Body//
        $body['product']    = array($request->product_name);
        $body['qty']        = array($request->qty);
        $body['price']      = array($request->price_item);
        $body['returnUrl']  = 'https://mywebsite.com/thankyou';
        $body['cancelUrl']  = 'https://mywebsite.com/cancel';
        $body['notifyUrl']  = 'https://mywebsite.com/notify';
        //End Request Body//
        // dd($body);

        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
        $signature    = hash_hmac('sha256', $stringToSign, $secret);
        $timestamp    = Date('YmdHis');
        //End Generate Signature

        $ch = curl_init($url);

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);


        if ($err) {
            echo $err;
        } else {
            //Response
            $ret = json_decode($ret);
            if ($ret->Status == 200) {
                $sessionId  = $ret->Data->SessionID;
                $url        =  $ret->Data->Url;
                echo '<script>window.location = "' . $url . '";</script>';
                // header('Location: localhost');
            } else {
                echo $ret;
            }
            //End Response
            // $ipaymu = new PaymentController();

            // $ipaymu->getPayment();
        }
    }
}
