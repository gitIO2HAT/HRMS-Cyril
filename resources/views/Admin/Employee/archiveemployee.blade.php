@extends('layouts.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-white text-center rounded-3  p-4">
                        @php
                        $counter = 1;
                        @endphp
                        <div class="col-12">
                            <div class="bg-white rounded h-100 p-4">
                            @include('layouts._message')
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class=" text-dark ">List of Archived Employees</h6>


                                    <div class="d-flex justify-content-between align-items-center">
                                        <form action="" class="me-1">
                                            @csrf
                                            <input type="search" id="search" class="form-control bg-transparent"
                                                name="search" placeholder="Search Here" value="{{ request('search') }}">
                                            <button style="display: none;" class="btn btn-success m-1"
                                                type="submit">Search</button>
                                            <button style="display: none;" type="hidden" class="btn btn-success m-1"
                                                onclick="clearSearch()">Clear</button>
                                        </form>
                                        @if(Auth::user()->user_type == 0)
                                        
                                            <a href="{{url('SuperAdmin/Employee')}}" class="m-1 btn btn-primary ">Back</a>
                                            @elseif(Auth::user()->user_type == 1)
                                        
                                            <a href="{{url('Admin/Employee')}}" class="m-1 btn btn-primary ">Back</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">ID Number</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Position</th>
                                                <th scope="col">Date Archive</th>
                                                <th scope="col">Restore</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($getEmployee as $employee)
                                            <tr>
                                                <th scope="row">{{ $counter++ }}</th>
                                                <td>{{ $employee->custom_id}}</td>
                                                <td>{{ $employee->name}} {{ $employee->lastname}}</td>
                                             
                                                <td>{{ $employee->email}}</td>
                                                <td>{{ $employee->department}}</td>
                                                <td>{{ $employee->position}}</td>
                                                <td>{{ $employee->date_archive}}</td>
                                                @if(Auth::user()->user_type == 0)
                                                <td>
                                                    <a class=" rounded-1"  href="{{ url('SuperAdmin/Employee/Restore/'.$employee->id)}}"> <i class="fas fa-trash-restore" style="color: #63E6BE;"></i></a>
                                                </td>
                                                
                                                @elseif(Auth::user()->user_type == 1)
                                                <td>
                                                    <a class=" rounded-1"  href="{{ url('Admin/Employee/Restore/'.$employee->id)}}"> <i class="fas fa-trash-restore" style="color: #63E6BE;"></i></a>
                                                   
                                                </td>
                                               
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$getEmployee->onEachSide(1)->links()}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @endsection