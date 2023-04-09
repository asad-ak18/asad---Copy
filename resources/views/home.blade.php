@extends('layouts.starlight')
@section('title')
    Dashboard active
@endsection
@section('home')
    active
@endsection

@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Dashboard</span>
    </nav>
@endsection



@section('content')
    <h1>Role:{{ Auth::user()->role }}</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (Auth::user()->role == 1)
                <div id="main_section">
                    <div id="total_user" class="alert alert-success">
                        total user :{{ $users->count() }}
                    </div>
                </div>
                    <div class="card">
                      

                        <div class="card-body">
                            <div class="col-6">
                                <div>
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">slno</th>
                                        <th scope="col">name</th>
                                        <th scope="col">email</th>
                                        <th scope="col">created_at</th>
                                        <th scope="col">updated_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ Str::title($user->name) }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->diffforhumans() }}</td>
                                            <td>{{ $user->updated_at->diffforhumans() }}</td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    @include('customer.dashboard')
                @endif


            </div>
        </div>
    </div>
@endsection

@section('scripts_footer')
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['cod', 'credit card'],
                datasets: [{
                    label: 'payment method',
                    data: [{{ $cashondelivary }}, {{ $creditcard }}],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        window.setInterval(function() {
          
          $( "#main_section" ) .load(window.location.href + " #total_user" );
        },3000);
   
    </script>
@endsection
