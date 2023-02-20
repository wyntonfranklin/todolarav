@extends('primary')

@section("content")

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Create new Employee</h1>
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
                <form action="{{route("employees.store")}}" method="POST">
                    @method('POST')
                    @csrf
                    <!-- form group -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Employee Number</label>
                                <input name="employeeNumber" type="number" class="form-control" placeholder="Employee Number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input name="firstName" type="text" class="form-control" placeholder="Contact First Name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input name="lastName" type="text" class="form-control" placeholder="Contact Last Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Extension</label>
                                <input name="extension" type="text" class="form-control" placeholder="Sales rep number">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input name="email" type="text" class="form-control" placeholder="Credit Limit">
                            </div>
                        </div>
                    </div>
                    <!--boostrap 2 grid columns-->
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Office</label>
                                <select class="form-control" name="officeCode">
                                    @foreach($offices as $office)
                                        <option value="{{$office->officeCode}}">
                                            {{$office->city}}, {{$office->country}}
                                            ({{$office->phone}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Reports To</label>
                                <select class="form-control" name="reportsTo">
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->employeeNumber}}">
                                            {{$employee->lastName}}, {{$employee->firstName}}
                                            ({{$employee->jobTitle}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Job Title</label>
                        <input name="jobTitle" type="text" class="form-control" placeholder="Employee Number">
                    </div>
                    <!-- end form group -->
                    <!-- submit button -->
                    <div class="mb-3">
                        <!-- submit button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route("employees.index")}}" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
