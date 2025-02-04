@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary mb-4">
            <i class="fas fa-home me-2"></i> Back to Orders
        </a>


        <h2 class="mt-4 mb-4 text-center text-dark fw-bold display-6">
            <i class="fas fa-utensils me-2"></i> Meals for Order #{{ $order->client_name }}
        </h2>


        <div class="table-responsive">
            <table class="table table-hover shadow-sm rounded-3 overflow-hidden">

                <thead class="bg-primary text-white">
                <tr>
                    <th class="py-3 fs-5 text-center">
                        <i class="fas fa-calendar-day me-2"></i> Cooking Date
                    </th>
                    <th class="py-3 fs-5 text-center">
                        <i class="fas fa-truck me-2"></i> Delivery Date
                    </th>
                </tr>
                </thead>


                <tbody class="bg-white">
                @foreach ($order->meals as $meal)
                    <tr class="border-bottom">

                        <td class="py-3 px-4 text-center fw-semibold text-primary">
                            {{ \Carbon\Carbon::parse($meal->cooking_date)->translatedFormat('d M Y') }}
                        </td>


                        <td class="py-3 px-4 text-center fw-semibold text-success">
                            {{ \Carbon\Carbon::parse($meal->delivery_date)->translatedFormat('d M Y') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
