@extends('layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Forum</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="forum-messages" class="mb-3" style="height: 300px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: .25rem; padding: 1rem;">
                <!-- Forum messages will be displayed here -->
            </div>
            <form id="forum-form" class="mb-3">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" name="content" id="message-input" rows="3" placeholder="Type your message..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Message</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var fetchMessages = function() {
            $.ajax({
                url: '{{ route("forum.fetch-messages") }}',
                type: 'GET',
                success: function(response) {
                    var messages = response.messages;

                    $('#forum-messages').empty();
                    messages.forEach(function(message) {
                        var messageHtml = '<div class="message';
                        if (message.user) {
                            // Check if message.user exists to avoid undefined errors
                            messageHtml += ' sent">';
                            messageHtml +=  message.content + '</div>';
                        } else {
                            messageHtml += ' received">';
                            messageHtml +=  message.content + '</div>';
                        }
                        $('#forum-messages').append(messageHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching messages:', error);
                }
            });
        };

        fetchMessages();
        setInterval(fetchMessages, 1000); // Refresh messages every second

        $('#forum-form').submit(function(e) {
            e.preventDefault();
            var message = $('#message-input').val();
            $.ajax({
                url: '{{ route("forum.store") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    content: message
                },
                success: function(response) {
                    console.log('Message posted successfully:', response);
                    $('#message-input').val('');
                    fetchMessages();
                },
                error: function(xhr, status, error) {
                    console.error('Error posting message:', error);
                }
            });
        });
    });
</script>

@endsection
