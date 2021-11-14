@extends('components.html')
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    About the clinic information
                </h1>
                <h2 class="h6 font-w500 text-muted mb-0">
                    Welcome <a class="font-w600" href="javascript:void(0)">{{ strtok(trim(auth()->user()->name),' ') }}</a>, you may meet and contact our team.
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">
    <!-- Frequently Asked Questions -->
    <div class="block block-rounded">
        <div class="block-content block-content-full">
            <div class="p-sm-4 p-xl-7">
                <!-- Introduction -->
                <h2 class="h3"><strong>1.</strong> Service Offered</h2>
                <div id="faq1" class="mb-5" role="tablist" aria-multiselectable="true">
                    <div class="block block-rounded block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">Vaccination</a>
                        </div>
                    </div>
                    <div class="block block-rounded block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">CONSULTATION</a>
                        </div>
                    </div>
                    <div class="block block-rounded block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">VET PHARMACY</a>
                        </div>
                    </div>
                    <div class="block block-rounded block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">PET GROOMING</a>
                        </div>
                    </div>
                    <div class="block block-rounded block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">PET SUPPLIES</a>
                        </div>
                    </div>
                    <div class="block block-rounded block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">PET LODGING</a>
                        </div>
                    </div>
                    <div class="block block-rounded block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">SURGERY (Minor)</a>
                        </div>
                    </div>
                    <div class="block block-rounded block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">CONFINEMENT (Minor)</a>
                        </div>
                    </div>
                </div>
                <!-- END Introduction -->

                <!-- Functionality -->
                <h2 class="h3"><strong>2.</strong> OPEN TIME</h2>
                <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                    <div class="block block-rounded block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">8AM - 8PM EVERYDAY</a>
                        </div>
                    </div>
                </div>
                <!-- END Functionality -->

                <!-- Payments -->
                <h2 class="h3"><strong>3.</strong> DOCTOR'S APPOINTMENT</h2>
                <div id="faq3" class="mb-5" role="tablist" aria-multiselectable="true">
                    <div class="block block-rounded block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">SUNDAY - FRIDAY (10AM - 6PM)</a>
                        </div>
                    </div>
                    <div class="block block-rounded block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">SATURDAY (2PM - 6PM)</a>
                        </div>
                    </div>
                </div>
                <!-- END Payments -->

                <h2 class="h3"><strong>4.</strong> CONTACT US</h2>
                <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                    <div class="block block-rounded block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">+639064683583</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Frequently Asked Questions -->
</div>
<!-- END Page Content -->
<!-- END Page Content -->
@endsection