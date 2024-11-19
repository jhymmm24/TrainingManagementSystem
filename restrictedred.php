<!doctype html>
<title>Training Management System Maintenance</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
<style>
  html, body {
    padding: 0;
    margin: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
  }

  * {
    box-sizing: border-box;
  }

  body {
    background: #d6433b;
    color: #fff;
    font-family: 'Open Sans', sans-serif;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    animation: bgMove 5s linear infinite;
    position: relative;
  }

  @keyframes bgMove {
    0% {
      background: #d6433b;
    }
    50% {
      background: #ff7a7a;
    }
    100% {
      background: #d6433b;
    }
  }

  h1 {
    font-size: 50px;
    font-weight: 100;
    animation: fadeIn 3s ease-in-out;
  }

  p {
    font-size: 20px;
    font-weight: 300;
  }

  article {
    display: block;
    width: 700px;
    padding: 50px;
    margin: 0 auto;
  }

  a {
    color: #fff;
    font-weight: bold;
    text-decoration: none;
    animation: fadeIn 3s ease-in-out;
  }

  a:hover {
    text-decoration: underline;
  }

  svg {
    width: 75px;
    margin-top: 1em;
    animation: bounce 2s ease-in-out infinite;
  }

  /* Fade in effect for texts */
  @keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }

  /* Bouncing animation for the loader */
  @keyframes bounce {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-20px);
    }
  }

</style>

<article>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 202.24 202.24"><defs><style>.cls-1{fill:#fff;}</style></defs><title>Asset 3</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M101.12,0A101.12,101.12,0,1,0,202.24,101.12,101.12,101.12,0,0,0,101.12,0ZM159,148.76H43.28a11.57,11.57,0,0,1-10-17.34L91.09,31.16a11.57,11.57,0,0,1,20.06,0L169,131.43a11.57,11.57,0,0,1-10,17.34Z"/><path class="cls-1" d="M101.12,36.93h0L43.27,137.21H159L101.13,36.94Zm0,88.7a7.71,7.71,0,1,1,7.71-7.71A7.71,7.71,0,0,1,101.12,125.63Zm7.71-50.13a7.56,7.56,0,0,1-.11,1.3l-3.8,22.49a3.86,3.86,0,0,1-7.61,0l-3.8-22.49a8,8,0,0,1-.11-1.3,7.71,7.71,0,1,1,15.43,0Z"/></g></g></svg>
    <h1>We&rsquo;ll be back soon!</h1>
    <div>
        <p>Sorry for the inconvenience. We&rsquo;re performing some maintenance at the moment. We&rsquo;ll be back up shortly!</p>
    </div>
    <div>
        <p>&mdash; Developer ^^</p>
    </div>
</article>
