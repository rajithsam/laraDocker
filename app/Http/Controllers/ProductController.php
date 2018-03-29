<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Exception\GuzzleException;

use GuzzleHttp\Client;

use App\Product;

class ProductController extends Controller
{
    
    public function index()
    {
        $client = new Client();

        $request = $client->request('GET', 'http://192.168.0.112:8180/api/product');
        
        if( $request->getStatusCode() == 200 )
        {   
            $data = $request->getBody();

            $products = json_decode($data, true);
        }
       
        return view('products.index',compact('products'));
    }


   
    public function create()
    {
        return view('products.create');
    }
    
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        
        $client = new Client();

        $product = $request->all();
       
        $result = $client->post('http://192.168.0.112:8180/api/product', [
            'form_params' => [
                'name' => $request->input('name'),
                'detail'=> $request->input('detail')
            ]]);
    
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
    
    public function show($id)
    {
        
        $client = new Client();

        $request = $client->request('GET', 'http://192.168.0.112:8180/api/product/'.$id);
        
        if( $request->getStatusCode() == 200 )
        {   
            $data = $request->getBody();

            $product = json_decode($data, true);
        }
       
        return view('products.show',compact('product'));
    }


    
    public function edit($id)
    {
        $client = new Client();

        $request = $client->request('GET', 'http://192.168.0.112:8180/api/product/'.$id);
        
        if( $request->getStatusCode() == 200 )
        {   
            $data = $request->getBody();

            $product = json_decode($data, true);
        }

        return view('products.edit',compact('product'));
    }


    public function update(Request $request, $id)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $client = new Client();

        $product = $request->all();
       
        $result = $client->put('http://192.168.0.112:8180/api/product/'.$id, [
            'form_params' => [
                'name' => $request->input('name'),
                'detail'=> $request->input('detail')
            ]]);

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }


    public function destroy($id)
    {
        $client = new \GuzzleHttp\Client();

        $request = $client->delete('http://192.168.0.112:8180/api/product/'.$id);

        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
