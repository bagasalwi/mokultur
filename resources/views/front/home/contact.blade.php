@extends('front.layouts.master')

@section('content')
<section class="section">
    <div class="container">

        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h2 class="text-primary font-weight-bold text-center mb-4">Support</h2>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card card-primary">
                    <div class="row m-0">
                        <div class="col-lg-12 col-sm-12">
                            <div class="card-header text-center">
                                <h4>Kritik & Saran kalian sangat berarti!</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ url('contact-submit') }}">
                                    @csrf
                                    <div class="form-group floating-addon">
                                        <label>Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                            <input id="name" type="text" class="form-control" name="name" autofocus
                                                placeholder="Name" required="required">
                                        </div>
                                    </div>

                                    <div class="form-group floating-addon">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                            </div>
                                            <input id="email" type="email" class="form-control" name="email"
                                                placeholder="Email" required="required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea class="form-control" placeholder="Type your message"
                                            name="description" data-height="150" required="required"></textarea>
                                    </div>

                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            Send Message
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

@if ($message = Session::get('success'))
<script>
    swal("Terima kasih !", "Saran & Kritik anda sangat membantu !");
</script>
@endif

@endsection