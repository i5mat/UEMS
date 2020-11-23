<style>
    #preview{
        width:500px;
        height: 500px;
        margin:0px auto;
    }
</style>
<video id="preview"></video>
<h4>Nombres de visite restantes : <span id="nbre">

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
        console.log(content);
        if(content!=''){
            $.post('http://localhost:8000/api/scan',{data:content, "_token": "{{ csrf_token() }}",},function(response){
                if(response.info=='ok'){
                    scanner.stop()
                    $('#nbre').html(response.msg.capacity)
                    alert("ATTENDANCE RECORDED");
                    window.location.replace("http://localhost:8000/qr");

                }else{
                    alert("NOT RECORDED, EXISTING");
                }
                console.log(response.msg)
            })

        }

    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function (e) {
        console.error(e);
    });
</script>
<div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
    <label class="btn btn-primary active">
        <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
    </label>
    <label class="btn btn-secondary">
        <input type="radio" name="options" value="2" autocomplete="off"> Back Camera
    </label>
</div>
