<?php include 'head.html';?>

<body>
<?php include 'header.html';?>

<section>
    eu sou a págian de documentação
</section>



<script async>
    const backToTop = document.getElementById("back-to-top");



    function goToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function scroll() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) backToTop.style.display = "block";
        else backToTop.style.display = "none";
    }

    window.onscroll = function() {scroll()};
</script>
<script async type="text/javascript" src="../script.js"></script>
</body>
</html>