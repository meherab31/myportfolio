<section id="home-section" class="hero">
    <div class="container">
        <div class="row d-md-flex no-gutters align-items-center justify-content-between">
            <div class="col-md-6 text-container d-flex flex-column justify-content-center align-items-start ftco-animate"
                data-scrollax="properties: { translateY: '70%' }">
                <div class="text">
                    <span class="subheading" id="greeting">Hello!</span>
                    <h1 class="mb-4 mt-3">I'm <span id="name">Meherab Hasan</span></h1>
                    <h2 class="mb-4 animated-text">
                        <span>A</span> <span id="dynamic-subtitle">Passionate Developer</span>
                    </h2>

                    <p>
                        <a href="#" class="btn btn-cl py-3 px-4">Hire me</a>
                        <a href="#" class="btn btn-white btn-outline-white py-3 px-4">My works</a>
                    </p>
                </div>
            </div>

            <!-- Right Column with Background Image and Overlay -->
            <div class="col-md-6 img-container order-md-last d-flex align-items-center">
                <div class="img fade-image" style="background-image: url('frontend/images/hero13.png');">
                    <div class="overlay"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* General styling for hero section */
    .hero {
        padding: 10vh 0;
        color: #fff;
    }
    .btn-cl{
        background-color: #00BFFF;
    }

    #greeting {
        color: #00BFFF;
        font-weight: bold;
        font-size: 2.5em;
        position: relative;
        display: inline-block;
        opacity: 0;
        transform: scale(0.8);
        animation: scaleUp 1s ease-out forwards, underline 1.5s ease-out forwards;
    }

    @keyframes scaleUp {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes underline {
        0% {
            width: 0;
        }
        100% {
            width: 100%;
        }
    }

    /* Underline animation */
    #greeting::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -10px;
        height: 3px;
        width: 100%;
        background-color: #00BFFF;
        transform-origin: left;
        width: 0;
        animation: underline 1.5s ease-out forwards;
    }

    .img-container {
        height: 100vh;
        position: relative;
        overflow: hidden;
    }

    .img {
        height: 100%;
        width: 100%;
        background-size: cover;
        background-position: center;
        transition: background-image 0.8s ease-in-out;
        filter: brightness(1.8) contrast(1);
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    /* Left column text styling */
    .text-container {
        z-index: 2;
        padding: 20px;
        text-align: left;
        max-width: 80%;
        position: relative;
    }

    .text h1 {
        font-size: 2.5em;
        margin: 0;
        font-weight: bold;
    }

    .text h2 {
        font-size: 1.5em;
        margin: 0;
        min-height: 2em;
        position: relative;
    }

    /* Slide-up animation with "smoke" effect */
    @keyframes slideUp {
        0% {
            transform: translateY(20px);
            opacity: 0;
            filter: blur(4px);
        }
        100% {
            transform: translateY(0);
            opacity: 1;
            filter: blur(0);
        }
    }

    .animated-text #dynamic-subtitle {
        display: inline-block;
        opacity: 0; /* Initially hidden */
        animation: slideUp 0.8s ease-out;
        transition: opacity 0.4s ease-out;
    }

    /* Responsive styling */
    @media (max-width: 768px) {
        .text-container {
            text-align: center;
            max-width: 100%;
            padding: 10px;
        }

        .img-container {
            height: 50vh;
        }

        h1 {
            font-size: 2em;
        }

        h2 {
            font-size: 1.3em;
        }
    }
</style>

<script>
    const subtitles = ["Passionate Developer", "Digital Marketing Expert", "Course Trainer", "Tech Enthusiast"];
    const images = ["frontend/images/hero11.png", "frontend/images/hero12.png"];
    let index = 0;

    function changeSubtitle() {
        const dynamicSubtitleElement = document.getElementById("dynamic-subtitle");
        dynamicSubtitleElement.style.opacity = 0; // Start fade-out effect

        setTimeout(() => {
            // Update the subtitle text and background image
            dynamicSubtitleElement.textContent = subtitles[index];
            document.querySelector(".img").style.backgroundImage = `url(${images[index % images.length]})`;

            // Reset animation and fade in the new subtitle
            dynamicSubtitleElement.style.animation = "slideUp 0.8s ease-out";
            dynamicSubtitleElement.style.opacity = 1; // Fade back in

            // Move to the next subtitle and image
            index = (index + 1) % subtitles.length;
        }, 500); // Delay for fade-out transition
    }

    // Start the animation loop
    document.addEventListener("DOMContentLoaded", () => {
        changeSubtitle();
        setInterval(changeSubtitle, 2000); // Update every 3 seconds
    });
</script>
