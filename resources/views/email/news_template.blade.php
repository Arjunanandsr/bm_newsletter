<!DOCTYPE html>
<html>
<head>
<title>{{ config('app.name', 'Laravel') }}</title>
<style>
body {
     background-image: url("http://bmusewebsites.s3.amazonaws.com/test/background.jpg");
              background-repeat: repeat-y no-repeat;background-position: 50% 50%;
  text-align: center;
  color: white;
  font-family: Arial, Helvetica, sans-serif;
}

.mail_content{
   margin: 0px auto;
   width : 600px;
   border: 0px coral solid;
   background-color: #f8f5ec;
}
.mail_content_div{
   padding : 50px;
}

.mail_text{
   text-align:left;
   font-family:Georgia, Times, serif;  font-size:14px; color:#333333;
}

.sep{
  height:2px;
  color: #BDBAB5;
}

</style>
</head>
<body>
  <div class="mail_content">
    <div class="mail_content_div">
      <img src="http://bmusewebsites.s3.amazonaws.com/test/logo.gif" width="450px" alt="alt" title="lg">
        <div class="mail_text">
        <hr class="sep">
        <p>Hello {{ $MailData['name'] }},</p>
        {!! $MailData['content'] !!}
        <p>- From {{ config('app.name', 'Company') }}</p>
        <hr class="sep">
        </div>
      </div>
    </div>
  </body>
</html>

