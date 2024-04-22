@extends('layout')

@section('content')
    <h1>Chat Interface</h1>
    <div id="chat-messages">
        <!-- Chat messages will be displayed here -->
    </div>
    <form method="GET" id="chat-form">
        <input type="text" id="message-input" placeholder="Type your message">
        <button type="submit">Send</button>
    </form>

    <script>
        $(document).ready(function(){
            var receiver_id = "{{ request()->input('receiver_id') }}";

            // AJAX request to send message
            $('#chat-form').submit(function(e){
                e.preventDefault();
                var message = $('#message-input').val();
                $.ajax({
                    url: '{{ route("send-message") }}',
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        receiver_id: receiver_id,
                        message: message
                    },
                    success: function(response){
                        // Log the response
                        console.log('Message sent successfully:', response);
                        // Handle success
                    },
                    error: function(xhr, status, error){
                        // Log the error
                        console.error('Error sending message:', error);
                        // Handle error
                    }
                });
            });

            // Function to fetch messages
            function fetchMessages(){
                $.ajax({
                    url: '{{ route("receive-message") }}',
                    type: 'GET',
                    success: function(response){
                        var messages = response.messages;
                        // Display messages in chat interface
                    },
                    error: function(xhr, status, error){
                        // Handle error
                    }
                });
            }

            // Call fetchMessages every few seconds to keep messages updated
            setInterval(fetchMessages, 5000);
        });
    </script>

@endsection