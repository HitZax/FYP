<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class="container-fluid">

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

<div class="container-fluid">

<div class="chatContainer">

    <div class="chatTitleContainer">Chat with Lecturer</div>
	<div class="chatHistoryContainer">

        <ul class="formComments">
            <li class="commentLi commentstep-1" data-commentid="4">
                <?php if(empty($messages)):?>
                    <div class="comment-timestamp">No message</div>
                    <button class="btn btn-primary" id="newchat">New Chat</button>
                <?php endif?>

                <?php foreach($messages as $message): ?>
				<table class="form-comments-table">
					<tr>
						<td><div class="comment-timestamp"><?=$message['timestamp']?></div></td>
						<td><div class="comment-user"><?=$message['fullname']?></div></td>
						<td>
							
						</td>
						<td>
                            <?php if ($message['role'] == 'Student'): ?>
							<div id="comment-4" data-commentid="4" class="comment comment-step1 text-bg-primary"><?=$message['message']?></div>
                            <?php else: ?>
                            <div id="comment-4" data-commentid="4" class="comment comment-step1 text-bg-danger"><?=$message['message']?></div>
                            <?php endif; ?>
						</td>
					</tr>
				</table>
                <?php endforeach; ?>
			</li>
        </ul>
	</div>
    
    <div class="input-group input-group-sm chatMessageControls">
        <input type="text" class="form-control" placeholder="Type your message here.." aria-describedby="sizing-addon3" id="comment">    
        <span class="input-group-btn">
            <button id="clearMessageButton" class="btn btn-default" type="button">Clear</button>
            <button id="send" class="btn btn-primary" type="button"><i class="fa fa-send"></i>Send</button>
        </span>
    </div>
</div>

</div>

<script>


    $(document).ready(function() {
        $('#send').click(function() {
            var comment = $('#comment').val();
            console.log(comment);
            $.ajax({
                type: 'post',
                url: "/message?message="+comment,
                success: function(response) {
                    //reload container
                    $('#comment').val('');
                    //by default scroll to the bottom of the chat
                    $('.chatHistoryContainer').load(' .chatHistoryContainer');

                }
            });
        });
    });

    $(document).ready(function() {
        $('#newchat').click(function() {
            // var comment = $('#comment').val();
            // console.log(comment);
            var id = '<?=session()->get('id')?>';
           
            $.ajax({
                type: 'post',
                url: "/newmessage?id="+id,
                success: function(response) {
                    //reload container
                    $('#comment').val('');
                    //by default scroll to the bottom of the chat
                    $('.chatHistoryContainer').load(' .chatHistoryContainer');

                }
            });
        });
    });

    //dont send if comment is empty also space
    $('#send').prop('disabled', true);
    $('#comment').keyup(function()
    {
        if ($(this).val().trim() != '') 
        {
            $('#send').prop('disabled', false);
        } 
        else 
        {
            $('#send').prop('disabled', true);
        }
    });

    //clear the comment box
    $('#clearMessageButton').click(function() {
        console.log('clear');
        $('#comment').val('');
    });

    //sent by enter using ajax
    $('#comment').keypress(function(e) {
        if (e.which == 13) {
            $('#send').click();
            return false;
        }
    });

    //by default, scroll to the bottom of the chat
    // $('.chatHistoryContainer').scrollTop($('.chatHistoryContainer')[0].scrollHeight);

    const container = document.querySelector('.formComments');

    container.scrollTop = container.scrollHeight;







</script>

<?=$this->endsection()?>