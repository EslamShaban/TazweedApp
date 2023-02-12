<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ShippingAddressRepository;
use App\Http\Resources\ShippingAddressResource;
use App\Http\Requests\API\ShippingAddressAPIRequest;

class ShippingAddressesAPIController extends Controller
{
    private $shippingAddressRepository;
    
    public function __construct(ShippingAddressRepository $shippingAddress)
    {
        $this->shippingAddressRepository = $shippingAddress;
    }

    public function index()
    {
        $shipping_addresses = auth()->user()->shipping_addresses;

        return response()->withData(__('api.all_shipping_addresses'), ['shipping_addresses' => ShippingAddressResource::collection($shipping_addresses)]);
    }

    public function store(ShippingAddressAPIRequest $request)
    {
        $data = $request->all();
                    
        $data['user_id'] = auth()->user()->id;

        $shipping_address = $this->shippingAddressRepository->create($data);

        return response()->withData(__('api.shipping_address_added_successfully'), ['shipping_address' => new ShippingAddressResource($shipping_address)]);

    }

    public function show($id)
    {
        $shipping_address = $this->shippingAddressRepository->find($id);
                
        if(! $shipping_address)
            return response()->withError(__('api.shipping_address_not_found'), 5001);

        return response()->withData(__('api.shipping_address'), ['shipping_address' => new ShippingAddressResource($shipping_address)]);

    }

        
    public function update(ShippingAddressAPIRequest $request, $id)
    {
        $data = $request->all();
                    
        $data['user_id'] = auth()->user()->id;

        $this->shippingAddressRepository->update($data, $id);

        $shipping_address = $this->shippingAddressRepository->find($id);
        
        return response()->withData(__('api.shipping_address_updated_successfully'), ['shipping_address' => new ShippingAddressResource($shipping_address)]);

    }

    public function destroy($id)
    {
                
        $this->shippingAddressRepository->delete($id);
        
        return response()->withSuccess(__('api.shipping_address_deleted_successfuly'), 200);
    }
}
