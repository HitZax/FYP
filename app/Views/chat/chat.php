<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

<?php if (session()->get('role')== 'Lecturer'): ?>
  <div class=" container-fluid">
              <div class="row">
                  <div class="col-md-12 pt-3">
                      <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                      <li class=" breadcrumb-item active text-dark text-muted" aria-current="page">Dashboard</li>
                          <li class="breadcrumb-item"><a href="/chatlect/.$id" class="text-dark text-underline-hover">
                                  Chat List</a>
                          </li>
                          <li class=" breadcrumb-item active text-dark text-muted" aria-current="page">Chat</li>
                      </ol>
                  </div>
              </div>
            </div>
<?php else: ?>
  <div class=" container-fluid">
              <div class="row">
                  <div class="col-md-12 pt-3">
                      <ol class="breadcrumb border px-2 py-2 bg-dark bg-opacity-10">
                          <li class="breadcrumb-item"><a href="/dashboard" class="text-dark text-underline-hover">
                                  Dashboard</a>
                          </li>
                          <li class=" breadcrumb-item active text-dark text-muted" aria-current="page">Chat</li>
                      </ol>
                  </div>
              </div>
            </div>
            <?php endif;?>

<div class="container-fluid">

<div class="chatContainer">

    <div class="chatTitleContainer">Chat</div>
	<div class="chatHistoryContainer">

        <ul class="formComments">
            <li class="commentLi commentstep-1" data-commentid="4">

      <?php foreach($messages as $message): ?>
				<table class="form-comments-table">
					<tr>
						<td><div class="comment-timestamp"><?=$message['timestamp']?></div></td>
						<td><div class="comment-user"><?=$message['fullname']?></div></td>
						<td></td>
              <td>
                  <?php if ($message['role'] == 'Student'): ?>
                    <div id="comment-4" data-commentid="4" class="comment comment-step1 text-bg-primary"><?=$message['message']?></div>
                  <?php else: ?>
                    <div id="comment-4" data-commentid="4" class="comment comment-step1 text-bg-success"><?=$message['message']?></div>
                  <?php endif; ?>
              </td>
					</tr>
				</table>
          <?php endforeach; ?>
          </li>
            </ul>
          </div>
          <?php if (session()->get('role')== 'Student'): ?>
            <div class="input-group input-group-sm chatMessageControls">
            <div class=" container-fluid d-grid gap-2">
                <button type="button " class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal">Write a message to lecturer <i class="bi bi-send-fill"></i></button>
                </span>
            </div>
            </div>
            <?php else: ?>
              <div class="input-group input-group-sm chatMessageControls">
            <div class=" container-fluid d-grid gap-2">
                <button type="button " class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#lecturerModal">Write a message to student <i class="bi bi-send-fill"></i></button>
                </span>
            </div>
            </div>
            <?php endif; ?>
    </div>

</div>

<!-- Button trigger modal -->

<?php if (session()->get('role')== 'Student'): ?>
<!-- Modal -->
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
                <!-- <label class="form-label float-start">Messages</label> -->
                  <input type="text" name="message" placeholder="Write your message here" class="form-control" style="height: 100px" required>
                  <!-- <div class="invalid-feedback">Please enter your Task Description.</div> -->
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

<!-- Modal -->
<div class="modal fade" id="lecturerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="/message?c=<?=$message['chatid']?>" method="post" autocomplete="off">
      <div class="modal-body">
            <div class="mb-3">
                <!-- <label class="form-label float-start">Messages</label> -->
                  <input type="text" name="message" placeholder="Write your message here" class="form-control" style="height: 100px" required>
                  <!-- <div class="invalid-feedback">Please enter your Task Description.</div> -->
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
<?php endif;?>


<?=$this->endsection()?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchMessages() {
            $.ajax({
                url: '/chat/fetchMessages',
                method: 'GET',
                success: function(data) {
                    var chatBox = document.getElementById('chat-box');
                    chatBox.innerHTML = '';
                    data.messages.forEach(function(message) {
                        chatBox.innerHTML += '<div>' + message.message + '</div>';
                    });
                }
            });
        }

        setInterval(fetchMessages, 3000); // Fetch messages every 3 seconds

        function sendMessage() {
            var message = document.getElementById('message').value;
            $.ajax({
                url: '/chat/sendMessage',
                method: 'POST',
                data: { message: message },
                success: function() {
                    document.getElementById('message').value = '';
                    fetchMessages();
                }
            });
        }
    </script>
</head>
<body>
    <div id="chat-box"></div>
    <input type="text" id="message">
    <button onclick="sendMessage()">Send</button>
</body>
</html>