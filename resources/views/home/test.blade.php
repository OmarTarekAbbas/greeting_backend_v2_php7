<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("button").click(function(){



                $.get("http://ikwm-appvas.isys.mobi:2022/ooredooKWHE/userconfig.aspx", function(data, status){
                    alert("Data: " + data + "\nStatus: " + status);
                    var xml = $.parseXML(yourfile.xml),
                            $xml = $( data );
                    alert($xml) ;
                    $test = $xml.find('DeviceIP');


                    console.log($test.text());

                });





            });
        });
    </script>
</head>
<body>

<button>Get Information</button>

</body>
</html>









<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("button").click(function(){





                $.ajax({
                    url: 'http://ikwm-appvas.isys.mobi:2022/ooredooKWHE/userconfig.aspx',
                    dataType: 'xml',
                    success: function(data){
                        // Extract relevant data from XML
                        var xml_node = $('DeviceIP',data);
                        console.log( xml_node.find('DeviceIP').text() );
                    },
                    error: function(data){
                        console.log('Error loading XML data');
                    }
                });




            });
        });
    </script>
</head>
<body>

<button>Get Information</button>

</body>
</html>








<script>

    function checkForm() {
// alert('here');

        document.getElementById("OASId").value = getURLParameter('OASId');
        document.getElementById("comPaId").value = getURLParameter('comPaId');

        var result;
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
// alert('status = ' +xmlHttp.status)
            if (xmlHttp.readyState == 4 &amp; xmlHttp.status == 200){
                var rep = xmlHttp.responseText ;
                rep = rep.replace(/;/g, "");
// alert(rep)
                document.getElementById('mId').innerHTML = rep;
            }else if (xmlHttp.status==404){
                document.getElementById("myForm").submit();
            }

        };
        xmlHttp.open('GET', 'http://ikwm-appvas.isys.mobi:2022/ooredooKWHE/userconfig.aspx', true);
        xmlHttp.send(null);
// document.getElementById("myForm").submit();
//alert(document.getElementById('mId').value.length);
        if (document.getElementById('mId').value.length &lt; 1) {
            stop = false;
//alert('ssssss');
// alert('start Loop')
            loop();
//alert('stop Loop')
        } else {
//alert('start Loop else')
            stop = true;
            document.getElementById("myForm").submit();
        }



    }




    function loop() {
// alert(i);
        if (!stop &amp; i &lt; 10) {
//alert('length = ' +document.getElementById('mId').value.length)
            if (document.getElementById('mId').value.length &lt; 1) {
                i++;
                stop = false;
// alert(i + ' from if ');
            } else {
// alert(i + ' from else ');
                stop = true;
                document.getElementById("myForm").submit();
            }
            setTimeout("loop()", 100);
//alert('stop ' + stop)
        }
    }

</script>










<!DOCTYPE html>
<html>
<body>

<h2>The XMLHttpRequest Object</h2>

<button type="button" onclick="loadDoc()">Request data</button>

<p id="demo"></p>


<script>
    $(document).ready(function(){
        loadDoc() ;
    });

    function loadDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("demo").innerHTML = this.responseText;


                var xml = $.parseXML(this.responseText),
                        $xml = $( data );
                alert($xml) ;
                $test = $xml.find('DeviceIP');
                console.log($test.text());

            }
        };
        xhttp.open("GET", "http://ikwm-appvas.isys.mobi:2022/ooredooKWHE/userconfig.aspx", true);
        xhttp.send();
    }
</script>

</body>
</html>
