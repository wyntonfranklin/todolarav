<?php

namespace App\Http\Controllers;


use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController
{


    public function index()
    {
        // get customers with orders
        $customers = Customers::with('orders')->get();
        return view('customers.index', ['customers' => $customers]);
    }

    // create new customer
    public function create()
    {
        // check if request is of class type

        return view('customers.create');
    }

    // store customer
    public function store(Request $request)
    {
        // save new customer from request
        $customer = new Customers();

        // validate request
        $request->validate([
            'customerName' => 'required',
            'contactLastName' => 'required',
            'contactFirstName' => 'required',
            'phone' => 'required',
            'addressLine1' => 'required',
            'addressLine2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postalCode' => 'required',
            'country' => 'required',
            'salesRepEmployeeNumber' => 'required',
            'creditLimit' => 'required',
        ]);
        // assign request to customer
        $customer->customerNumber = $request->customerNumber;
        $customer->customerName = $request->customerName;
        $customer->contactLastName = $request->contactLastName;
        $customer->contactFirstName = $request->contactFirstName;
        $customer->phone = $request->phone;
        $customer->addressLine1 = $request->addressLine1;
        $customer->addressLine2 = $request->addressLine2;
        $customer->city = $request->city;
        $customer->state = $request->state;
        $customer->postalCode = $request->postalCode;
        $customer->country = $request->country;
        $customer->salesRepEmployeeNumber = $request->salesRepEmployeeNumber;
        $customer->creditLimit = $request->creditLimit;
        // save customer
        $customer->timestamps = false;
        $customer->save();
        // show success message
        $request->session()->flash('status', 'Customer created successfully!');

        // redirect to customers index
       return redirect()->route('customers.create');
    }


    // get all customers
    public function databasetesting()
    {
        // customers where customername is like %john%
        // $customers = Customers::where('customername', 'like', '%gift%')->get();
        // customers join by orders table with customerNumber order by customerNumber
      //  $customers = Customers::join('orders', 'customers.customerNumber', '=', 'orders.customerNumber')
        //    ->orderBy('customers.customerNumber', 'asc')->get();

        //customers get by customerName with orders;
        $customers = Customers::where('customerNumber', '=', 103)->with('orders')->get();
        foreach ($customers as $customer) {
            echo $customer->customerName . " ";
            foreach ($customer->orders as $order) {
                echo $order->orderNumber . "<br>";
            }
        }
       // $customers = Customers::
        //return view('customers.index', ['customers' => $customers]);
    }
}
