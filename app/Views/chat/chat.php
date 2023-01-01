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

    <div class="chatTitleContainer">Chat(Student Name)</div>
	<div class="chatHistoryContainer">

        <ul class="formComments">
			<li class="commentLi commentstep-1" data-commentid="4">
				<table class="form-comments-table">
					<tr>
						<td><div class="comment-timestamp">12:03 25/4/2016</div></td>
						<td><div class="comment-user">Ollie Bott</div></td>
						<td>
							
						</td>
						<td>
							<div id="comment-4" data-commentid="4" class="comment comment-step1">
								This is a comment HELLO!!!!
                                <div id="commentactions-4" class="comment-actions">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Reply</button>
                                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i> Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i >Delete</button>
                                    </div>                                
                                </div>
                            </div>
						</td>
					</tr>
				</table>
			</li>
            
        </ul>




	</div>
    
    <div class="input-group input-group-sm chatMessageControls">
        <span class="input-group-addon" id="sizing-addon3">Comment</span>
        <input type="text" class="form-control" placeholder="Type your message here.." aria-describedby="sizing-addon3" id="comment">    
        <span class="input-group-btn">
            <button id="clearMessageButton" class="btn btn-default" type="button">Clear</button>
            <button id="send" class="btn btn-primary" type="button"><i class="fa fa-send"></i>Send</button>
        </span>
        <span class="input-group-btn">
            <button id="undoSendButton" class="btn btn-default" type="button" disabled><i class="fa fa-undo"></i>Undo</button>
        </span>
    </div>
</div>

</div>

<script>

    // //keyup event
    // $(document).ready(function(){
    //     $('#message').keyup(function(e){

    //             $.ajax({
    //             url: "/message?message="+message,
    //             success: function(data){
    //                 console.log("success");
    //             }
    //         });
    //         }
   
    //         }));
    //         //jquery insert data to database when user click send button
            
    //         //display message

    $(document).ready(function() {
    $('#send').click(function() {
        var comment = $('#comment').val();
        console.log(comment);
  $.ajax({
    type: 'POST',
    url: '/message?message="+comment',
    success: function(response) {
      console.log(response);
    }
  });
    });

  });




</script>

<?=$this->endsection()?>