<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ config('app.name') }} {{ isset($title) ? "- $title" : '' }}</title>

    <link rel="shortcut icon" href="/assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/media/favicons/apple-touch-icon-180x180.png">

    <!-- Stylesheets -->
    <!-- Fonts and OneUI framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="/assets/css/oneui.min.css">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/amethyst.min.css"> -->
    <!-- END Stylesheets -->
    @laravelPWA
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    @auth

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <style>
        .fc-event-title {
            white-space: normal !important;
            margin: 5px;
        }
    </style>

    <script>
        const pusher = new Pusher('2fffda7cc8a67f821c96', {
            cluster: 'ap1'
        });

        const channel = pusher.subscribe('user_id_{{ Auth::id() }}');

        channel.bind('notification', function(res) {
            const message = JSON.parse(res.message)

            const content = `
            <li>
                <a class="text-dark media py-2" href="${message.link}">
                    <div class="mr-2 ml-3">
                        <i class="fa fa-fw fa-bell ${message.is_read ? 'text-success' : ''}"></i>
                    </div>
                    <div class="media-body pr-2">
                        <div class="font-w600">${message.title}</div>
                        <span class="font-w500 text-muted">${message.notif_bound_time}</span>
                    </div>
                </a>
            </li>`

            $('#notification-list').prepend(content)
            $('#notification-dot').show(100)

            try {
                const audio = new Audio('/sound/notif.mp3')
                audio.play()
            } catch (error) {
                console.log(error)
            }

        });
    </script>

    <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        if ('Notification' in window) {

            Notification.requestPermission().then((permission) => {
                if (permission !== 'granted') {
                    Swal.fire({
                        title: 'Notification needed',
                        text: 'Please enable notification to make app work properly.',
                        icon: 'error',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    })

                    throw new Error('Permission denied')
                }
            })
        }

        const beamsTokenProvider = new PusherPushNotifications.TokenProvider({
            url: "{{ route('auth.token') }}",
        });

        const beamsClient = new PusherPushNotifications.Client({
            instanceId: '45ec9053-3bc7-4a9c-a63c-191a790fee08',
        });

        beamsClient.start()
            .then(() => beamsClient.clearAllState())
            .then(() => beamsClient.setUserId("user_id_{{ Auth::id() }}", beamsTokenProvider))
            .then(() => console.log('Successfully registered and subscribed!'))
            .catch(console.error);
    </script>

    @endauth

    <style>
        .nodis {
            display: none;
        }
    </style>
</head>