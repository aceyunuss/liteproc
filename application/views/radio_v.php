<html>

<head>
  <title>
    Radio Al Muwasholah
  </title>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="icon" href="asset/almw.png" sizes="192x192" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mada&family=Rajdhani:wght@400;600&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body class="bg">

  <div class="fi"></div>
  <div class="fi"></div>

  <div class="container">

    <div class="pict">
    </div>

    <p class="text radioname">Radio On-air Al Muwasholah</p>
    <br>

    <div class="act">
      <audio src="https://radio.almuwasholah.com/radio/8000/stream.mp3" id="stream"> </audio>
      <a href="#" class="play-stop play goPlay"></a>
    </div>

    <div class="info">
      <p class="text title">~</p>
      <p class="text artist"></p>
      <input type="range" id="volume" min="0" max="1" step="0.01" value="1">
    </div>

  </div>

</body>

</html>

<style>
  body {
    background-color: rgba(245, 250, 253, 1);
    background-blend-mode: overlay;
    background-size: cover;
    background-repeat: no-repeat;
    margin: auto;
    background-position: center;
  }

  @media only screen and (max-width: 768px) {
    .bg {
      width: 100%;
    }
  }

  .contaibgner {
    position: relative;
    line-height: 100px;
  }

  .bg>.fi,
  .bg>.fi {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-size: contain;
    z-index: 0;
  }

  .bg>*:not(.fi) {
    position: relative;
    z-index: 1;
  }

  #playstop {
    /* margin: 1.5rem; */
    /* background-color: Transparent; */
    /* background-repeat: no-repeat; */
    /* border: none; */
    /* cursor: pointer; */
    /* overflow: hidden; */
    /* outline: none; */
  }

  #stream {
    display: none;
  }

  .container div {
    float: left;
    clear: none;
  }

  .container {
    background-color: white;
    /* background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)); */
    width: 420px;
    height: 130px;
    border-radius: .8rem;
    display: table;
    margin-right: auto;
    margin-left: auto;
    margin-top: 10%;
    box-shadow: 6px 6px 19px -2px rgba(110, 110, 110, 0.75);
    -webkit-box-shadow: 6px 6px 19px -2px rgba(110, 110, 110, 0.75);
    -moz-box-shadow: 6px 6px 19px -2px rgba(110, 110, 110, 0.75);
  }

  .pict {
    background-image: url(""), linear-gradient(rgba(0, 0, 0, 0.27), rgba(0, 0, 0, 0.27));
    background-blend-mode: overlay;
    background-size: contain;
    background-repeat: no-repeat;
    background-size: 130px 130px;
    width: 130px;
    height: 130px;
    border-top-left-radius: .8rem;
    border-bottom-left-radius: .8rem;
  }

  .text {
    line-height: .1;
    font-family: 'Mada', sans-serif;
    font-family: 'Rajdhani', sans-serif;
  }

  .artist {
    font-size: 15px;
    font-weight: lighter;
    color: #456274;
    margin-bottom: 8px;
  }

  .title {
    font-size: 20px;
    font-weight: 600;
    color: #2e4b5e;
  }

  .info {
    margin: auto auto auto 25px;
  }

  .radioname {
    margin: 25px auto auto 145px;
    font-size: 22px;
    font-weight: bold;
    color: #2e4b5e;
    /* padding-bottom: 25px; */
    margin-bottom: 5px;
  }

  #volume {
    size: 5px;
  }

  .play {
    display: block;
    width: 0;
    height: 0;
    border-top: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 25px solid rgba(73, 184, 232, 1);
    margin: 25px auto 20px 30px;
    position: relative;
    z-index: 1;
    transition: all 0.3s;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    /* left: 10px; */
  }

  .play:before {
    content: "";
    position: absolute;
    top: -25px;
    left: -42px;
    bottom: -25px;
    right: -8px;
    border-radius: 50%;
    border: 5px solid rgba(73, 184, 232, 1);
    z-index: 2;
    transition: all 0.3s;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
  }

  .play:after {
    content: "";
    opacity: 0;
    transition: opacity 0.6s;
    -webkit-transition: opacity 0.6s;
    -moz-transition: opacity 0.6s;
  }

  .play:hover:before,
  .play:focus:before {
    transform: scale(1.1);
    -webkit-transform: scale(1.1);
    -moz-transform: scale(1.1);
  }

  .play.active {
    border-color: transparent;
  }

  .play.active:after {
    content: "";
    opacity: 1;
    width: 3px;
    height: 24px;
    background: rgba(73, 184, 232, 1);
    position: absolute;
    right: 5px;
    top: -12px;
    border-left: 20px solid rgba(73, 184, 232, 1);
  }

  input[type=range] {
    -webkit-appearance: none;
    margin: 10px 0;
    width: 80px;
  }

  input[type=range]:focus {
    outline: none;
  }

  input[type=range]::-webkit-slider-runnable-track {
    width: 100%;
    height: 5px;
    cursor: pointer;
    box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
    background: #d5e6f0;
    border-radius: 5px;
    border: 0px solid #000101;
  }

  input[type=range]::-webkit-slider-thumb {
    box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
    border: 0px solid #000000;
    height: 8px;
    width: 15px;
    border-radius: 7px;
    background: #03a9f4;
    cursor: pointer;
    -webkit-appearance: none;
    margin-top: -1.65px;
  }

  input[type=range]:focus::-webkit-slider-runnable-track {
    background: #d5e6f0;
  }

  input[type=range]::-moz-range-track {
    width: 100%;
    height: 12.8px;
    cursor: pointer;
    animate: 0.2s;
    box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
    background: #d5e6f0;
    border-radius: 25px;
    border: 0px solid #000101;
  }

  input[type=range]::-moz-range-thumb {
    box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
    border: 0px solid #000000;
    height: 20px;
    width: 39px;
    border-radius: 7px;
    background: #03a9f4;
    cursor: pointer;
  }

  input[type=range]::-ms-track {
    width: 100%;
    height: 12.8px;
    cursor: pointer;
    animate: 0.2s;
    background: transparent;
    border-color: transparent;
    border-width: 39px 0;
    color: transparent;
  }

  input[type=range]::-ms-fill-lower {
    background: #d5e6f0;
    border: 0px solid #000101;
    border-radius: 50px;
    box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
  }

  input[type=range]::-ms-fill-upper {
    background: #d5e6f0;
    border: 0px solid #000101;
    border-radius: 50px;
    box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
  }

  input[type=range]::-ms-thumb {
    box-shadow: 0px 0px 0px #000000, 0px 0px 0px #0d0d0d;
    border: 0px solid #000000;
    height: 20px;
    width: 39px;
    border-radius: 7px;
    background: #03a9f4;
    cursor: pointer;
  }

  input[type=range]:focus::-ms-fill-lower {
    background: #d5e6f0;
  }

  input[type=range]:focus::-ms-fill-upper {
    background: #d5e6f0;
  }
