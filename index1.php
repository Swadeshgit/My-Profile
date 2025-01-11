<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio12";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contact_form'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Message sent successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// Fetch services
$services = $conn->query("SELECT * FROM services");

// Fetch projects
$projects = $conn->query("SELECT * FROM projects");

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">


    <title>My Portfolio</title>
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
        }
        header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        nav {
            background: #34495e;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            text-transform: uppercase;
        }
        .content {
            padding: 50px 10%;
        }
        section {
            margin-bottom: 40px;
        }
        .services, .projects {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .contact-form button {
            background: #2c3e50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        footer {
            background: #2c3e50;
            color: white;
            padding: 10px;
            text-align: center;
        }
        /* Animations */
        section {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
    </style> -->

    <style>/* About Section */
/* Font Styling */
.unique-heading {
    font-family: 'Playfair Display', serif; /* Elegant serif font */
    font-size: 3em;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    background: linear-gradient(45deg, #ff6f61, #6a89cc, #f3a683, #60a3bc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 3px;
    animation: gradientShift 6s infinite;
    text-shadow: 2px 4px 5px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
}

.paragraph-text {
    font-family: 'Roboto', sans-serif; /* Modern sans-serif font */
    font-size: 1.2em;
    line-height: 1.8;
    color: #444; /* Neutral color for readability */
    text-align: justify;
    margin: 10px 0;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    letter-spacing: 0.05em;
    background: linear-gradient(90deg, rgba(255, 255, 255, 0.7), rgba(245, 245, 245, 0.2));
    padding: 10px 20px;
    border-left: 5px solid #6a89cc; /* Add a left border for emphasis */
    border-radius: 8px;
    position: relative;
    overflow: hidden;
    animation: fadeIn 1.5s ease-in-out;
}

/* Line Highlight Effect */
.paragraph-text:before {
    content: '';
    position: absolute;
    top: 50%;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.3);
    transform: skewX(-45deg);
    animation: slideHighlight 4s infinite;
}

/* Gradient Highlight Animation */
@keyframes slideHighlight {
    0% {
        left: -100%;
    }
    50% {
        left: 150%;
    }
    100% {
        left: -100%;
    }
}

/* Hover Effect for Paragraph */
.paragraph-text:hover {
    color: #2c3e50; /* Darker color for hover effect */
    background: linear-gradient(90deg, rgba(240, 240, 255, 0.9), rgba(220, 230, 255, 0.4));
    border-left-color: #ff6f61;
    transition: background 0.4s, color 0.4s, border-left-color 0.4s;
}

/* Enhanced Fade-In Animation */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}


/* Hover Effect */
.unique-heading:hover {
    transform: scale(1.1);
    text-shadow: 4px 6px 10px rgba(0, 0, 0, 0.3);
    transition: transform 0.4s ease, text-shadow 0.4s ease;
}

/* Gradient Animation */
@keyframes gradientShift {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

/* Fade-In Animation */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

    /* //// */
.about {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 40px;
    background: linear-gradient(135deg, #ff9a9e, #fad0c4);
    padding: 60px 20px;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
    animation: backgroundShift 6s infinite alternate;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.about::before {
    content: '';
    position: absolute;
    top: -50px;
    left: -50px;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    animation: floatingGlow 8s infinite ease-in-out;
}

.about::after {
    content: '';
    position: absolute;
    bottom: -50px;
    right: -50px;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    animation: floatingGlow 10s infinite ease-in-out reverse;
}

.about img {
    width: 680px;
    height: 680px;
    border-radius: 50%;
    /* border: 5px solid white;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); */
    
}

.about-text {
    flex: 1;
    max-width: 500px;
    text-align: center;
    color: #2c3e50;
    animation: fadeInUp 1.5s ease-out;
}

.about-text h2 {
    font-family: 'Poppins', sans-serif;
    font-size: 2.5em;
    font-weight: 700;
    color: #34495e;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 15px;
    animation: textColorCycle 3s infinite alternate;
}

.about-text p {
    font-family: 'Open Sans', sans-serif;
    font-size: 1.1em;
    line-height: 1.8;
    color: #555;
    text-align: justify;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

/* Animations */
@keyframes rotateImage {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes textColorCycle {
    0% {
        color: #2c3e50;
    }
    50% {
        color: #16a085;
    }
    100% {
        color: #e74c3c;
    }
}

@keyframes floatingGlow {
    0%, 100% {
        transform: translate(0, 0);
    }
    50% {
        transform: translate(20px, 20px);
    }
}

@keyframes backgroundShift {
    0% {
        background: linear-gradient(135deg, #ff9a9e, #fad0c4);
    }
    50% {
        background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
    }
    100% {
        background: linear-gradient(135deg, #d4fc79, #96e6a1);
    }
}
</style>
<style>/* About Section */
.about {
    display: flex;
    align-items: center;
    justify-content: space-around;
    gap: 30px;
    background: linear-gradient(90deg, #f7cac9, #92a8d1);
    padding: 50px 10%;
    border-radius: 15px;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    animation: fadeIn 1.5s ease-in;
}

.about-text {
    flex: 1;
    padding: 20px;
    color: #2c3e50;
    font-size: 1.2em;
    text-align: left;
    animation: slideInLeft 1s ease-out;
}

.about-text h2 {
    font-size: 2em;
    margin-bottom: 15px;
    color: #34495e;
    text-transform: uppercase;
    animation: textColorChange 3s infinite alternate;
}

.about-text p {
    line-height: 1.6;
    color: #555;
}

/* Services Section */
.services {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    background: linear-gradient(90deg, #b3ffab, #12fff7);
    padding: 50px 10%;
    border-radius: 15px;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    animation: fadeIn 1.5s ease-in;
}

.service-card {
    background: white;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    animation: zoomIn 1.2s ease-out;
    position: relative;
    overflow: hidden;
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
}

.service-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 100%;
    background: rgba(52, 152, 219, 0.3);
    z-index: 0;
    transition: width 0.5s;
}

.service-card:hover::before {
    width: 100%;
}

.service-card h3 {
    font-size: 1.5em;
    margin-bottom: 10px;
    color: #2c3e50;
    position: relative;
    z-index: 1;
    animation: bounce 2s infinite ease-in-out;
}

.service-card p {
    font-size: 1em;
    line-height: 1.6;
    color: #555;
    position: relative;
    z-index: 1;
}

/* Animations */
@keyframes slideInLeft {
    0% {
        opacity: 0;
        transform: translateX(-50px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes rotateImage {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

@keyframes textColorChange {
    0% {
        color: #2c3e50;
    }
    50% {
        color: #2980b9;
    }
    100% {
        color: #e74c3c;
    }
}

@keyframes zoomIn {
    0% {
        opacity: 0;
        transform: scale(0.8);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}
</style>
    <style>body {
    font-family: 'Poppins', sans-serif; /* Modern and professional font */
    margin: 0;
    padding: 0;
    color: #2c3e50; /* Default font color */
    background: linear-gradient(90deg, #FFDEE9, #B5FFFC);
    background-size: 300% 300%;
    animation: backgroundChange 10s infinite;
}

/* Header Section */

@keyframes colorShift {
    0% {
        background: linear-gradient(90deg, #8e44ad, #3498db);
    }
    100% {
        background: linear-gradient(90deg, #3498db, #8e44ad);
    }
}

@keyframes textGradientShift {
    0% {
        background: linear-gradient(45deg, #f1c40f, #e74c3c);
    }
    100% {
        background: linear-gradient(45deg, #e74c3c, #f1c40f);
    }
}

/* Navigation */
nav {
    background: rgba(52, 73, 94, 0.8);
    padding: 10px;
    text-align: center;
}

nav a {
    color: #f1c40f;
    margin: 0 15px;
    text-decoration: none;
    text-transform: uppercase;
    font-weight: bold;
    position: relative;
    transition: color 0.3s, transform 0.2s;
}

nav a:hover {
    color: #16a085;
    transform: scale(1.1);
}

/* Content Section */
.content {
    padding: 50px 10%;
    animation: fadeIn 1.5s ease-in;
}

/* Services and Projects */
.services, .projects {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s, box-shadow 0.3s;
    position: relative;
    overflow: hidden;
    animation: cardPop 1s ease-out;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.card h3 {
    font-size: 1.5em;
    margin-bottom: 15px;
    color: #2980b9;
    text-align: center;
}

/* Contact Form */
.contact-form input, .contact-form textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s;
}

.contact-form input:focus, .contact-form textarea:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
}

.contact-form button {
    background: linear-gradient(45deg, #e67e22, #e74c3c);
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    transition: background 0.3s, transform 0.2s;
}

.contact-form button:hover {
    background: linear-gradient(45deg, #e74c3c, #c0392b);
    transform: scale(1.1);
}

/* Footer */
footer {
    background: #2c3e50;
    color: white;
    padding: 15px;
    text-align: center;
    animation: colorShift 8s infinite alternate;
}

/* Animations */
@keyframes backgroundChange {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes colorShift {
    0% { background: #2c3e50; }
    50% { background: #34495e; }
    100% { background: #2c3e50; }
}

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(30px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes textGradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes cardPop {
    0% { transform: scale(0.8); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}
</style>


    <Style>
      /* General Styling for Projects Section */
.project-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
    animation: background-color-change 9s infinite; /* Background animation */
}

@keyframes background-color-change {
    0% {
        background: linear-gradient(45deg, #4caf50, #81c784);
    }
    33% {
        background: linear-gradient(45deg, #81d4fa, #29b6f6);
    }
    66% {
        background: linear-gradient(45deg, #f48fb1, #f06292);
    }
    100% {
        background: linear-gradient(45deg, #4caf50, #81c784);
    }
}

.project-item {
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    text-align: center;
    padding: 20px;
    background: #fff;
    animation: fade-in 1s ease-in-out;
}

@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.project-item:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
}

/* Icon/Shape for Projects */
.project-item .project-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, #4caf50, #81c784);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    color: #fff;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

/* Animated Project Titles */
.project-item h3 {
    font-size: 1.5rem;
    margin: 10px 0;
    background: linear-gradient(90deg, #4caf50, #29b6f6, #f48fb1, #f06292);
    background-size: 400% 100%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: text-gradient 3s linear infinite;
}

@keyframes text-gradient {
    0% {
        background-position: 0% 50%;
    }
    100% {
        background-position: 100% 50%;
    }
}

/* Animated Descriptions */
.project-item p {
    padding: 0 10px;
    font-size: 1rem;
    color: #666;
    animation: text-fade 3s ease-in-out infinite;
}

@keyframes text-fade {
    0%, 100% {
        color: #666;
    }
    50% {
        color: #333;
    }
}

/* Call-to-Action Button */
.project-item a {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;
    background: linear-gradient(45deg, #4caf50, #81c784);
    color: #fff;
    text-decoration: none;
    text-align: center;
    border-radius: 5px;
    transition: background 0.3s;
    animation: button-bounce 3s infinite;
}

@keyframes button-bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
    }
}

.project-item a:hover {
    background: linear-gradient(45deg, #81d4fa, #29b6f6);
}

    </style>

    <style>
    .project-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
}

.project-item {
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    text-align: center;
    padding: 20px;
}

.project-item:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
}

/* Icon/Shape for Projects */
.project-item .project-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 20px;
    background: linear-gradient(135deg, #4caf50, #81c784);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    font-size: 40px;
    color: #fff;
    animation: pulse 2s infinite;
}

/* Add icons inside the shapes (Font Awesome icons example) */
.project-item .project-icon i {
    font-size: 50px;
    color: #fff;
}

/* Project Titles */
.project-item h3 {
    font-size: 1.5rem;
    margin: 10px 0;
    color: #333;
}

.project-item p {
    padding: 0 10px;
    font-size: 1rem;
    color: #666;
}

.project-item a {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 15px;
    background: #4caf50;
    color: #fff;
    text-decoration: none;
    text-align: center;
    border-radius: 5px;
    transition: background 0.3s;
}

.project-item a:hover {
    background: #45a049;
}

/* Add a simple animation */
@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}
</style>
<style>    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
        }

        .content-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin: 20px 0;
            padding: 10px;
        }

        .paragraph-text {
            flex: 1;
            font-family: 'Roboto', sans-serif;
            font-size: 1.2em;
            line-height: 1.8;
            color: #444;
            text-align: justify;
            margin: 0;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            letter-spacing: 0.05em;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.7), rgba(245, 245, 245, 0.2));
            padding: 10px 20px;
            border-left: 5px solid #6a89cc;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
          
        }

        /* Image Styling */
        .image-container {
            flex: 0.5;
            text-align: center;
            position: relative;
        }

        .image-container img {
            width: 100%;
            max-width: 650px;
            height: auto;
            /* border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); */
        
        }

        /* Optional Responsive Design */
        @media (max-width: 768px) {
            .content-wrapper {
                flex-direction: column;
                align-items: center;
            }
            .image-container {
                margin-top: 20px;
            }
        }
    </style>
    </style>
            <style>/* Global Reset */
/* Styling for the header */
header {
    background: linear-gradient(90deg, #8e44ad, #3498db);
    color: white;
    padding: 10px 20px; /* Reduced padding for a smaller height */
    text-align: center;
    position: sticky;
    top: 0;
    z-index: 100;
    animation: colorShift 6s infinite alternate; /* Gradient color animation */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Light shadow for depth */
    border-bottom: 2px solid #fff; /* Subtle border effect */
    transition: all 0.3s ease-in-out; /* Smooth transition for hover effects */
}

header:hover {
    background: linear-gradient(90deg, #3498db, #8e44ad); /* Reverse gradient on hover */
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
}

/* Styling for the header text */


/* Keyframes for header gradient animation */
@keyframes colorShift {
    0% {
        background: linear-gradient(90deg, #8e44ad, #3498db);
    }
    100% {
        background: linear-gradient(90deg, #3498db, #8e44ad);
    }
}

/* Keyframes for text gradient animation */
@keyframes textGradientShift {
    0% {
        background: linear-gradient(45deg, #f1c40f, #e74c3c);
    }
    100% {
        background: linear-gradient(45deg, #e74c3c, #f1c40f);
    }
}


</style>  

<style>
  /* General Styling */
.body1 {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  background: linear-gradient(135deg, #4facfe, #00f2fe);
  color: #fff;
  animation: gradientBackground 10s ease infinite;
}

/* Background Animation */
@keyframes gradientBackground {
  0% { background: linear-gradient(135deg, #4facfe, #00f2fe); }
  50% { background: linear-gradient(135deg, #ff9a9e, #fad0c4); }
  100% { background: linear-gradient(135deg, #4facfe, #00f2fe); }
}

.container1 {
  max-width: 1200px;
  margin: 20px auto;
  padding: 20px;
  background: rgba(0, 0, 0, 0.5);
  border-radius: 12px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
}

.project1 {
  border-bottom: 1px solid rgba(255, 255, 255, 0.2);
  padding: 20px 0;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.project1:last-child {
  border-bottom: none;
}

.project1:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 25px rgba(0, 0, 0, 0.5);
}

.project1 h2 {
  margin: 0 0 10px;
  color: #ffdd59;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.project1 p {
  margin: 5px 0;
  color: #f8f8f8;
}

.project1 ul {
  margin: 10px 0;
  padding-left: 20px;
  list-style: square;
}

.project1ul li {
  color: #ffeaa7;
}

.btn1 {
  display: inline-block;
  margin-top: 10px;
  padding: 12px 24px;
  color: #000;
  background: #ffeaa7;
  text-decoration: none;
  border-radius: 30px;
  font-weight: bold;
  text-transform: uppercase;
  transition: all 0.3s ease;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

.btn1:hover {
  background: #ff9f43;
  transform: scale(1.1);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
}

/* Add Animations to Text */
.project1 h2, .project1 p, .project1 ul {
  animation: fadeIn 1s ease;
}

@keyframes fadeIn {
  0% { opacity: 0; transform: translateY(20px); }
  100% { opacity: 1; transform: translateY(0); }
}

/* Responsive Styling */
@media (max-width: 768px) {
  .container1 {
    padding: 15px;
  }
  .btn1 {
    padding: 10px 20px;
    font-size: 14px;
  }
}
.zz{
      display: flex;
      width:100%;
      /* align-items:center; */
}
.zz1{
      padding:4%;
      width:30%;
      overflow-y: scroll;
      height: 300px;
}
.yy{
      display: flex;
      width:100%;
      /* align-items:center; */
}
.yy1{
      padding:4%;
      width:80%;
}
.yy2{
      padding:4%;
      width:20%;
}

.paragraph-text1 {
            flex: 1;
            font-family: 'Roboto', sans-serif;
            font-size: 1em;
            line-height: 1.8;
            color: #444;
            text-align: justify;
            margin: 0;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            letter-spacing: 0.05em;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.7), rgba(245, 245, 245, 0.2));
            padding: 10px 20px;
            border-left: 5px solid #6a89cc;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
          
        }
  </style>




            </head>
<body>

<header>

    <nav>
    <a href="#about">About Me</a>
    <a href="#services">Skills & Education</a>
    <a href="#projects">Projects</a>
    <a href="#contact">Contact</a>
</nav>
</header>

  

<div class="content">

    <!-- About Me Section -->
    <section id="about" class='about'>
      
    <div class="content-wrapper">
        <div class="paragraph-text">
        <h1 class="unique-heading">Swadesh Kumar Mourya</h1>
            <p>
            "I am a passionate Full Stack Developer skilled in the MERN stack (MongoDB, Express.js, React.js, Node.js) along with HTML, CSS, JavaScript, PHP, and MySQL. I have built projects like a real-time chat application and an e-commerce website, showcasing my expertise in frontend, backend, and API integration.

I am eager to contribute to innovative projects, grow as a developer, and solve real-world problems with modern technologies."
            </p>
        </div>
        <div class="image-container">
            <img src="./swad123.png" alt="Developer Image">
        </div>
    </div>
</div>

    </section>

    <!-- Services Section -->
    <section id="services" ><br><br>
        <h2 class="unique-heading">Services</h2>
        <div class="services"  class='about'>
            <?php while ($service = $services->fetch_assoc()): ?>
                <div class="card">
                    <h3><?php echo $service['name']; ?></h3>
                    <p><?php echo $service['description']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
<!-- /// data insert sql -->
<!-- INSERT INTO services (name, description)
VALUES 
('Web Development', 'Building responsive and dynamic websites.'),
('UI/UX Design', 'Creating user-friendly and appealing designs.'),
('SEO Optimization', 'Improving website visibility on search engines.'); -->
<!-- /// data insert sql -->

    <!-- Projects Section -->
    <!-- <section id="projects">
        <h2>Projects</h2>
        <div class="projects">
            <?php while ($project = $projects->fetch_assoc()): ?>
                <div class="card">
                    <h3><?php echo $project['name']; ?></h3>
                    <img src="uploads/<?php echo $project['image']; ?>" alt="<?php echo $project['name']; ?>" style="width: 100%; border-radius: 5px;">
                    <p><?php echo $project['description']; ?></p>
                    <a href="<?php echo $project['link']; ?>" target="_blank">View Project</a>
                </div>
            <?php endwhile; ?>
        </div>
    </section> -->

    <section id="projects">
      <br><br>
    <h2 class="unique-heading">My Projects</h2>
    <div class="container1">
    <!-- Service Provider Website -->
    <div class="project1">
      <div class="yy"> 
        <div class="yy1">      <h2>ServiceSphere – Your Solutions, Our Expertise</h2>
        </div>
        <div class="yy2">
            <h2>Project -> 1</h2>
        <a href="https://your-service-link.com" target="_blank" class="btn1">Live Demo</a></div>
      </div>
      <div class='zz' > <div class='zz1'>
    
        <h2>Description</h2>
      <p > ServiceSphere is a platform where businesses and professionals can list their services, and users can easily search, compare, and book the required services. The website is designed to bridge the gap between service providers and customers through a user-friendly interface and streamlined booking processes.

</p></div>
      <div  class='zz1'> 
      <h2>Technologies</h2>
      <ul class="paragraph-text1">
      <li> Frontend: React.js, Redux, Bootstrap/Tailwind CSS.</li>
<li>Backend: Node.js, Express.js.</li>
<li>Database: MongoDB (Mongoose for schema design).</li>
<li>Authentication: JSON Web Tokens (JWT).</li>
<li>Payment Gateway (Optional): Stripe/PayPal integration for secure payments.</li>
<li>Tools: Postman, Git, GitHub.</li>
      
         </ul>
       </div>
         <div  class='zz1'> 
          <h2>Features</h2>
          <ul class="paragraph-text1">
            <li>User authentication (Signup/Login) using JWT.</li>
            <li>Service listing and categorization (e.g., cleaning, plumbing, beauty services).</li>
            <li>Advanced search and filtering by service type, location, and price range.</li>
            <li>Booking system with real-time availability.</li>
            <li>Admin dashboard for managing services and user data.</li>
            <li>Reviews and ratings for services.</li>
            <li>Mobile-friendly and responsive design.</li>
           </ul>
         </div>
       </div>
    </div>
  <!-- Blogging Website – TechTales -->
  <div class="project1">
      <div class="yy"> 
        <div class="yy1">      <h2>Blogging Website – TechTales</h2>
        </div>
        <div class="yy2">
            <h2>Project -> 2</h2>
        <a href="https://your-service-link.com" target="_blank" class="btn1">Live Demo</a></div>
      </div>
      <div class='zz' > <div class='zz1'>
    
        <h2>Description</h2>
      <p >A responsive and SEO-optimized WordPress blogging website designed for tech enthusiasts to share tutorials, product reviews, and industry updates.
      </p>
   </div>
      <div  class='zz1'> 
      <h2>Technologies</h2>
      <ul class="paragraph-text1">

      <li> CMS: WordPress</li>
<li>Languages: PHP, HTML, CSS</li>
<li>Plugins: Mention key plugins used (e.g., Yoast SEO, Elementor, Akismet Anti-Spam, etc.)</li>
<li>Themes: State whether you used a custom theme or a pre-built one and any customizations you made.</li>
      
         </ul>
       </div>
         <div  class='zz1'> 
          <h2>Features</h2>
          <ul class="paragraph-text1">
            <li> Responsive Design: Mobile-friendly layout for better user experience.</li>
            <li>Dynamic Content Management: Ability to add, edit, and manage blog posts easily.
            </li>
            <li>SEO Optimization: Built-in tools/plugins (like Yoast SEO) for improving search engine rankings.</li>
            <li>
            Comments Section: Interactive space for readers to share feedback.</li>
            <li>Admin dashboard for managing services and user data.</li>
            <li>Social Media Integration: Easy sharing options for blog posts.</li>
            <li>Newsletter Signup: Email subscription to grow the audience.</li>
           </ul>
         </div>
       </div>
    </div>

    <!-- Todo Project – TaskTracker -->
  <div class="project1">
      <div class="yy"> 
        <div class="yy1">      <h2>Todo Project – TaskTracker</h2>
        </div>
        <div class="yy2">
            <h2>Project -> 3</h2>
        <a href="https://your-service-link.com" target="_blank" class="btn1">Live Demo</a></div>
      </div>
      <div class='zz' > <div class='zz1'>
    
        <h2>Description</h2>
      <p >A simple and efficient task management system to help users organize their daily activities. The application allows users to add, edit, mark as completed, and delete tasks with an intuitive interface.
      </p>
   </div>
      <div  class='zz1'> 
      <h2>Technologies</h2>
      <p> PHP, HTML, CSS, MySQL.</p>
      <h2>Challenges:</h2>
<p> Ensured smooth database connectivity and implemented secure user authentication to protect user data.</p>
       </div>
         <div  class='zz1'> 
          <h2>Features</h2>
          <ul class="paragraph-text1">
            <li>Dynamic task management with real-time updates.</li>
            <li>Task filtering by status (Pending/Completed). </li>
            <li>Secure user authentication and session management.</li>
            <li>Fully responsive design for mobile and desktop.</li>
           </ul>
         </div>
       </div>
    </div>
</section>
<!-- ///sql  -->
<!-- INSERT INTO projects (name, description, image, link)
VALUES 
('E-commerce Website', 'An online shopping platform with cart functionality.', 'ecommerce.jpg', 'https://example.com/ecommerce'),
('Portfolio Website', 'My personal portfolio showcasing my work.', 'portfolio.jpg', 'https://example.com/portfolio'); -->
<!-- ///sql  -->

    <!-- Contact Section -->
    <section id="contact"  class='about'>
        <h2 class="unique-heading">Contact Me</h2>
        <?php if (isset($success_message)): ?>
            <p style="color: green;"><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" class="contact-form">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit" name="contact_form">Send Message</button>
        </form>
    </section>

</div>

<footer>
    <p>&copy; 2025 This is Portfolio Created by : Swadesh Kumar Mourya .</p>
</footer>

</body>
</html>
