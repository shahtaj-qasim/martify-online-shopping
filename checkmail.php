<?php
session_start();
?>
<html>
    <title></title>
    <script src="jquery-3.0.0.js"></script>
    <style>
    body{
			background: black;
			color: white;
			color: rgba(154, 150, 150, 1);
			font-family: Poor Richard;

		}
		@media(max-width: 1500em){
			ul li {
			display: inline;
			margin-left: 7.5em;
			padding-top: -2em;
			width: 100%;
			
		}
	}
		a{
			text-decoration: none;
		   color:rgba(154, 150, 150, 1); 
		}
		a:hover{
			color: white;
		}
		header{
		font-size: 1em;
		font-family: Courier new;
		letter-spacing: 2px;
		background: black;
		z-index: 100;
		margin-top: -1em;
		width: 100%;
	    }

		ul img{
			width: 2em;
			height: 2em;
			margin-top: 1em;
			margin-left: 1.5em;
		}
        #logo img{
		width: 10em;
		height: 10em;
		margin-top: -3em;
		float: left;
		position: absolute;
		margin-left: -8em;
	}
        .logpage{
            text-align: center;
			font-size: 2vw;
        }
        .logpage h2{
            margin-top: 4vw;
        }
         button{
    	width: 16vw;
    	height: 5vw;
    	border-radius:10px;
    	border-style: none;
    	background: black;
    	border: 1px solid white;
    	color: white;
    	font-size: 20px;
    	font-family: Poor Richard;
    	margin-top: 2vw;
    	letter-spacing: 3px;
    	margin-left: 6vw;
       
    }
        button:hover{
            border-color:  #F79C0E;
            color:  #F79C0E;
           
        }
        #form1 {
         display : none;
            margin-top: 5vw;
        } 
        #form2 {
         display : none;
            margin-top: 5vw;

        }
        button {
         margin-bottom: 10px;
        }
        input{
              width: 20vw;
            height:3vw;
            border-radius: 10px;
            background-color: rgba(154, 150, 150, 0.3);
            color: white;
            margin-right: 1vw;

        }
        input:hover{
            border-color:#F79C0E;
        }


    </style>
<body>
    <header>
	<ul>
		<li id="logo"><img src="logo.png"></div></li>
		<li id="head"><a href="index.php">HOME</a></li>
		<li id="head"><a href="">ABOUT</a></li>
		<li id="head"><a href="contact.php">CONTACT</a></li>
		<li><a href="login.php"><img src="login.gif"></a></li>
		<li><img src="register.png"></li>
		<li><img src="cart.png"></li>
	</ul>
</header>
<div class="logpage">
<h2>WELCOME TO MARTIFY!</h2>
    <p>A Confirmation Email has been sent to your email id:</p> <br>
    <p> <?php echo $_SESSION['email'] ?> </p><br>
    <p> Click the link sent to your email id to complete the registration process </p>

</body>
</html>


