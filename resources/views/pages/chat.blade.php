<x-app-layout>
    <div class="container" x-data="{ user: @json(auth()->user()) }">
        <h2>Chat with {{ $receiver->nickname }}</h2>

        <div id="chat-box" class="chat-box" style="border: 1px solid #ccc; padding: 10px; height: 300px; overflow-y: scroll;">
            <!-- Messages will be loaded here -->
            @foreach ($messages as $message)
                <div class="message {{ $message->sender_id == Auth::id() ? 'sent' : 'received' }}">
                    <strong>{{ $message->sender->nickname }}:</strong>
                    <p>{{ $message->message }}</p>
                    <span class="timestamp">{{ $message->created_at->format('H:i') }}</span>
                </div>
            @endforeach
        </div>

        <form id="chat-form" class="mt-3">
            @csrf
            <input type="text" id="message" name="message" class="form-control" placeholder="Type your message..." required>
            <button type="submit" class="btn btn-primary mt-2">Send</button>
        </form>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            setInterval(function() {
                fetchMessages();
            }, 3000);

            function fetchMessages() {
                $.ajax({
                    url: '{{ route('chat.fetchMessages', $receiver->id) }}',
                    method: 'GET',
                    success: function(messages) {
    let messagesContainer = $('#chat-box');
    messagesContainer.empty(); // Clear the existing messages

    messages.forEach(function(message) {
        let messageClass = message.sender_id == {{ Auth::id() }} ? 'sent' : 'received';

        // Ensure message.sender is defined and has a nickname
        if (message.sender && message.sender.nickname) {
            messagesContainer.append(`
                <div class="message ${messageClass}">
                    <strong>${message.sender.nickname}:</strong>
                    <p>${message.message}</p>
                    <span class="timestamp">${message.formatted_time}</span>
                </div>
            `);
        } else {
            console.error("Sender is undefined or missing nickname for message:", message);
        }
    });
}

                });
            }

            $('#chat-form').on('submit', function(e) {
                e.preventDefault();

                var message = $('#message').val();

                $.ajax({
                    url: '{{ route('chat.sendMessage', $receiver->id) }}',
                    method: 'POST',
                    data: {
                        message: message,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $('#message').val(''); // Clear the input field
                        fetchMessages(); // Fetch new messages
                    }
                });
            });
            
        </script>
    </div>
</x-app-layout>
