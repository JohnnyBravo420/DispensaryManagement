<?php
session_start();
date_default_timezone_set( "America/Los_Angeles" );
if(isset($_SESSION['username']) && $_SESSION['username'] !== "GUEST" && isset($_SESSION['privilege']) && $_SESSION['privilege'] !== 1){

$url = 'https://tgtpos.com';

$headers = (get_headers($url));

$headers2 = (get_headers($url, true));
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
    <style>
        * {
            font-size: 18px;
            line-height: 20px;
            box-sizing: border-box;
            overflow: hidden;
        }
        
        html,
        body {
            margin: 0px 0px 0px 0px;
            padding: 1px 1px 1px 1px;
            outline: none;
            border: black solid 1px;
            left: 0px;
            right: 0px;
            top: 0px;
            bottom: 0px;
            overflow: auto;
            position: absolute;
            height:100%;
            min-height:100vh !important;
        }
        
        body {
            /* counter-reset: section -1; */
            min-height: 100%;
        }
        
        html {
            max-width: 100vw;
        }
        
        #right {
            writing-mode: vertical-rl;
            position: fixed;
            left: 300px;
            top: 0px;
            width: 1px;
            height: 600px;
            background-color: red;
        }
        
        #bottom {
            top: 500px;
            left: 0px;
            position: fixed;
            width: 400px;
            height: 1px;
            background-color: red;
        }
        
        #right2 {
            position: fixed;
            right: 50%;
            top: 0px;
            width: 1px;
            height: 100vh;
            background-color: blue;
            writing-mode: vertical-rl;
        }
        
        #bottom2 {
            bottom: 50%;
            left: 0px;
            position: fixed;
            width: 100vw;
            height: 1px;
            background-color: blue;
        }
        
        td::before {
            counter-increment: section;
            /* content: " " counter(section) ": ";
            */
        }
        
        table {
            top: calc(50% -100px);
            left: calc(50% -100px);
        }
        
        td {
            width: 75px !important;
        }
        
        section {
            width: 100%;
            height: 100%;
            /* background-color: blue;*/
        }
        
        th {
            text-align: center;
        }
        
        div {
            overflow: visible;
        }
        
        .s1 {
            text-align: right;
            width: 50%;
        }
        
        .s2 {
            text-align: right;
            height: 50%;
        }
        
        .s1::after,
        .s2::after {
            content: attr("['data-text']");
        }
    </style>
    <title>Screen Readings</title>
    </title>
</head>

<body>
    <section>
        <table id="t1">
            <tbody>
                <tr>
                    <td>innerW</td>
                    <td></td>
                    <td>innerH</td>
                    <td></td>
                </tr>
                <tr>
                    <td>availW</td>
                    <td></td>
                    <td>availH</td>
                    <td></td>
                </tr>
                <tr>
                    <td>html-W</td>
                    <td></td>
                    <td>html-H</td>
                    <td></td>
                </tr>
                <tr>
                    <td>body-W</td>
                    <td></td>
                    <td>body-H</td>
                    <td></td>
                </tr>
                <tr>
                    <td>100%-W</td>
                    <td></td>
                    <td>100%-H</td>
                    <td></td>
                </tr>
                <tr>
                    <td>100-vw</td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td>100=vh</td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
    </section>
    <div id="right">&nbsp;500px
    </div>
    <div id="bottom">&nbsp; 300px
    </div>
    <div id="right2"><span id="s1" data-text=""></span></div>
    <div id="bottom2"><span id="s2" data-text="100"></span></div>
</body>

</html>
<script>
    function $(id) {
        return document.getElementById(id);
    }

    window.addEventListener("DOMContentLoaded", getScreen);
    window.addEventListener("resize", getScreen);

    function getScreen() {
        let cells = document.getElementsByTagName("TD");
        let inW = window.innerWidth;
        let inH = window.innerHeight;
        cells[1].innerText = inW;
        cells[3].innerText = inH;
        let availW = screen.availWidth;
        let availH = screen.availHeight;
        cells[5].innerText = availW;
        cells[7].innerText = availH;
        let clientW = document.documentElement.clientWidth;
        let clientH = document.documentElement.clientHeight;
        cells[9].innerText = clientW;
        cells[11].innerText = clientH;
        let bodyW = document.body.clientWidth;
        let bodyH = document.body.clientHeight;
        cells[13].innerText = bodyW;
        cells[15].innerText = bodyH;
        let r2 = $("right2").getBoundingClientRect();
        let b2 = $("bottom2").getBoundingClientRect();
        cells[21].innerText = b2.width;
        cells[23].innerText = r2.height;
        let r = $("right").getBoundingClientRect();
        let b = $("bottom").getBoundingClientRect();
        cells[17].innerText = b.width;
        cells[19].innerText = r.height;
    }
</script>
    
<?php 

}else{ header("Location: login/"); }  

?>
    
    
