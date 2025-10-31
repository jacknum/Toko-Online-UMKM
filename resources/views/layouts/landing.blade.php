<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TokoOnline - Solusi Toko Online UMKM')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4cc9f0;
            --success: #4ade80;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1e293b;
            --light: #f8fafc;
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--gradient);
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        /* Tombol Login - Outline Biru */
        .btn-login {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        /* Tombol Pelajari Fitur - Outline Putih (Hero Section) */
        .btn-outline-primary {
            border: 2px solid white;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            border-color: var(--primary);
        }

        /* Tombol Lihat Semua Fitur - Outline Biru (Features Section) */
        .btn-outline-feature {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-outline-feature:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.05)" points="0,1000 1000,0 1000,1000"/></svg>');
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .hero-badge {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1rem;
            display: inline-block;
            backdrop-filter: blur(10px);
        }

        /* Features Section */
        .section {
            padding: 5rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            font-size: 1.1rem;
            text-align: center;
            color: #64748b;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .feature-description {
            color: #64748b;
            line-height: 1.6;
        }

        /* Stats Section */
        .stats {
            background: var(--light);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .stat-label {
            color: #64748b;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        /* CTA Section */
        .cta {
            background: var(--gradient-secondary);
            color: white;
            padding: 5rem 0;
            text-align: center;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-subtitle {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-brand {
            font-size: 1.5rem;
            font-weight: 700;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
        }

        /* Animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        /* Chart Container */
        .chart-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Cartoon 3D Container - Simple dan Clean */
        .cartoon-3d-container {
            padding: 1rem;
        }

        .cartoon-3d {
            max-height: 400px;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .cartoon-3d:hover {
            transform: scale(1.02);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .feature-card {
                margin-bottom: 2rem;
            }
        }

        /* 3D Animation Container */
        .animation-3d-container {
            position: relative;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1200px;
        }

        /* 3D Scene */
        .scene-3d {
            width: 200px;
            height: 200px;
            position: relative;
            transform-style: preserve-3d;
            animation: rotate-3d 20s infinite linear;
        }

        /* 3D Cube */
        .cube {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transform: rotateX(-15deg) rotateY(-15deg);
        }

        /* Cube Faces */
        .face {
            position: absolute;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: 2px solid rgba(255, 255, 255, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.3);
            backdrop-filter: blur(10px);
        }

        .face span {
            font-size: 0.8rem;
            margin-top: 10px;
            font-weight: 500;
        }

        .face.front {
            transform: translateZ(100px);
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .face.back {
            transform: rotateY(180deg) translateZ(100px);
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }

        .face.right {
            transform: rotateY(90deg) translateZ(100px);
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .face.left {
            transform: rotateY(-90deg) translateZ(100px);
            background: linear-gradient(135deg, #43e97b, #38f9d7);
        }

        .face.top {
            transform: rotateX(90deg) translateZ(100px);
            background: linear-gradient(135deg, #fa709a, #fee140);
        }

        .face.bottom {
            transform: rotateX(-90deg) translateZ(100px);
            background: linear-gradient(135deg, #a8edea, #fed6e3);
        }

        /* 3D Rotation Animation */
        @keyframes rotate-3d {
            0% {
                transform: rotateY(0deg) rotateX(10deg);
            }

            25% {
                transform: rotateY(90deg) rotateX(15deg);
            }

            50% {
                transform: rotateY(180deg) rotateX(10deg);
            }

            75% {
                transform: rotateY(270deg) rotateX(15deg);
            }

            100% {
                transform: rotateY(360deg) rotateX(10deg);
            }
        }

        /* Floating Elements */
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .element {
            position: absolute;
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(102, 126, 234, 0.2);
        }

        .element-1 {
            top: 10%;
            left: 10%;
            animation: float-element-1 6s ease-in-out infinite;
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
        }

        .element-2 {
            top: 20%;
            right: 15%;
            animation: float-element-2 7s ease-in-out infinite 1s;
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
        }

        .element-3 {
            bottom: 25%;
            left: 15%;
            animation: float-element-3 8s ease-in-out infinite 2s;
            background: linear-gradient(135deg, #d4fc79, #96e6a1);
        }

        .element-4 {
            bottom: 15%;
            right: 10%;
            animation: float-element-4 9s ease-in-out infinite 3s;
            background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
        }

        /* Floating Animations */
        @keyframes float-element-1 {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @keyframes float-element-2 {

            0%,
            100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(-25px) scale(1.1);
            }
        }

        @keyframes float-element-3 {

            0%,
            100% {
                transform: translateX(0px) rotate(0deg);
            }

            50% {
                transform: translateX(15px) rotate(-180deg);
            }
        }

        @keyframes float-element-4 {

            0%,
            100% {
                transform: translate(0px, 0px);
            }

            25% {
                transform: translate(10px, -15px);
            }

            50% {
                transform: translate(0px, -25px);
            }

            75% {
                transform: translate(-10px, -15px);
            }
        }

        /* Hover Effects */
        .scene-3d:hover {
            animation-duration: 10s;
        }

        .cube:hover {
            animation: cube-hover 2s ease-in-out;
        }

        @keyframes cube-hover {

            0%,
            100% {
                transform: rotateX(-15deg) rotateY(-15deg) scale(1);
            }

            50% {
                transform: rotateX(-20deg) rotateY(-20deg) scale(1.1);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .animation-3d-container {
                height: 300px;
            }

            .scene-3d {
                width: 150px;
                height: 150px;
            }

            .face {
                width: 150px;
                height: 150px;
                font-size: 1.2rem;
            }

            .face span {
                font-size: 0.7rem;
            }

            .face.front {
                transform: translateZ(75px);
            }

            .face.back {
                transform: rotateY(180deg) translateZ(75px);
            }

            .face.right {
                transform: rotateY(90deg) translateZ(75px);
            }

            .face.left {
                transform: rotateY(-90deg) translateZ(75px);
            }

            .face.top {
                transform: rotateX(90deg) translateZ(75px);
            }

            .face.bottom {
                transform: rotateX(-90deg) translateZ(75px);
            }

            .element {
                width: 45px;
                height: 45px;
                font-size: 1rem;
            }
        }

        /* CSS Chart Container - Diperkecil */
        .css-chart-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            height: 400px;
            max-height: 500px;
        }

        .chart-wrapper {
            position: relative;
            height: 300px;
            /* Diperkecil dari 300px */
            margin-bottom: 1rem;
        }

        .chart-area {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .chart-grid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .grid-line {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            opacity: 0;
            animation: fadeIn 0.5s ease-out forwards;
        }

        .grid-line:nth-child(1) {
            animation-delay: 0.2s;
        }

        .grid-line:nth-child(2) {
            animation-delay: 0.3s;
        }

        .grid-line:nth-child(3) {
            animation-delay: 0.4s;
        }

        .grid-line:nth-child(4) {
            animation-delay: 0.5s;
        }

        .grid-line:nth-child(5) {
            animation-delay: 0.6s;
        }

        .chart-line-animated {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            /* Diperkecil */
            background: rgba(255, 255, 255, 0.8);
            transform: scaleX(0);
            transform-origin: left;
            animation: drawLine 1.5s ease-out 0.8s forwards;
        }

        .chart-fill-animated {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top,
                    rgba(102, 126, 234, 0.4) 0%,
                    rgba(118, 75, 162, 0.1) 100%);
            clip-path: polygon(0% 100%, 0% 100%, 0% 100%, 0% 100%);
            animation: fillChart 2s ease-out 1s forwards;
        }

        .chart-points {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .point {
            position: absolute;
            width: 8px;
            /* Diperkecil */
            height: 8px;
            /* Diperkecil */
            background: white;
            border: 2px solid rgba(102, 126, 234, 1);
            border-radius: 50%;
            transform: translate(-50%, 50%) scale(0);
            opacity: 0;
            animation: popPoint 0.6s ease-out forwards;
            cursor: pointer;
        }

        .point::after {
            content: attr(data-value);
            position: absolute;
            top: -25px;
            /* Diperkecil */
            left: 50%;
            transform: translateX(-50%);
            background: rgba(255, 255, 255, 0.9);
            color: var(--primary);
            padding: 3px 6px;
            /* Diperkecil */
            border-radius: 6px;
            font-size: 0.6rem;
            /* Diperkecil */
            font-weight: 600;
            opacity: 0;
            transition: opacity 0.3s ease;
            white-space: nowrap;
        }

        .point:hover::after {
            opacity: 1;
        }

        /* Animation delays for points */
        .point:nth-child(1) {
            animation-delay: 1.2s;
        }

        .point:nth-child(2) {
            animation-delay: 1.3s;
        }

        .point:nth-child(3) {
            animation-delay: 1.4s;
        }

        .point:nth-child(4) {
            animation-delay: 1.5s;
        }

        .point:nth-child(5) {
            animation-delay: 1.6s;
        }

        .point:nth-child(6) {
            animation-delay: 1.7s;
        }

        .point:nth-child(7) {
            animation-delay: 1.8s;
        }

        .point:nth-child(8) {
            animation-delay: 1.9s;
        }

        .point:nth-child(9) {
            animation-delay: 2.0s;
        }

        .point:nth-child(10) {
            animation-delay: 2.1s;
        }

        .point:nth-child(11) {
            animation-delay: 2.2s;
        }

        .point:nth-child(12) {
            animation-delay: 2.3s;
        }

        .chart-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 0.5rem;
            /* Diperkecil */
        }

        .chart-labels span {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.7rem;
            /* Diperkecil */
            opacity: 0;
            transform: translateY(10px);
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .chart-labels span:nth-child(1) {
            animation-delay: 2.4s;
        }

        .chart-labels span:nth-child(2) {
            animation-delay: 2.5s;
        }

        .chart-labels span:nth-child(3) {
            animation-delay: 2.6s;
        }

        .chart-labels span:nth-child(4) {
            animation-delay: 2.7s;
        }

        .chart-labels span:nth-child(5) {
            animation-delay: 2.8s;
        }

        .chart-labels span:nth-child(6) {
            animation-delay: 2.9s;
        }

        .chart-labels span:nth-child(7) {
            animation-delay: 3.0s;
        }

        .chart-labels span:nth-child(8) {
            animation-delay: 3.1s;
        }

        .chart-labels span:nth-child(9) {
            animation-delay: 3.2s;
        }

        .chart-labels span:nth-child(10) {
            animation-delay: 3.3s;
        }

        .chart-labels span:nth-child(11) {
            animation-delay: 3.4s;
        }

        .chart-labels span:nth-child(12) {
            animation-delay: 3.5s;
        }

        /* Chart Indicators - Diperkecil */
        .chart-indicators {
            display: flex;
            justify-content: center;
            gap: 0.8rem;
            margin-top: 1rem;
        }

        .indicator {
            color: white;
            padding: 0.4rem 0.8rem;
            /* Diperkecil */
            border-radius: 15px;
            font-size: 0.7rem;
            /* Diperkecil */
            font-weight: 600;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            opacity: 0;
            transform: translateY(10px);
            animation: fadeInUp 0.5s ease-out 2s forwards;
        }

        .indicator.success {
            background: rgba(74, 222, 128, 0.3);
        }

        .indicator.primary {
            background: rgba(102, 126, 234, 0.3);
        }

        .indicator:nth-child(2) {
            animation-delay: 2.2s;
        }

        /* Animations */
        @keyframes drawLine {
            to {
                transform: scaleX(1);
            }
        }

        @keyframes fillChart {
            to {
                clip-path: polygon(0% 100%,
                        4% 69%,
                        12% 62.8%,
                        20% 57%,
                        28% 61.4%,
                        36% 54.2%,
                        44% 50%,
                        52% 42.9%,
                        60% 35.7%,
                        68% 28.6%,
                        76% 19%,
                        84% 11.9%,
                        92% 0%,
                        100% 100%);
            }
        }

        @keyframes popPoint {
            0% {
                transform: translate(-50%, 50%) scale(0);
                opacity: 0;
            }

            70% {
                transform: translate(-50%, 50%) scale(1.2);
                opacity: 1;
            }

            100% {
                transform: translate(-50%, 50%) scale(1);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .css-chart-container {
                margin-top: 2rem;
                max-height: none;
            }

            .chart-wrapper {
                height: 180px;
            }

            .chart-labels span {
                font-size: 0.65rem;
            }

            .indicator {
                font-size: 0.65rem;
                padding: 0.3rem 0.6rem;
            }
        }

        /* 3D Animation Container untuk Features */
        .animation-3d-container {
            position: relative;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1200px;
        }

        /* 3D Scene */
        .scene-3d {
            width: 180px;
            height: 180px;
            position: relative;
            transform-style: preserve-3d;
            animation: rotate-3d 20s infinite linear;
        }

        /* 3D Cube */
        .cube {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transform: rotateX(-15deg) rotateY(-15deg);
        }

        /* Cube Faces */
        .face {
            position: absolute;
            width: 180px;
            height: 180px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: 2px solid rgba(255, 255, 255, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            font-weight: 600;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.3);
            backdrop-filter: blur(10px);
        }

        .face span {
            font-size: 0.7rem;
            margin-top: 8px;
            font-weight: 500;
        }

        .face.front {
            transform: translateZ(90px);
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .face.back {
            transform: rotateY(180deg) translateZ(90px);
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }

        .face.right {
            transform: rotateY(90deg) translateZ(90px);
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .face.left {
            transform: rotateY(-90deg) translateZ(90px);
            background: linear-gradient(135deg, #43e97b, #38f9d7);
        }

        .face.top {
            transform: rotateX(90deg) translateZ(90px);
            background: linear-gradient(135deg, #fa709a, #fee140);
        }

        .face.bottom {
            transform: rotateX(-90deg) translateZ(90px);
            background: linear-gradient(135deg, #a8edea, #fed6e3);
        }

        /* 3D Rotation Animation */
        @keyframes rotate-3d {
            0% {
                transform: rotateY(0deg) rotateX(10deg);
            }

            25% {
                transform: rotateY(90deg) rotateX(15deg);
            }

            50% {
                transform: rotateY(180deg) rotateX(10deg);
            }

            75% {
                transform: rotateY(270deg) rotateX(15deg);
            }

            100% {
                transform: rotateY(360deg) rotateX(10deg);
            }
        }

        /* Floating Elements */
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .element {
            position: absolute;
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.1rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(102, 126, 234, 0.2);
        }

        /* Posisi elements untuk setiap section */

        /* Untuk Manajemen Produk */
        .animation-3d-container:nth-child(1) .element-1 {
            top: 10%;
            left: 10%;
            animation: float-element-1 6s ease-in-out infinite;
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
        }

        .animation-3d-container:nth-child(1) .element-2 {
            top: 20%;
            right: 15%;
            animation: float-element-2 7s ease-in-out infinite 1s;
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
        }

        .animation-3d-container:nth-child(1) .element-3 {
            bottom: 25%;
            left: 15%;
            animation: float-element-3 8s ease-in-out infinite 2s;
            background: linear-gradient(135deg, #d4fc79, #96e6a1);
        }

        .animation-3d-container:nth-child(1) .element-4 {
            bottom: 15%;
            right: 10%;
            animation: float-element-4 9s ease-in-out infinite 3s;
            background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
        }

        /* Untuk Pesanan */
        .animation-3d-container:nth-child(2) .element-1 {
            top: 15%;
            left: 15%;
            animation: float-element-2 7s ease-in-out infinite;
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
        }

        .animation-3d-container:nth-child(2) .element-2 {
            top: 25%;
            right: 10%;
            animation: float-element-3 8s ease-in-out infinite 1s;
            background: linear-gradient(135deg, #d4fc79, #96e6a1);
        }

        .animation-3d-container:nth-child(2) .element-3 {
            bottom: 20%;
            left: 10%;
            animation: float-element-4 9s ease-in-out infinite 2s;
            background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
        }

        .animation-3d-container:nth-child(2) .element-4 {
            bottom: 10%;
            right: 15%;
            animation: float-element-1 6s ease-in-out infinite 3s;
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
        }

        /* Untuk Pembayaran */
        .animation-3d-container:nth-child(3) .element-1 {
            top: 12%;
            left: 12%;
            animation: float-element-3 8s ease-in-out infinite;
            background: linear-gradient(135deg, #d4fc79, #96e6a1);
        }

        .animation-3d-container:nth-child(3) .element-2 {
            top: 22%;
            right: 12%;
            animation: float-element-4 9s ease-in-out infinite 1s;
            background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
        }

        .animation-3d-container:nth-child(3) .element-3 {
            bottom: 22%;
            left: 12%;
            animation: float-element-1 6s ease-in-out infinite 2s;
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
        }

        .animation-3d-container:nth-child(3) .element-4 {
            bottom: 12%;
            right: 12%;
            animation: float-element-2 7s ease-in-out infinite 3s;
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
        }

        /* Floating Animations */
        @keyframes float-element-1 {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @keyframes float-element-2 {

            0%,
            100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(-25px) scale(1.1);
            }
        }

        @keyframes float-element-3 {

            0%,
            100% {
                transform: translateX(0px) rotate(0deg);
            }

            50% {
                transform: translateX(15px) rotate(-180deg);
            }
        }

        @keyframes float-element-4 {

            0%,
            100% {
                transform: translate(0px, 0px);
            }

            25% {
                transform: translate(10px, -15px);
            }

            50% {
                transform: translate(0px, -25px);
            }

            75% {
                transform: translate(-10px, -15px);
            }
        }

        /* Hover Effects */
        .scene-3d:hover {
            animation-duration: 10s;
        }

        .cube:hover {
            animation: cube-hover 2s ease-in-out;
        }

        @keyframes cube-hover {

            0%,
            100% {
                transform: rotateX(-15deg) rotateY(-15deg) scale(1);
            }

            50% {
                transform: rotateX(-20deg) rotateY(-20deg) scale(1.1);
            }
        }

        /* Background effect */
        .animation-3d-container::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            animation: pulse 3s ease-in-out infinite alternate;
        }

        @keyframes pulse {
            0% {
                opacity: 0.3;
                transform: translate(-50%, -50%) scale(0.8);
            }

            100% {
                opacity: 0.6;
                transform: translate(-50%, -50%) scale(1.1);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .animation-3d-container {
                height: 250px;
                margin-bottom: 2rem;
            }

            .scene-3d {
                width: 140px;
                height: 140px;
            }

            .face {
                width: 140px;
                height: 140px;
                font-size: 1.1rem;
            }

            .face span {
                font-size: 0.6rem;
            }

            .face.front {
                transform: translateZ(70px);
            }

            .face.back {
                transform: rotateY(180deg) translateZ(70px);
            }

            .face.right {
                transform: rotateY(90deg) translateZ(70px);
            }

            .face.left {
                transform: rotateY(-90deg) translateZ(70px);
            }

            .face.top {
                transform: rotateX(90deg) translateZ(70px);
            }

            .face.bottom {
                transform: rotateX(-90deg) translateZ(70px);
            }

            .element {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }

        /* Pricing Section Specific Styles */
        .pricing-section .btn-pricing-toggle {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .pricing-section .btn-pricing-toggle:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .pricing-section .btn-check:checked+.btn-pricing-toggle {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .pricing-section .btn-pricing-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .pricing-section .btn-pricing-outline:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Pricing Toggle Container khusus untuk pricing */
        .pricing-section .pricing-toggle-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 0.5rem;
            display: inline-block;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .pricing-section .pricing-toggle-container .btn-group {
            border-radius: 12px;
        }

        /* Pricing Cards khusus untuk pricing section */
        .pricing-section .pricing-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .pricing-section .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .pricing-section .pricing-card.featured {
            border: 2px solid var(--primary);
            transform: scale(1.05);
        }

        .pricing-section .pricing-card.featured:hover {
            transform: scale(1.05) translateY(-10px);
        }

        /* Popular Badge */
        .pricing-section .popular-badge {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            z-index: 2;
        }

        /* Pricing Header */
        .pricing-section .pricing-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .pricing-section .pricing-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .pricing-section .pricing-icon.free {
            background: linear-gradient(135deg, #4ade80, #22c55e);
            color: white;
        }

        .pricing-section .pricing-icon.pro {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .pricing-section .pricing-icon.business {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .pricing-section .pricing-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .pricing-section .pricing-subtitle {
            color: #64748b;
            font-size: 0.9rem;
        }

        /* Pricing Price */
        .pricing-section .pricing-price {
            text-align: center;
            margin-bottom: 2rem;
            padding: 1.5rem 0;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-radius: 15px;
            position: relative;
            overflow: hidden;
        }

        .pricing-section .pricing-price::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .pricing-section .price-amount {
            font-size: 3rem;
            font-weight: 800;
            color: var(--dark);
            display: block;
            line-height: 1;
        }

        .pricing-section .price-period {
            color: #64748b;
            font-size: 1rem;
            font-weight: 500;
        }

        .pricing-section .price-save {
            margin-top: 0.5rem;
        }

        /* Pricing Features */
        .pricing-section .pricing-features {
            flex: 1;
            margin-bottom: 2rem;
        }

        .pricing-section .feature-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .pricing-section .feature-item:last-child {
            border-bottom: none;
        }

        .pricing-section .feature-check {
            color: #22c55e;
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        .pricing-section .feature-times {
            color: #94a3b8;
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        .pricing-section .feature-item span {
            color: #475569;
            font-weight: 500;
        }

        .pricing-section .feature-item.disabled span {
            color: #94a3b8;
            text-decoration: line-through;
        }

        /* Pricing CTA */
        .pricing-section .pricing-cta {
            margin-top: auto;
        }

        .pricing-section .pricing-cta .btn {
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .pricing-section .pricing-cta .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* FAQ Section */
        .pricing-section .faq-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 3rem;
        }

        .pricing-section .accordion-item {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .pricing-section .accordion-button {
            background: white;
            color: var(--dark);
            font-weight: 600;
            padding: 1.25rem;
            border: none;
            box-shadow: none;
        }

        .pricing-section .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            color: var(--primary);
        }

        .pricing-section .accordion-body {
            background: #f8fafc;
            color: #475569;
            padding: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        /* Responsive untuk pricing section */
        @media (max-width: 768px) {
            .pricing-section .pricing-card.featured {
                transform: none;
            }

            .pricing-section .pricing-card.featured:hover {
                transform: translateY(-10px);
            }

            .pricing-section .price-amount {
                font-size: 2.5rem;
            }

            .pricing-section .faq-section {
                padding: 2rem;
            }

            .pricing-section .pricing-toggle-container .btn {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .pricing-section .btn-pricing-toggle,
            .pricing-section .btn-pricing-outline {
                padding: 0.8rem 1.2rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <i class="fas fa-store me-2"></i>TokoOnline
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('landing') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('features') }}">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pricing') }}">Harga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('landing') }}#about">Tentang</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="{{ route('login') }}" class="btn btn-login">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-brand">TokoOnline</div>
                    <p class="text-white">Solusi lengkap untuk toko online UMKM. Kelola penjualan, inventori, dan
                        pelanggan dengan mudah.</p>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h5 class="text-white mb-3">Perusahaan</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('landing') }}#about">Tentang Kami</a></li>
                        <li><a href="{{ route('landing') }}#features">Fitur</a></li>
                        <li><a href="{{ route('pricing') }}">Harga</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h5 class="text-white mb-3">Dukungan</h5>
                    <ul class="footer-links">
                        <li><a href="#">Bantuan</a></li>
                        <li><a href="#">Kontak</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h5 class="text-white mb-3">Legal</h5>
                    <ul class="footer-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center pt-4 mt-4 border-top border-secondary">
                <p class="text-white mb-0">&copy; 2025 TokoOnline. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Chart Animation for Hero Section
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('heroChart').getContext('2d');

            // Create gradient
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(102, 126, 234, 0.6)');
            gradient.addColorStop(1, 'rgba(118, 75, 162, 0.2)');

            const heroChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                        'Des'
                    ],
                    datasets: [{
                        label: 'Pertumbuhan Penjualan',
                        data: [65, 78, 90, 81, 96, 105, 120, 135, 150, 170, 185, 210],
                        backgroundColor: gradient,
                        borderColor: 'rgba(255, 255, 255, 0.8)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'white',
                        pointBorderColor: 'rgba(102, 126, 234, 1)',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#1e293b',
                            bodyColor: '#1e293b',
                            borderColor: 'rgba(102, 126, 234, 0.5)',
                            borderWidth: 1,
                            cornerRadius: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return `Penjualan: ${context.parsed.y}%`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.8)'
                            }
                        },
                        y: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            ticks: {
                                color: 'rgba(255, 255, 255, 0.8)',
                                callback: function(value) {
                                    return value + '%';
                                }
                            },
                            suggestedMin: 50,
                            suggestedMax: 220
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart'
                    }
                }
            });

            // Animate chart on scroll into view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        heroChart.update();
                    }
                });
            });

            const chartElement = document.getElementById('heroChart');
            if (chartElement) {
                observer.observe(chartElement);
            }
        });

        // Pricing Toggle Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const monthlyRadio = document.getElementById('monthly');
            const yearlyRadio = document.getElementById('yearly');
            const monthlyPrices = document.querySelectorAll('.monthly-price');
            const yearlyPrices = document.querySelectorAll('.yearly-price');
            const priceSaves = document.querySelectorAll('.price-save');
            const pricePeriods = document.querySelectorAll('.price-period');

            function updatePricingDisplay(isYearly) {
                monthlyPrices.forEach(price => {
                    price.classList.toggle('d-none', isYearly);
                });
                yearlyPrices.forEach(price => {
                    price.classList.toggle('d-none', !isYearly);
                });
                priceSaves.forEach(save => {
                    save.classList.toggle('d-none', !isYearly);
                });
                pricePeriods.forEach(period => {
                    period.textContent = isYearly ? '/tahun' : '/bulan';
                });
            }

            monthlyRadio.addEventListener('change', function() {
                if (this.checked) {
                    updatePricingDisplay(false);
                }
            });

            yearlyRadio.addEventListener('change', function() {
                if (this.checked) {
                    updatePricingDisplay(true);
                }
            });

            // Initialize
            updatePricingDisplay(false);
        });
    </script>

    @yield('scripts')
</body>

</html>
