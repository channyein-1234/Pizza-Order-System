@extends('admin/layout/master')
@section('title', 'products list')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->

                    <div class="table-responsive table-responsive-data2">
                        <a href="{{ route('admin#orderList') }}" class="text-dark m-2"><i class="fa-solid fa-arrow-left"></i>
                            Back</a>


                        <div class="row col-5">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <div class="card-body mt-2 mb-2" style="border-bottom:1px solid black;">
                                        <h2>Order Info</h2>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col"><i class="fa-solid fa-user me-2"></i>Customer Name</div>
                                        <div class="col">{{ strtoupper($orderList[0]->user_name) }}
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col"><i class="fa-solid fa-barcode me-2"></i> Code</div>
                                        <div class="col">{{ $orderList[0]->order_code }}</div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col"><i class="fa-solid fa-calendar me-2"></i>Order Date</div>
                                        <div class="col">{{ $orderList[0]->created_at->format('j-F-Y') }}
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col"><i class="fa-solid fa-money-check-dollar me-2"></i>Total</div>
                                        <div class="col">{{ $order->total_price }} $ <span class="text-danger">(Delivery
                                                fee included)</span></div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>
                                    <th>User Name</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow">
                                        <td class="col-1"></td>
                                        <td>{{ $o->id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td class="col-2"> <img src="{{ asset('storage/' . $o->product_image) }}"
                                                class="img-thumbnail shadow-sm ">
                                        </td>
                                        <td>{{ $o->product_name }}</td>
                                        <td>{{ $o->created_at->format('j-F-Y') }}</td>
                                        <td>{{ $o->qty }}</td>
                                        <td>{{ $o->total }}</td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
