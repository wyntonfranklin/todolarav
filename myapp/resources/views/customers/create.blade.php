@extends('primary')

@section("content")

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Create new Customer</h1>
            <!-- display flash message -->
            @if(session()->has('status'))
                <div class="alert alert-success">
                    {{ session()->get('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/customers/store" method="POST">
                @method('POST')
                @csrf
                <!-- form group -->
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Customer Number</label>
                            <input name="customerNumber" type="number" class="form-control" placeholder="Contact First Name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Customer Name</label>
                            <input name="customerName" type="text" class="form-control" placeholder="Customer Name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Contact First Name</label>
                            <input name="contactFirstName" type="text" class="form-control" placeholder="Contact First Name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Contact Last Name</label>
                            <input name="contactLastName" type="text" class="form-control" placeholder="Contact Last Name">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input name="phone" type="text" class="form-control" placeholder="Enter phone">
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Sales Rep Employee Number</label>
                            <input name="salesRepEmployeeNumber" type="text" class="form-control" placeholder="Sales rep number">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Credit Limit</label>
                            <input name="creditLimit" type="text" class="form-control" placeholder="Credit Limit">
                        </div>
                    </div>
                </div>
                <!--boostrap 2 grid columns-->
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Address Line 1</label>
                            <input name="addressLine1" type="text" class="form-control" placeholder="Enter Address">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Address Line 2</label>
                            <input name="addressLine2" type="text" class="form-control" placeholder="Enter Address">
                        </div>
                    </div>
                </div>
                <!--boostrap 2 grid columns-->
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input name="city" type="text" class="form-control" placeholder="Enter City">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <input name="state" type="text" class="form-control" placeholder="Enter State">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Postal Code</label>
                                <input name="postalCode" type="text" class="form-control" placeholder="Postal Code"/>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Countries</label>
                                <input name="country" type="text" class="form-control" placeholder="Countries"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end form group -->
                <!-- submit button -->
                <div class="mb-3">
                    <!-- submit button -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route("customers.index")}}" class="btn btn-primary">Back</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
