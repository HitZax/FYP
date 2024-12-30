<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container-fluid">
    <?php if (session()->get('role') == 'Lecturer'): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 pt-3">
                    <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                        <li class="breadcrumb-item"><a href="/dashboard" class="text-dark text-underline-hover">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/chatlect/<?=$id?>" class="text-dark text-underline-hover">Chat List</a></li>
                        <li class="breadcrumb-item active text-dark text-muted" aria-current="page">Chat</li>
                    </ol>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 pt-3">
                    <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                        <li class="breadcrumb-item"><a href="/dashboard" class="text-dark text-underline-hover">Dashboard</a></li>
                        <li class="breadcrumb-item active text-dark text-muted" aria-current="page">Chat</li>
                    </ol>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="container-fluid">
        <div class="chatContainer">
            <div class="chatTitleContainer text-dark">Chat with <?=$personName?></div>
            <div class="chatHistoryContainer" id="chatHistoryContainer">
                <ul class="formComments" id="chatMessages">
                    <?php foreach($messages as $message): ?>
                        <li class="commentLi commentstep-1" data-commentid="4">
                            <table class="form-comments-table">
                                <tr>
                                    <td><div class="comment-timestamp">
                                            <?php
                                                $date = new DateTime($message['timestamp']);
                                                echo $date->format('D, j M'); // Adjust the format as needed
                                            ?>
                                    </div></td>
                                    <td>
                                        <div class="comment-user">
                                            <?php
                                                $fullname = ucwords(strtolower($message['fullname']));
                                                echo $fullname
                                            ?>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td>
                                        <?php if ($message['role'] == 'Student'): ?>
                                            <div id="comment-4" data-commentid="4" class="comment comment-step1 text-bg-primary"><?=$message['message']?></div>
                                                <div class="text-end text-muted">
                                                    <?php
                                                        $date = new DateTime($message['timestamp']);
                                                        echo $date->format('g:i A'); // Adjust the format as needed
                                                    ?>
                                                </div>
                                        <?php else: ?>
                                            <div id="comment-4" data-commentid="4" class="comment comment-step1 text-bg-success"><?=$message['message']?></div>
                                                <div class="text-end text-muted">
                                                    <?php
                                                        $date = new DateTime($message['timestamp']);
                                                        echo $date->format('g:i A'); // Adjust the format as needed
                                                    ?>
                                                </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="input-group input-group-sm chatMessageControls">
                <form action="/message" method="post" autocomplete="off" class="w-100">
                    <div class="input-group">
                        <input type="text" name="message" placeholder="Write your message here" class="form-control" required>
                        <input type="hidden" name="c" value="<?=$chatid?>">
                        <div class="ms-2">
                            <button type="submit" class="btn btn-secondary">Send Message <i class="bi bi-send-fill"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let isFirstLoad = true;
    let lastMessageCount = 0;

    function fetchMessages() {
        const chatid = <?=$chatid?>;
        fetch(`/fetchMessages?chatid=${chatid}`)
            .then(response => response.json())
            .then(data => {
                const chatMessages = document.getElementById('chatMessages');
                const currentMessageCount = data.messages.length;

                // Check if new messages have appeared
                if (currentMessageCount > lastMessageCount && !isFirstLoad) {
                    playNotificationSound();
                }

                chatMessages.innerHTML = '';
                data.messages.forEach(message => {
                    const messageElement = document.createElement('li');
                    messageElement.classList.add('commentLi', 'commentstep-1');
                    const date = new Date(message.timestamp);
                    const formattedDate = date.toLocaleDateString('en-US', { weekday: 'short', day: 'numeric', month: 'short' });
                    const formattedTime = date.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                    messageElement.innerHTML = `
                        <table class="form-comments-table">
                            <tr>
                                <td><div class="comment-timestamp">${formattedDate}</div></td>
                                <td><div class="comment-user">${message.fullname}</div></td>
                                <td></td>
                                <td>
                                    <div class="comment comment-step1 ${message.role === 'Student' ? 'text-bg-primary' : 'text-bg-success'}">${message.message}</div>
                                    <div class="text-end text-muted">${formattedTime}</div>
                                </td>
                            </tr>
                        </table>
                    `;
                    chatMessages.appendChild(messageElement);
                });

                lastMessageCount = currentMessageCount;

                if (isFirstLoad) {
                    scrollToBottom();
                    isFirstLoad = false;
                }
            });
    }

    function playNotificationSound() {
        const audio = new Audio('/sound/notification-sound.mp3');
        audio.play().then(() => {
            console.log('Notification sound played successfully.');
        }).catch(error => {
            console.error('Error playing notification sound:', error);
        });
    }

    function scrollToBottom() {
        const chatMessages = document.getElementById('chatMessages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    setInterval(fetchMessages, 5000); // Fetch messages every 5 seconds

    // Scroll to bottom on initial load
    window.onload = fetchMessages;

    // Ensure user interaction before playing sound
    document.addEventListener('click', () => {
        isFirstLoad = false;
    });
</script>

<?=$this->endsection()?>