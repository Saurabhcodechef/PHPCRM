<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
    <title>Document</title>
</head>

<body>
    <form method="post">
        <input type="url" placeholder="enter video url">
        <button class="btn btn-primary">Submit</button>
    </form>

    <iframe src="" height="200" width="300" title="Iframe Example"></iframe>
</body>



</html>
<script>
    $('form').on('submit', function(e) {
        e.preventDefault();
        url = $('input').val();
        $('iframe').attr('src', url);
    })
</script>