<html>
    <body>
        <div class="card-columns">
            @foreach($array as $element)
                <div class="card" style="width: 30rem;">
                    <img class="card-img-top" src="data:image/gif;base64,{{ $element['base64'] }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $element['username'] }}</h5>
                            <p class="card-text" id="machineName">{{ $element['machine_name'] }}</p>
                                <p class="card-text">{{ $element['ip_address'] }}</p>
                            <p class="card-text">{{ $element['note'] }}</p>
                            <button type="submit"  class="donate_now btn btn-primary btn-default-border-blk generalDonation" data-toggle="modal"  
                                data-backdrop="static" data-keyboard="false" data-target="#popup">Cevap Ver</button>
                        </div>
                </div>
            @endforeach 
        </div>

        <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="popup" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cevap</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Mesaj:</label>
                        <textarea class="form-control" id="messageText"></textarea>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-outline-success" id="send">Gönder</button>
                </div>
                </div>
            </div>
            </div>

    <script>
    $('#send').on('click', function (e) {
        var formData = new FormData();
        var machineName = $("#machineName").text();
        var messageText = $('#messageText').val();

        formData.append("machineName", machineName);
        formData.append("messageText", messageText);
        console.log(formData)
        $('#popup').modal('hide');

        request("{{API('replyWithMessage')}}", formData,function(response){
            Swal.fire({
                position: 'center',
                type :'success',
                title :"Gönderildi",
                timer :2000,
            });
        }, function(error) {
            let json = JSON.parse(error);
            Swal.fire({
                position: 'center',
                type: 'error',
                title: json["message"],
                timer: 2000,
    
                showConfirmButton: false,
            });
    
        });
    });
            
    </script>
    </body>
</html>