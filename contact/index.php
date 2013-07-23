<!DOCTYPE html>
<html lang="de"> 
<head>
  <meta charset="utf-8" />
  <title>Die Shownotes</title>
  <meta name="viewport" content="width=715" />  
  <meta name="apple-mobile-web-app-capable" content="yes" />  
  <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
  <link rel="icon" type="image/x-icon" href="./favicon.ico" />
  <link rel="stylesheet" href="http://shownot.es/baf/css/baf.min.css?v=006" type="text/css"  media="screen" />
  <link rel="stylesheet" href="http://shownot.es/css/style.min.css?v=006" type="text/css" />
  <link rel="stylesheet" href="http://shownot.es/css/anycast.min.css?v=006" type="text/css"  media="screen" />
  <link rel="stylesheet" href="http://shownot.es/css/startseite.min.css?v=004" type="text/css"  media="screen" />
  <link href="http://selfcss.org/baf/css/icomoon.css" media="screen" rel="stylesheet" type="text/css"/>
  <link rel="apple-touch-startup-image" href="http://shownot.es/img/iPhonePortrait.png" />
  <link rel="apple-touch-startup-image" sizes="768x1004" href="http://shownot.es/img/iPadPortait.png" />
  <style>
    .flattrbtn {
      float: left;
    }
    .flattrbtn iframe {
      height: 20px;
      width: 150px;
      visibility: visible;
      position: relative;
      margin-right: 5px;
    }
    *:focus {
      box-sizing: inherit;
    }
    .input-prepend.baf-input {
      text-align: center;
    }
    span.baf.blue, a.baf.grey {
      border-radius: 8px !important;
    }
  </style>
  <script type="text/javascript">
    function retinval(a) {
      return document.getElementById(a).value
    }
    
    function getdata() {
      var a = "";
      if (retinval("message") == "") {
        a += "Das Feld Nachricht ist leer, bitte füllen Sie mindestens dieses Feld aus, um das Formular zu senden.";
        document.getElementById("alert").innerHTML = a;
        window.setTimeout("document.getElementById('alert').innerHTML = ''", 15000);
        return false
      }
      document.getElementById('sendbutton').className = 'baf blue loading';
      majaX({
        url: "http://simon.waldherr.eu/contactShownotes/",
        method: "POST",
        data: {
          name: retinval("name"),
          timestamp: retinval("timestamp"),
          subject: retinval("subject"),
          email: retinval("email"),
          message: retinval("message"),
          tele: retinval("tele")
        }},
        function (b) {
          if (b == "0") {
            document.getElementById("alert").innerHTML = "Nachricht konnte nicht gespeichert werden."
          } else {
            if (b == "1") {
              document.getElementById("alert").innerHTML = "Nachricht wurde erfolgreich per eMail versendet.";
              document.getElementById("name").value = "";
              document.getElementById("subject").value = "";
              document.getElementById("email").value = "";
              document.getElementById("message").value = "";
              document.getElementById("tele").value = ""
              window.setTimeout("document.getElementById('alert').innerHTML = ''", 10000);
              document.getElementById('sendbutton').className = 'baf blue';
            }
            if (b == "2") {
              document.getElementById("alert").innerHTML = "Nachricht wurde erfolgreich abgespeichert, konnte jedoch nicht versendet werden. Nachrichten die nicht versendet werden konnten werden in unregelmässigen Abständen kontrolliert, sollte Ihnen das zu lange dauern, können Sie es gerne erneut probieren"
            }
          } if ((b != "0") && (b != "1") && (b != "2")) {
            document.getElementById("alert").innerHTML = 'Nachricht konnte aufgrund eines schwerwiegenden Fehlers nicht gespeichert werden. Dieser Fehler könnte längere Zeit dauern, bitte verwenden Sie vorübergehend die E-Mail-Adresse <a href="mailto:contact@simonwaldherr.de">contact@simonwaldherr.de</a> und erwähnen Sie diese Fehlermeldung.';
            alert("Schwerer Ausnahmefehler!")
          }
        });
      window.setTimeout("document.getElementById('alert').innerHTML=''", 15000);
      return false
    }
  </script>
</head>
<body onload="baf_listenerInit();">
<div class="content">
  <div class="header" style="width: 430px; margin: auto; margin-bottom: 10px;">
    <div class="title"><a href="/"><img src="http://shownot.es/img/logo.png" alt="Shownot.es Logo">Die Shownotes</a></div>
  </div>
  <div class="box" id="main" style="width: 390px; margin: auto;">
    <div class="contact">
      <form action="http://simon.waldherr.eu/contactShownotes/" id="contactForm" method="post" onsubmit="return getdata();">
        <div class="input-prepend baf-input"><label class="baf grey w120 add-on" for="name" id="label-Name1">Name</label><input class="input-grey" id="name" name="text-Name1" maxlength="" size="16" type="text"/></div>
        <div style="display:none"><label for="timestamp">Timestamp:</label><input id="timestamp" name="timestamp" type="text" value="<?php echo time(); ?>"></div>
        <div class="input-prepend baf-input"><label class="baf grey w120 add-on" for="email" id="label-eMail2">eMail</label><input class="input-grey" id="email" name="text-eMail2" maxlength="" size="16" type="text"/></div>
        <div style="display:none"><label for="tele">Telefon:</label><input id="tele" name="tele" type="text" value="foo"></div>
        <div class="special" style="display:none"><label for="last">Don't fill this in:</label><input id="last" name="last" type="text"></div>
        <div class="input-prepend baf-input"><label class="baf grey w120 add-on" for="subject" id="label-Betreff3">Betreff</label><input class="input-grey" id="subject" name="text-Betreff3" maxlength="" size="16" type="text"/></div>
        <div class="textarea" style="margin: 20px; width: 350px;">
          <label class="baf add-on w90" for="message" id="">Nachricht</label><br/>
          <textarea class="" id="message" name="message" onkeyup="" style="height: 120px;" type="text"></textarea>
        </div>
        <br/>
        <p id="alert"></p>
        <div class="baf-group">
          <a class="baf grey" href="http://shownot.es/">
            <span class="baf-icomoon big" aria-hidden="true" data-icon="&#xe038;"> &nbsp;
            </span>zurück</a>
        </div>
        <div class="baf-group" style="margin-left: 135px;">
          <span onclick="javascript:getdata()" class="baf blue" id="sendbutton">
            <span class="baf-icomoon big" aria-hidden="true" data-icon="&#xe02f;"> &nbsp;
            </span>absenden</span>
        </div> 
      </form>
    </div>
  </div>
  <div class="footer" style="width: 390px; margin: auto; margin-top: 10px;">&nbsp;<span>&copy; 2013 <a href="http://shownot.es/">shownot.es</a></span></div>
</div>
<script src="http://selfcss.org/baf/js/baf.min.js"></script>
<script src="http://simonwaldherr.github.io/majaX.js/majax.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34667234-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = 'http://statistik.simon.waldherr.eu/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

/* <![CDATA[ */
    (function() {
        var s = document.createElement('script');
        var t = document.getElementsByTagName('script')[0];

        s.type = 'text/javascript';
        s.async = true;
        s.src = '//api.flattr.com/js/0.6/load.js?'+
                'mode=auto&uid=shownotes&language=de_DE&category=text&button=compact&popout=0';
        s.button = 'compact';
        s.popout = false;

        t.parentNode.insertBefore(s, t);
    })();
/* ]]> */

</script>
</body>
</html>
