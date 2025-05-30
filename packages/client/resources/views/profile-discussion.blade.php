
<div class="flex flex-row divide-x-2">
    <div class="w-3/12 p-5">
        <button class="text-sm text-gray-500 hover:text-gray-700">New</button>
        <ul class="divide-y-2">
            <li onclick="connectToChat(123)">
                <p>Lorem ipsum</p>
                <p class="text-xs text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris.</p>
            </li>
        </ul>
    </div>
    <div class="w-9/12 p-5">
        <div class="min-h-[45vh] overflow-y-auto">

            <div class="flex items-start gap-2.5">
                <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="Jese image">
                <div class="flex flex-col gap-1 w-full max-w-[320px]">
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">Bonnie Green</span>
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">11:46</span>
                    </div>
                    <div class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                        <p class="text-sm font-normal text-gray-900 dark:text-white"> That's awesome. I think our users will really appreciate the improvements.</p>
                    </div>
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Delivered</span>
                </div>
                <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" data-dropdown-placement="bottom-start" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 dark:focus:ring-gray-600" type="button">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>
                </button>
            <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-40 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reply</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Forward</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Copy</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                    </li>
                </ul>
            </div>
            </div>
        </div>

        <div class="relative">
            <textarea class="w-full border border-gray-300 rounded-lg p-2 pr-12 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Type your message..."></textarea>
            <button class="absolute bottom-2 right-2 bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </button>
        </div>
    </div>
</div>
<script>
    function connectToChat(chatId) {
    // Unbind all previous events from the text input
    const textInput = document.querySelector('textarea');
    const sendButton = document.querySelector('button');
    if (textInput) {
        textInput.removeEventListener('keypress', handleSendMessage);
    }
    if (sendButton) {
        sendButton.removeEventListener('click', handleSendMessage);
    }

    // Load chat context into the window
    window.Echo.leave(`chat.${chatId}`); // Leave any previously joined chat channel
    window.Echo.private(`chat.${chatId}`)
        .listen('MessageSent', (message) => {
            console.log('New message received:', message);
            // Append the message to the chat UI
            const chatContainer = document.querySelector('.min-h-[45vh]');
            if (chatContainer) {
                const messageElement = document.createElement('div');
                messageElement.classList.add('flex', 'items-start', 'gap-2.5');
                messageElement.innerHTML = `
                    <img class="w-8 h-8 rounded-full" src="${message.user.avatar}" alt="${message.user.name}">
                    <div class="flex flex-col gap-1 w-full max-w-[320px]">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">${message.user.name}</span>
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">${message.time}</span>
                        </div>
                        <div class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                            <p class="text-sm font-normal text-gray-900 dark:text-white">${message.text}</p>
                        </div>
                    </div>
                `;
                chatContainer.appendChild(messageElement);
                chatContainer.scrollTop = chatContainer.scrollHeight; // Scroll to the bottom
            }
        });

    // Bind a new function to send messages
    function handleSendMessage(event) {
        if (event.type === 'click' || (event.type === 'keypress' && event.key === 'Enter' && !event.shiftKey)) {
            event.preventDefault();
            const message = textInput.value.trim();
            if (message) {
                window.Echo.private(`chat.${chatId}`).whisper('typing', { typing: false });
                window.axios.post(`/chat/${chatId}/send`, { message })
                    .then(() => {
                        textInput.value = ''; // Clear the input
                    })
                    .catch((error) => {
                        console.error('Error sending message:', error);
                    });
            }
        }
    }

    if (textInput) {
        textInput.addEventListener('keypress', handleSendMessage);
    }
    if (sendButton) {
        sendButton.addEventListener('click', handleSendMessage);
    }

    // Optionally, handle typing events
    if (textInput) {
        textInput.addEventListener('input', () => {
            window.Echo.private(`chat.${chatId}`).whisper('typing', { typing: true });
        });
    }
}
</script>
