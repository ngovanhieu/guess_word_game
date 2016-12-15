(function() {
    var runMyCode = function($) {
        //Inject csrf-token to ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //define drawer object
        var drawer = {
            refresh: function () {
                var url = laroute.route('rooms.refresh');

                $.post(url, {id: roomId}, function (response) {
                        if ( response.status  == 200 ) {
                            refreshSuccess (response.data);
                        } else {
                            showError();
                        }
                    }
                );
            },
        }

        //define drawer object
        var guesser = {
            refresh: function () {
                var url = laroute.route('rooms.refresh');

                $.post(url, {id: roomId}, function (response) {
                        if ( response.status  == 200 ) {
                            refreshSuccess (response.data);
                        } else {
                            showError();
                        }
                    }
                );
            },
        }

        //Define common functions
        function refreshSuccess (data) {
            if (data.drawer !== null) {
                $('.drawer .player-name').html(data.drawer.name);
                $('.drawer').data('userid', data.drawer.id);
            } else {
                $('.drawer .player-name').html('');
            }
            if (data.guesser !== null) {
                $('.guesser .player-name').html(data.guesser.name);
                $('.guesser').data('userid', data.guesser.id);
            } else {
                $('.guesser .player-name').html('');
            }
            $('.is-ready').html('');
        }

        function showError() {
            $('.ajax-error').show(400).html('loi');
            
            setTimeout(function () {
                $('.ajax-error').hide(400);
            }, 3000);
        }

        //Init a socket
        var socket = io('http://localhost:3000', {
            'reconnectionAttempts': 3,
        });

        //Joined a room
        var room = "room-" + roomId;
        socket.on('connect', function (data) {
            socket.emit('joined', room);
        });

        //Get new players data when someone joining the room
        socket.on('new-player-connected', eval(userRole + '.refresh'));
    }

    var timer = function() {
        if (window.jQuery && window.jQuery.ui) {
            runMyCode(window.jQuery);
        } else {
            window.setTimeout(timer, 100);
        }
    };
    timer();
})()
