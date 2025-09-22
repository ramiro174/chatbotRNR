
@vite(['resources/js/botman/fullscreen.js', 'resources/css/chat.css'])
<script>
    // Example ussage of the fullscreen widget
    const welcomeMessage = "{{ $welcome }}";
    const chatServer = "/api/botman";

    // Create a new observer instance:
    const observer = new MutationObserver(function() {
        if (document.getElementById('botmanChatRoot')) {
            // You must wait until the react component is inserted on the body!
            window.BotmanInstance.chatServer = chatServer;
            window.chatInstance.sayAsBot(welcomeMessage);
            disconectObserver();

            const inputtext = document.getElementById("userText");
            const inputquit = document.getElementById("hideKeyboard");

            inputtext.placeholder = "Escribe aqui tu mensaje";

            inputtext.addEventListener("keydown", (keyboardEvent) => {
                const key = keyboardEvent.code || keyboardEvent.keyCode;
                if (key === 'Enter' || key === 13) {
                    let div = document.getElementById("messageArea");
                    div.scrollTop = div.scrollHeight+220;

                    //inputtext.blur();

                }
            });

        }
    });

    // Set configuration object:
    const config = { childList: true
    };

    // Start the observer
    observer.observe(document.body, config);

    function disconectObserver() {
        observer.disconnect();
    }


    window.onload = function() {
        BotmanWebSocket.disconnect();
        BotmanWebSocket.connect();
    };
</script>
