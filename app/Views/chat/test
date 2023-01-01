<?=$this->extend('layout/template')?>

<?=$this->section('content')?>

<div class=" container-fluid">
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
        </div>

<div class="container mx-auto">
<div class="chat_window">
    <div class="top_menu">
        <div class="buttons">
            <div class="button close"></div>
            <div class="button minimize"></div>
            <div class="button maximize"></div>
        </div>
        <div class="title">Chat</div>
    </div>
    <div class="container-fluid" id="showmessage">
        
    </div>
    <div class="bottom_wrapper clearfix">
        <div class="message_input_wrapper">
            <input class="message_input" id="message" placeholder="Type your message here..." />
        </div>
        <!-- <div class="send_message">
            <div class="icon"></div>
            <div class="text" id="message">Send</div>
        </div> -->
    </div>
</div>
<div class="message_template">
    <li class="message">
        <div class="avatar"></div>
        <div class="text_wrapper">
            <div class="text"></div>
        </div>
    </li>
</div>
</div>

<script>

    //keyup event
    $(document).ready(function(){
        $('#message').keyup(function(e){
            if(e.keyCode == 13) {
                var message = $(this).val();
                $('#message').val('');
                console.log(message);
                $('#showmessage').append(`
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                ${message}
                            </div>
                        </div>
                    </div>`);
                $.ajax({
                url: "/message?message="+message,
                success: function(data){
                    console.log("success");
                }
            });
            }
            $('.send_message').click(function(){
                var message = $('#message').val();
                $('#message').val('');
                console.log(message);
                $('#showmessage').append(`
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                ${message}
                            </div>
                        </div>
                    </div>`);
                       
                
            });
            //jquery insert data to database when user click send button
            
            //display message
        });
    });

</script>

<?=$this->endsection()?>