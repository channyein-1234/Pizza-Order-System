@extends('user.layout.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid" style="height: 100px">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="data-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                            <tr>
                                <td class="align-middle" id="price">{{ $o->created_at->format('j-F-Y') }}</td>
                                <td class="align-middle" id="price">{{ $o->order_code }}</td>
                                <td class="align-middle" id="price">{{ $o->total_price }}</td>
                                <td class="align-middle" id="price">
                                    @if ($o->status == 0)
                                        <button class=" btn text-warning ">
                                            <i class="fa-solid fa-spinner me-2 "></i>Pending
                                        </button>
                                    @elseif ($o->status == 1)
                                        <button class="btn text-success">
                                            <i class="fa-solid fa-circle-check me-2"></i>Success
                                        </button>
                                    @elseif ($o->status == 2)
                                        <button class="btn text-danger ">
                                            <i class="fa-solid fa-circle-exclamation me-2"></i>Reject
                                        </button>
                                    @endif
                                </td>


                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $order->links() }}
                </div>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection
