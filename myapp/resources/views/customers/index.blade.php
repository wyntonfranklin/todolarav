@extends('primary')


@section("content")

<!-- Bootstrap container div-->
<div class="container">
    <!-- Bootstrap row div-->
    <div class="row">
        <!-- Bootstrap column div-->
        <div class="col-md-12">
            <h1>Customers</h1>
            <!-- link to create new customer -->
            <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Create New Customer</a>
            <!-- bootstrap table -->
            <table class="table table-bordered">
                <!-- table header -->
                <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Customer Address</th>
                    <th>Customer Phone</th>
                    <th>Show</th>
                </tr>
                <!-- end table header -->
                </thead>
                <!-- table body -->
                <tbody>
                <!-- loop through customers -->
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->customerNumber }}</td>
                        <td>{{ $customer->customerName }}</td>
                        <td>{{ $customer->addressLine1 }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td><a data-id="{{$customer->customerNumber}}" class="more-click" style="cursor: pointer;"><i class="fa fa-arrow-down"></i></a></td>
                    </tr>
                    <tr>
                        <td colspan="5" id="orders-{{ $customer->customerNumber}}" style="display: none;">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Required Date</th>
                                    <th>Shipped Date</th>
                                    <th>Status</th>
                                    <th>Comments</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer->orders as $order)
                                    @if($order->customerNumber == $customer->customerNumber)
                                        <tr>
                                            <td>{{ $order->orderNumber }}</td>
                                            <td>{{ $order->orderDate }}</td>
                                            <td>{{ $order->requiredDate }}</td>
                                            <td>{{ $order->shippedDate }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>{{ $order->comments }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
                <!-- end loop through customers -->
                </tbody>
            </table>


        </div>
    </div>

</div>

    <!-- add asset to the page -->
    <script src="{{ asset('js/customer.js') }}"></script>



@endsection


