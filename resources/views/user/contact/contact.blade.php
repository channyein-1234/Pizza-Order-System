@extends('user.layout.master')
@section('content')
    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact
                Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form action="{{ route('user#message') }}" method="POST" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <label class="control-label mb-1">Name</label>
                            <input id="cc-pament" name="name" type="text"
                                class="form-control  @error('name') is-invalid @enderror " aria-required="true"
                                aria-invalid="false" placeholder="Enter name">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }};
                                </div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label class="control-label mb-1">Email</label>
                            <input id="cc-pament" name="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" aria-required="true"
                                aria-invalid="false" placeholder="Enter email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }};
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label mb-1">message</label>
                            <textarea id="cc-pament" rows="8" name="message" class="form-control @error('message') is-invalid @enderror"
                                aria-required="true" aria-invalid="false" placeholder="Message"></textarea>
                            @error('message')
                                <div class="invalid-feedback">
                                    {{ $message }};
                                </div>
                            @enderror
                        </div>

                        <div>
                            <a href="">
                                <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                    <i class="fa-solid fa-lock"></i><span class="ms-2" id="payment-button-amount"> Send
                                        Message</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}

                                </button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                    <iframe style="width: 100%; height: 250px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>Relaxia@gmail.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection


{{-- @section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#sendMessageButton').click(function() {
                $userInfo = {
                    'userId': $('#userId').val(),
                    'name': $('#name').val(),
                    'email': $('#email').val(),
                    'message': $('#message').val(),
                }
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/user/message',
                    data: $userInfo,
                    dataType: 'json',
                });

            })




        })
    </script>
@endsection --}}
