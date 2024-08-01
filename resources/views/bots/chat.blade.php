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

            inputtext.addEventListener("keydown", function(event) {
              //alert("codigo:"+ event.code );
                //  event.preventDefault();
                if (event.code === 'Enter') {
                     let div = document.getElementById("messageArea");
                    div.scrollTop = div.scrollHeight+220;
                    alert("ss");
                    inputquit.focus();

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



</script>
@vite(['resources/js/botman/fullscreen.js', 'resources/css/chat.css'])
