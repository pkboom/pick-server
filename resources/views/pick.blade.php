<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</head>

<body>
    <div>
        <button onclick="stopRefresh()">Stop refreshing</button>
        <button onclick="refresh()">Refresh</button>
    </div>
    <div id="dump"></div>
    <script>
        let interval = setInterval(dump, 1000);

        function stopRefresh() {
            clearInterval(interval);
        }

        function refresh() {
            document.getElementById("dump").innerHTML = null
        }

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
