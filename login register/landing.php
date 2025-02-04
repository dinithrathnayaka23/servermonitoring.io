<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Room</title>
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/4829/4829008.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        /* General Styles */
body {
    background-color: #222D51;
    margin: 0;
    padding: 0;
    font-family: 'Open Sans', sans-serif;
    box-sizing: border-box;
}

.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 10px;
    text-align: center;
}

h1 {
    text-align: center;
    color: black;
    font-size: 2.5rem;
}

.duino{
    background-image:url(https://www.racksolutions.com/news//app/uploads/AdobeStock_87909563.jpg);
    height: 550px;
}

p {
    text-align: center;
    color: white;
    font-size: 1rem;
}

.button_section {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    width: 90%;
    max-width: 700px;
    margin: 20px auto;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.buttons {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 20px;
    gap: 15px;
}

button {
    color: white;
    font-weight: bold;
    font-size: 1rem;
    background-color: #222D51;
    height: 50px;
    width: 100%;
    max-width: 200px;
    border-radius: 5px;
    border: none;
    transition: 0.3s;
}

button:hover {
    background-color: white;
    color: #222D51;
    cursor: pointer;
    border: 2px solid #222D51;
}

#dinith{
    color:black;
    text-align: center;
    font-size: larger;
    font-family: Open Sans;
}


#text {
    text-align: center;
    color: white;
    font-size: 1.5rem;
    margin: 40px 0 20px;
    margin-top: 100px;
}

.para {
    text-align: center;
    color: white;
    font-size: 1rem;
    width: 90%;
    max-width: 700px;
    margin: 0 auto 20px;
}

img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
}

footer {
    margin-top: 20px;
}

hr {
    border: 1px solid white;
    width: 90%;
    max-width: 700px;
    margin: 0 auto;
}

.copy {
    color: white;
    text-align: center;
    font-size: 0.9rem;
    margin: 10px 0;
}

.animate__animated {
  visibility: hidden; /* Initially hide the element */
}

.animate__animated.animate__slideInDown {
  visibility: visible; /* Make visible when animation is triggered */
}


/* Responsive Design for Tablets and Mobile */
@media (max-width: 768px) {
    h1 {
        font-size: 2rem;
    }

    p {
        font-size: 0.9rem;
    }

    .button_section {
        padding: 15px;
    }

    button {
        font-size: 0.9rem;
    }

    #text {
        font-size: 1.3rem;
    }

    .para {
        font-size: 0.9rem;
    }

    .copy {
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    h1 {
        font-size: 1.8rem;
    }

    p {
        font-size: 0.8rem;
    }

    button {
        font-size: 0.8rem;
        height: 45px;
    }

    #text {
        font-size: 1.2rem;
    }

    .para {
        font-size: 0.8rem;
    }

    .copy {
        font-size: 0.7rem;
    }
}


    </style>
</head>
<body>

    <div class="duino">
        <div class="container">
            <div class="button_section">
               <div id="unilogo">
                     <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwhhDo0NZ9iWcEgTHVMjJWGnWIOunvh-a0Pg&s" alt="uom_logo" width="170px" height="200px">
               </div>
               <h1 class="animate__animated animate__slideInDown">Server Room Monitoring System</h1>
               <p id="dinith" class="animate__animated animate__slideInDown">By Duinobots</p>
               <div class="buttons">
                    <button class="animate__animated animate__slideInDown" onclick="window.location.href='login register.php';">Sign Up</button>
                    <button class="animate__animated animate__slideInDown" onclick="window.location.href='login.php'">Log In</button>
                </div>
           </div>
       </div>
    </div>

    <h1 id="text" class="animate__animated">About Server Room Monitoring System</h1>

    <div class="container">
        <div class="para">
            <p class="animate__animated">This system is an ESP32 microcontroller-based system designed to automate AC units, measure temperature, humidity, VOC concentration, check UPS status, and monitor server status. It also includes a fire alarm system and an immediate SMS alert system.</p>
        </div>
    </div>

    <footer>
        <hr>
        <p class="copy">&copy; All Rights Reserved By Duinobots</p>
    </footer>

    <script>
        //DOM loading
        document.addEventListener("DOMContentLoaded",()=>{
            const elements=document.querySelectorAll(".animate__animated");//selecting all with animation class

            const handleIntersection=(entries,observer)=>{
                entries.forEach((entry) => {
                    if(entry.isIntersecting){
                        entry.target.classList.add("animate__slideInDown");
                        observer.unobserve(entry.target);
                    }
                });
            };

            //create an intersection observer
            const observer=new IntersectionObserver(handleIntersection,{
                threshold:0.1,
            });

            elements.forEach((el)=>observer.observe(el));
        });
    </script>
</body>
</html>
