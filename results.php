<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>EveryMundo</title>

        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/carousel.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>

        <link href="css/styles.css" rel="stylesheet">
        <script>
        var response = [];

        function getRoutes(){
            var params = <?php echo json_encode($_POST); ?>;
            console.dir(params);
            var temp = parseInt(params.passengerCount);
            params.passengerCount = temp;
            params = JSON.stringify(params);
            console.dir(params);
            var xtr = new XMLHttpRequest();
            var url = "https://everymundointernship.herokuapp.com/search/EV10RH60TQ36";
            xtr.open('POST', url, true);
            xtr.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
            xtr.onreadystatechange = function() {
                if(xtr.readyState == 4 && xtr.status == 200) {
                    response = xtr.responseText;
                    response = JSON.parse(response);
                    generateContent(response);
                }
            }
            xtr.send(params);
        }

        function generateContent(response){
            console.dir(response);
            var content = document.getElementById('results');
            var txt = "";;
            txt += "<div class='card'><h3>" + response[0].origin + " to " + response[0].destination + "</h3>";
            for(var i=0; i<response[0].routes.length; i++){
                txt += "<div class='HASH'><span class='timex'>" + response[0].routes[i].departureTime + "--------------------" + response[0].routes[i].arrivalTime + "</span>"
                txt +="<span class='ios-circle'>$" +response[0].routes[i].priceUSD + "</span></div>"
            }
            txt+="</div>";
            if(response[0].tripType.localeCompare("oneWay")){
                txt += "<div class='card'><h3>" + response[1].origin + " to " + response[1].destination + "</h3>";
                for(var i=0; i<response[1].routes.length; i++){
                    txt += "<div class='HASH'><span class='timex'>" + response[1].routes[i].departureTime + "-------------------" + response[1].routes[i].arrivalTime + "</span>"
                    txt +="<span class='ios-circle'>$" +response[1].routes[i].priceUSD + "</span></div>"
                }
                txt += '</div>'
            }
            content.innerHTML = txt;
        }

        </script>
    </head>
    <body onload="getRoutes()">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top">
            <a class="navbar-brand" href="#">EveryMundo Airlines</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"></li>
                    <li class="nav-item"></li>
                </ul>
                <a class="nav-link" href="#">Reservations<span class="sr-only">(current)</span></a>
                <a class="nav-link" href="#">Deals<span class="sr-only">(current)</span></a>
                <form class="form-inline mt-2 mt-md-0"></form>
                <a class="nav-link" href="#">About<span class="sr-only">(current)</span></a>
            </div>
        </nav>

        <hr class="featurette-divider knto">

        <div>
            <h1>Choose Your Flight</h1>
            <div id="results">
                <hr class="featurette-divider">
            </div>

            <footer></footer>
        </div>

        <script src="assets/js/jquery.min.js"></script>
    </body>
</html>
