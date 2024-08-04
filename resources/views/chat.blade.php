@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Chat Interface</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <div id="chat-messages" class="mb-3" style="height: 300px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: .25rem; padding: 1rem;">
                <!-- Chat messages will be displayed here -->
            </div>
            <form id="chat-form" class="d-flex">
                <input type="text" id="message-input" class="form-control mr-2" placeholder="Type your message">
                <!-- Removed file input -->
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var receiver_id = "{{ request()->input('receiver_id') }}";

    $('#chat-form').submit(function(e) {
        e.preventDefault();
        var message = $('#message-input').val();
        var formData = new FormData();
        formData.append('message', message);
        formData.append('receiver_id', receiver_id);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: '{{ route("send-message") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('Message sent successfully:', response);
                $('#message-input').val('');
                fetchMessages();
            },
            error: function(xhr, status, error) {
                console.error('Error sending message:', error);
            }
        });
    });

    function fetchMessages() {
        $.ajax({
            url: '{{ route("fetch-messages") }}',
            type: 'GET',
            data: {
                receiver_id: receiver_id
            },
            success: function(response) {
                var messages = response.messages;
                $('#chat-messages').empty();
                messages.forEach(function(message) {
                    var messageHtml = '<div class="message';
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
            error: function(xhr, status, error) {
                console.error('Error fetching messages:', error);
            }
        });
    }

    fetchMessages();
    setInterval(fetchMessages, 1000);
});
</script>

@endsection