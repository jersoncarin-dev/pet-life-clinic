<script src="/assets/js/oneui.core.min.js"></script>

<script src="/assets/js/oneui.app.min.js"></script>

<!-- Page JS Helpers (jQuery Sparkline Plugins) -->
<script>

    $('#page-header-notifications-dropdown').click(function() {
        $('.notif-dot').hide(100)

        fetch(`{{ route('notif.read') }}`,{
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json; charset=UTF-8',
                'X-CSRF-Token': '{{ csrf_token() }}'
            },
            method: 'POST'
        })
    })

</script>
@if(\App\Models\Reminder::where(['is_read' => false,'user_id' => Auth::id()])->exists())
<script>$('.notif-dot').show(100)</script>
@endif

@yield('script')