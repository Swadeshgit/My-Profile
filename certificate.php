<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Certificates</title>
  <link rel="stylesheet" href="styles.css">
</head>
<style>/* General Styles */
body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background: linear-gradient(135deg, #1e3c72, #2a5298);
  color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

/* Section Styling */
.certificate-section {
  text-align: center;
  padding: 20px;
}

.certificate-section h1 {
  margin-bottom: 20px;
  font-size: 2.5rem;
  letter-spacing: 2px;
}

/* Certificate Gallery */
.certificate-gallery {
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}

.certificate {
  position: relative;
  width: 300px;
  height: 200px;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
  transition: transform 0.3s, box-shadow 0.3s;
}

.certificate:hover {
  transform: scale(1.05);
  box-shadow: 0 12px 25px rgba(0, 0, 0, 0.4);
}

/* Certificate Image */
.certificate img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Overlay Effect */
.certificate-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  color: #fff;
  opacity: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  padding: 15px;
  transition: opacity 0.3s;
}

.certificate-overlay h2 {
  margin: 10px 0 5px;
  font-size: 1.2rem;
  letter-spacing: 1px;
}

.certificate-overlay p {
  font-size: 1rem;
  opacity: 0.8;
}

/* Hover Effect for Overlay */
.certificate:hover .certificate-overlay {
  opacity: 1;
}

/* Responsive Design */
@media (max-width: 768px) {
  .certificate {
    width: 90%;
    height: auto;
  }
}

@media (max-width: 480px) {
  .certificate-section h1 {
    font-size: 2rem;
  }
}
</style>
<body>
  <section class="certificate-section">
    <h1>My Certificates</h1>
    <div class="certificate-gallery">
      <div class="certificate">
        <img src="./aaa.jpg" alt="Certificate 1">
        <div class="certificate-overlay">
          <h2>Certificate of Completion</h2>
          <p>Issued by XYZ Platform</p>
        </div>
      </div>
      <div class="certificate">
        <img src="certificate2.jpg" alt="Certificate 2">
        <div class="certificate-overlay">
          <h2>Web Development Bootcamp</h2>
          <p>Issued by ABC Institute</p>
        </div>
      </div>
      <div class="certificate">
        <img src="certificate3.jpg" alt="Certificate 3">
        <div class="certificate-overlay">
          <h2>JavaScript Mastery</h2>
          <p>Issued by DEF Organization</p>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
