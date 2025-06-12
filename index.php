<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restro POS System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #1a1a2e;
            color: #e0e0e0;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
            z-index: 1;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
            padding: 50px 70px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4), inset 0 0 10px rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transform: perspective(1000px) rotateX(5deg);
            transition: transform 0.5s ease;
            animation: fadeInContent 1.5s ease-out;
        }

        .content:hover {
            transform: perspective(1000px) rotateX(0deg) translateY(-10px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5);
        }

        .title {
            font-size: 84px;
            color: #ffffff;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.5), 0 0 20px rgba(255, 111, 97, 0.4);
            letter-spacing: 2px;
            margin-bottom: 40px;
            animation: slideInTitle 1.2s ease-out;
            transition: transform 0.3s ease, text-shadow 0.3s ease;
        }

        .title:hover {
            transform: scale(1.05) translateY(-5px);
            text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.6), 0 0 30px rgba(255, 111, 97, 0.6);
        }

        .links {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .links > a {
            color: #e0e0e0;
            background: rgba(255, 255, 255, 0.1);
            padding: 12px 30px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s ease;
            transform: perspective(500px) rotateX(0deg);
            animation: slideInLink 1.5s ease-out forwards;
            animation-delay: calc(0.2s * var(--i));
        }

        .links > a:hover {
            background: linear-gradient(45deg, #ff6f61, #ff9f68);
            color: #fff;
            transform: perspective(500px) rotateX(10deg) translateY(-5px);
            box-shadow: 0 8px 20px rgba(255, 111, 97, 0.5);
            border-color: rgba(255, 111, 97, 0.5);
        }

        .links > a:nth-child(1) { --i: 1; }
        .links > a:nth-child(2) { --i: 2; }
        .links > a:nth-child(3) { --i: 3; }

        .m-b-md {
            margin-bottom: 30px;
        }

        #particle-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        /* Keyframe Animations */
        @keyframes fadeInContent {
            from {
                opacity: 0;
                transform: perspective(1000px) rotateX(20deg) translateY(100px);
            }
            to {
                opacity: 1;
                transform: perspective(1000px) rotateX(5deg);
            }
        }

        @keyframes slideInTitle {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLink {
            from {
                opacity: 0;
                transform: perspective(500px) rotateX(-20deg) translateY(30px);
            }
            to {
                opacity: 1;
                transform: perspective(500px) rotateX(0deg);
            }
        }
    </style>
</head>
<body>
    <canvas id="particle-canvas"></canvas>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Restaurant SIN 
            </div>
            <div class="links">
                <a href="Restro/admin/">Admin Log In</a>
                <a href="Restro/cashier/">Cashier Log In</a>
                <a href="Restro/customer">Customer Log In</a>
            </div>
        </div>
    </div>

    <!-- JavaScript for 3D Falling Particle Animation -->
    <script>
        const canvas = document.getElementById('particle-canvas');
        const ctx = canvas.getContext('2d');

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = -Math.random() * canvas.height;
                this.z = Math.random() * 1500;
                this.size = Math.random() * 3 + 2;
                this.speedY = Math.random() * 2 + 1;
                this.speedX = (Math.random() - 0.5) * 1;
                this.speedZ = (Math.random() - 0.5) * 2;
                this.rotation = Math.random() * Math.PI * 2;
                this.rotationSpeed = (Math.random() - 0.5) * 0.05;
                this.color = `hsl(${Math.random() * 60 + 180}, 70%, 60%)`;
            }

            update() {
                this.y += this.speedY;
                this.x += this.speedX;
                this.z += this.speedZ;
                this.rotation += this.rotationSpeed;

                if (this.y > canvas.height || this.z < 0 || this.z > 1500) {
                    this.y = -Math.random() * 100;
                    this.x = Math.random() * canvas.width;
                    this.z = Math.random() * 1500;
                    this.speedY = Math.random() * 2 + 1;
                    this.speedX = (Math.random() - 0.5) * 1;
                    this.speedZ = (Math.random() - 0.5) * 2;
                }
            }

            draw() {
                const scale = 1500 / (1500 + this.z);
                const x2d = this.x * scale + canvas.width / 2 - (canvas.width / 2) * scale;
                const y2d = this.y * scale + canvas.height / 2 - (canvas.height / 2) * scale;
                const size = this.size * scale;

                ctx.save();
                ctx.translate(x2d, y2d);
                ctx.rotate(this.rotation);
                ctx.beginPath();
                ctx.rect(-size, -size / 2, size * 2, size);
                ctx.fillStyle = this.color;
                ctx.globalAlpha = 1 - this.z / 1500;
                ctx.fill();
                ctx.restore();
            }
        }

        const particles = [];
        for (let i = 0; i < 150; i++) {
            particles.push(new Particle());
        }

        function animate() {
            ctx.fillStyle = 'rgba(26, 26, 46, 0.1)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            particles.forEach(particle => {
                particle.update();
                particle.draw();
            });
            requestAnimationFrame(animate);
        }

        animate();
    </script>
</body>
</html>