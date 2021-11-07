<?php

namespace App\Services;

use App\Library\BienteAPI as BienteAPI;
use App\Models\Product;
use App\Models\User;

class ProductService
{
    /**
     * @var BienteAdapter
     */
    protected $bienteAdapter;

    /**
     * ProductService constructor.
     */
    public function __construct()
    {
       $this->bienteAdapter = new BienteAPI();
    }

    /**
     * @return bool|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function readProductsForRemote()
    {
        $data = $this->bienteAdapter->request('GET','api/test/index');
        if (!$data) {
            return false;
        }

        return $data;
    }

    /**
     * @param $data
     * @return bool|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addProductsForRemote($data)
    {
        $data = $this->bienteAdapter->request('POST','api/test/add', json_encode($data));
        if (!$data) {
            return false;
        }

        return $data;
    }

    /**
     * @param $products
     */
    public function saveProducts($products) {
        foreach ($products as $product) {
            foreach ($product as $id => $values) {
                $user = User::find($values->userId);
                if (!$user){
                    $newUser = new User();
                    $newUser->name = 'ali';
                    $newUser->email = rand(100, 200);
                    $newUser->password = rand(100, 200);
                    $newUser->id = $values->userId;
                    $newUser->save();
                }

                $isProduct = Product::find($id);
                if (!$isProduct) {
                    $newProduct = new Product();
                    $newProduct->id = $id;
                    $newProduct->title = $values->productMainInfos[0]->title;
                    $newProduct->user_id = $values->userId;
                    $newProduct->description = $values->productMainInfos[0]->description;
                    $newProduct->stock_count = $values->stockCount;
                    $newProduct->status = $values->status;
                    $newProduct->save();
                }

            }
        }
    }

    /**
     * @return array
     */
    public function getProducts() {
        $products = Product::where('user_id', 129423874)->where('stock_count', '>', 0)->where('status', 1)->get();
        $data = [];
        foreach ($products as $product) {
            $item = [];
            $item['externalId'] = $product->id;
            $item['productTitle'] = $product->productTitle;
            $item['description'] = $product->description;
            $data[] = $item;
        }

        return $data;
    }
}
