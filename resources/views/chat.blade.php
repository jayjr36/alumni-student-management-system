@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Chat Interface</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <div id="chat-messages" class="mb-3" style="height: 300px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: .25rem; padding: 1rem;">
                <!-- Chat messages will be displayed here -->
            </div>
            <form method="GET" id="chat-form" class="d-flex">
                <input type="text" id="message-input" class="form-control mr-2" placeholder="Type your message">
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>


    <script>
         $(document).ready(function(){
            var receiver_id = "{{ request()->input('receiver_id') }}";

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
                    
                        console.log('Message sent successfully:', response);
                     
                        $('#message-input').val('');
                        fetchMessages();
                    },
                    error: function(xhr, status, error){
                        console.error('Error sending message:', error);
                    }
                });
            });

            function fetchMessages(){
    $.ajax({
        url: '{{ route("fetch-messages") }}',
        type: 'GET',
        data: {
            receiver_id: receiver_id // Pass the receiver_id
        },
  
        success: function(response){
    var messages = response.messages;

    $('#chat-messages').empty();
    messages.forEach(function(message) {
        var messageHtml = '<div class="message';
        
        // Check if the message was sent by the current user
        if (message.sender_id === {{ auth()->id() }}) {
            messageHtml += ' sent">';
        } else {
            messageHtml += ' received">';
        }
        
        messageHtml += '<div class="message-content">' + message.message + '</div>';
        messageHtml += '</div>';
        
        $('#chat-messages').append(messageHtml);
    });
},


        error: function(xhr, status, error){
            console.error('Error fetching messages:', error);
        }
    });
}
fetchMessages();
setInterval(fetchMessages, 1000);
});


    </script>

@endsection