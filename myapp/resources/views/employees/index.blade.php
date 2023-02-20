@extends('primary')
<!-- Bootstrap container div-->
<div class="container">
    <!-- Bootstrap row div-->
    <div class="row">
        <div class="col-12">
            <h1>Employees</h1>

            <!-- display flash message -->
            @if(session()->has('status'))
                <div class="alert alert-success">
                    {{ session()->get('status') }}
                </div>
            @endif

            <!-- link to create new employee -->
            <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Create New Employee</a>
            <!-- bootstrap table -->
            <table class="table table-bordered">
                <!-- table header -->
                <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Employee Email</th>
                    <th>Employee Ext</th>
                    <th>Show</th>
                </tr>
                <!-- end table header -->
                </thead>
                <!-- table body -->
                <tbody>
                <!-- foreach with employees -->
                @foreach($employees as $employee)
                    <!-- employee row -->
                    <tr>
                        <td>{{ $employee->employeeNumber }}</td>
                        <td>{{ $employee->lastName }}, {{ $employee->firstName }}</td>
                        <td>{{ $employee->email}}</td>
                        <td>{{ $employee->extension}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
                <!-- end table body -->

            </table>

        </div>

    </div>

</div>