</style>


<script>
  $(document).ready(function() {

    var bg = [
      'asset/1.png',
      'asset/2.jpg',
      'asset/3.jpeg',
      'asset/4.jpeg',
      // 'asset/5.jpg',
    ];

    // var Transition = 1000;

    $('.fi').css({
      'background-image': 'url(' + bg[bg.length - 1] + ')',
      'opacity': '0.5',
      'background-size': 'cover',
      'background-repeat': 'no-repeat',
      'margin': 'auto',
      'background-position': 'center'
    });

    window.setInterval(
      function() {
        img = bg.shift();
        bg.push(img);

        var $Backgrounds = $('.fi');
        $Backgrounds.eq(1).hide(0).css({
          'background-image': 'url(' + img + ')'
        }).fadeIn(2000);

        $Backgrounds.eq(0).show(0).fadeOut(2000, function() {
          $(this).show(0).css({
            'background-image': 'url(' + img + ')',
            'opacity': '0.5',
            'background-size': 'cover',
            'background-repeat': 'no-repeat',
            'margin': 'auto',
            'background-position': 'center'
          });
          $Backgrounds.eq(1).hide(0);
        });
      }, 4000
    );

    $audio = $("#stream")[0]
    getStream();

    $('.play-stop').click(function() {
      if (!$(this).hasClass('goPlay')) {
        $(this).addClass('goPlay')
        $audio.pause()
        $("#stream").prop("src", "")
      } else {
        $(this).removeClass('goPlay')
        getStream()
      }
    });


    $('#volume').on('change', setVolume);


    function setVolume(e) {
      var volume = e.target.value;
      $audio.volume = volume;
    }


    function getStream() {
      $.get("https://radio.almuwasholah.com/api/nowplaying/almuwasholah", function(data, status) {

        if (data.is_online) {

          let streamlink = data.station.listen_url
          let playing = data.now_playing
          let artist = playing.song.artist != "" ? playing.song.artist : "~"
          let title = playing.song.title != "" ? playing.song.title : ""

          $(".artist").text(artist)
          $(".title").text(title)
          $("#stream").prop("src", streamlink)
          $(".pict").css('background-image', 'url("' + playing.song.art + '")');

          if (!$(".play-stop").hasClass('goPlay')) {
            $audio.play()
          }

          refreshText(playing.remaining * 1000)

        } else {
          alert("Sorry we are offline")
        }

      });
    }


    function refreshText(time) {
      setTimeout(() => {
        getStream();
      }, time);
    }


    $('.play').click(function() {
      $(this).toggleClass('active');
      return false;
    });

  });
</script>