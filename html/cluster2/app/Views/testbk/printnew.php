<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <title>How to print iframe content using jquery - ItSolutionStuff.com</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

  

<body>

    <button>Print</button>

    <iframe id="ipdf" src="NHPFORMTEST.pdf" width="880" height="900"></iframe>

</body>

   

<script type="text/javascript">

    $("button").click(function(){

        var myIframe = document.getElementById("ipdf").contentWindow;

            myIframe.focus();

            myIframe.print();

            return false;

    });

</script>

</html>