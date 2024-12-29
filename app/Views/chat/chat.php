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
            <div class="chatHistoryContainer">
                <ul class="formComments">
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
            <?php if (session()->get('role') == 'Student'): ?>
                <div class="input-group input-group-sm chatMessageControls">
                    <div class="container-fluid d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal">Write a message to <?=$personName?> <i class="bi bi-send-fill"></i></button>
                    </div>
                </div>
            <?php else: ?>
                <div class="input-group input-group-sm chatMessageControls">
                    <div class="container-fluid d-grid gap-2">
                        <button type="button" class="btn btn-success btn-block" data-bs-toggle="modal" data-bs-target="#lecturerModal">Write a message to <?=$personName?> <i class="bi bi-send-fill"></i></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal for Student -->
    <?php if (session()->get('role') == 'Student'): ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/message" method="post" autocomplete="off">
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" name="message" placeholder="Write your message here" class="form-control" style="height: 100px" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send Message <i class="bi bi-send-fill"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Modal for Lecturer -->
        <div class="modal fade" id="lecturerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/message?c=<?=$chatid?>" method="post" autocomplete="off">
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" name="message" placeholder="Write your message here" class="form-control" style="height: 100px" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send Message <i class="bi bi-send-fill"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?=$this->endsection()?>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        function fetchMessages() {
            $.ajax({
                url: '/chat/fetchMessages',
                method: 'GET',
                data: { chatid: <?=$chatid?> },
                success: function(data) {
                    var chatBox = document.getElementById('chat-box');
                    chatBox.innerHTML = '';
                    data.messages.forEach(function(message) {
                        var messageHtml = '<div>' + message.timestamp + ' - ' + message.fullname + ': ' + message.message + '</div>';
                        chatBox.innerHTML += messageHtml;
                    });
                }
            });
        }

        setInterval(fetchMessages, 3000); // Fetch messages every 3 seconds

        document.getElementById('messageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var message = document.getElementById('messageInput').value;
            $.ajax({
                url: '/chat/sendMessage',
                method: 'POST',
                data: { message: message, chatid: <?=$chatid?> },
                success: function() {
                    document.getElementById('messageInput').value = '';
                    fetchMessages();
                }
            });
        });
    });
</script>