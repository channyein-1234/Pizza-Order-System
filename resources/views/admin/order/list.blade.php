@extends('admin/layout/master')
@section('title', 'products list')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>

                    </div>

                    {{-- information status  --}}
                    @if (session('createSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i>Category Created!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-xmark"></i>Category deleted!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif


                    <div class="row my-3">
                        <div class="col-2 my-1 text-center offset-10">
                            <h4>Total - ({{ count($order) }})</h4>
                        </div>

                    </div>


                    <form action="{{ route('admin#changeStatus') }}" method="GET" class="col-3">
                        @csrf
                        <div class="input-group mb-3">
                            <select name="orderStatus" class="custom-select text-center" id="inputGroupSelect04">
                                <option value="">All</option>
                                <option @if (request('orderStatus') == '0') selected @endif value="0">Pending</option>
                                <option @if (request('orderStatus') == '1') selected @endif value="1">Success</option>
                                <option @if (request('orderStatus') == '2') selected @endif value="2">Reject</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-sm bg-dark text-white" type="submit">Search</button>
                            </div>
                        </div>
                    </form>




                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <td>User ID</td>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td>{{ $o->user_name }}</td>
                                        <td>{{ $o->user_id }}</td>
                                        <td>{{ $o->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin#listInfo', $o->order_code) }}">{{ $o->order_code }}</a>
                                        </td>
                                        <td>{{ $o->total_price }}$</td>
                                        <td>
                                            <select name="status" class="form-control text-center statusChange">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending
                                                </option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Success</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>
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


@section('scriptSource')
    <script>
        $(document).ready(function() {

            //change status
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $orderId = $parentNode.find('.orderId').val();

                $data = {
                    'orderId': $orderId,
                    'status': $currentStatus,
                }
                console.log($data);

                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',

                })



            })

        })
    </script>

@endsection
