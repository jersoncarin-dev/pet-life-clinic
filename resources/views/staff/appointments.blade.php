@extends('staff.components.html')
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill">
                <h1 class="h3 font-w700 mb-2">
                    Appointments
                </h1>
                <h2 class="h6 font-w500 text-muted mb-0">
                    Welcome <a class="font-w600" href="javascript:void(0)">{{ strtok(trim(auth()->user()->name),' ') }}</a>, you may view all appointments.
                </h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <div id='calendar'></div>
</div>

<div class="modal fade" id="show-ap" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">View appointment</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('staff.appointment.approve') }}">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="block-content font-size-sm">
                        <p>Owner name: <span id="text-owner"></span></p>
                        <p>Purpose: <span id="text-ap"></span></p>
                        <p id="text">Status: <span class="rounded text-white px-2 py-1" id="status"></span></p>
                    </div>
                    <div class="block-content block-content-full text-right border-top d-flex ">
                        <button type="button" class="btn btn-alt-primary mr-auto" data-dismiss="modal">Close</button>
                        <button type="submit" name="reject" class="btn btn-danger mr-1 shouldHidden" value="r">Reject</button>
                        <button type="submit" name="approve" class="btn btn-primary shouldHidden" value="a">Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 800,
            eventClick: function(info) {
                $('#show-ap').modal('show')
                $('#text-ap').text(info.event.extendedProps.purpose)
                $('#text-owner').text(info.event.extendedProps.owner)
                $('#status').text(Boolean(info.event.extendedProps.is_approved) ? 'Approved' : (Boolean(info.event.extendedProps.is_trashed) ? 'Rejected' : 'Pending'))
                $('#status').addClass(Boolean(info.event.extendedProps.is_approved) ? 'bg-success' : (Boolean(info.event.extendedProps.is_trashed) ? 'bg-danger' : 'bg-primary'))
                $('#id').val(info.event.id)

                if(Boolean(info.event.extendedProps.is_approved) || Boolean(info.event.extendedProps.is_trashed)) {
                    $('.shouldHidden').hide(100)
                } else {
                    $('.shouldHidden').show(100)
                }
            }
        });

        @foreach($events as $event)
            calendar.addEvent(@json($event))
        @endforeach

        calendar.render();
    });
</script>
@endsection
<!-- END Page Content -->
@endsection