<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</head>

<body>
  <div id="dump">asdf</div>
  <script>
    setInterval(dump, 1000);

    function dump() {
      fetch('http://pick-server.test/dump')
        .then((response) => response.text())
        .then((html) => {
          if (!html) return

          document.getElementById("dump").innerHTML = html
        }).catch(function(err) {
          console.warn('Something went wrong.', err);
        });
    }
  </script>
</body>

</html>
