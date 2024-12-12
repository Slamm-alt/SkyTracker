<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking</title>
    <link rel="stylesheet" href="style4.css">
    <style>
         header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            background-color: #ff6b6b;
            padding: 10px 20px;
            color: white;
            font-size: 18px;
            position: fixed; /* Tetap di atas */
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
        }

        .menu {
            display: flex;
            gap: 20px;
        }

        .menu a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .menu a:hover {
            color: #ffe0e0;
        }

        /* Tambahkan padding-top ke body agar tidak tertutup oleh header */
        body {
            padding-top: 60px;
        }
    

        .form-field {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .form-field label {
            flex: 1;
        }

        .form-field input {
            flex: 2;
            padding: 5px;
        }

        /* Popup styling without background color */
        .popup, .overlay {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.8); /* Semi-transparent dark background */
            color: rgb(0, 0, 0);
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            z-index: 1000;
        }

        .popup-content {
            text-align: center;
        }

        .popup button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .popup button:hover {
            background: #218838;
        }

        /* Hide popup close buttons */
        .close {
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <div class="title">Flight</div>
        <div class="menu">
            <a href="index.html">Home</a>
            <a href="login.html">Login</a>
            <a href="dashboard.html">Dashboard</a>
        </div>
    </header>
    <div class="flight-container">
        <div class="flight-card">
            <img src="bali.png" alt="Bali">
            <p>To <strong>Bali</strong></p>
            <p>Departure Date<br><strong>11 Nov 2024</strong></p>
            <button onclick="showPopup('Bali', '11 Nov 2024')">Buy</button>
        </div>
        <div class="flight-card">
            <img src="jakarta.png" alt="Jakarta">
            <p>To <strong>Jakarta</strong></p>
            <p>Departure Date<br><strong>13 Nov 2024</strong></p>
            <button onclick="showPopup('Jakarta', '13 Nov 2024')">Buy</button>
        </div>
        <div class="flight-card">
            <img src="kalimantan.png" alt="Kalimantan">
            <p>To <strong>Kalimantan</strong></p>
            <p>Departure Date<br><strong>18 Nov 2024</strong></p>
            <button onclick="showPopup('Kalimantan', '18 Nov 2024')">Buy</button>
        </div>
    </div>

    <!-- Popup for ordering tickets -->
    <div class="popup" id="popup">
        <div class="popup-content">
            <h3>Order Tickets</h3>
            <form id="ticket-form">
                <div class="form-field">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-field">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-field">
                    <label for="tickets">Number of Tickets:</label>
                    <input type="number" id="tickets" name="tickets" min="1" required>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <!-- Confirmation Popup -->
    <div class="popup" id="confirmation-popup">
        <div class="popup-content">
            <h3>Confirm Your Order</h3>
            <p><strong>Name:</strong> <span id="confirm-name"></span></p>
            <p><strong>Phone Number:</strong> <span id="confirm-phone"></span></p>
            <p><strong>Number of Tickets:</strong> <span id="confirm-tickets"></span></p>
            <p><strong>Destination:</strong> <span id="confirm-destination"></span></p>
            <button onclick="finalizePurchase()">Confirm Purchase</button>
            <button onclick="closeConfirmationPopup()">Cancel</button>
        </div>
    </div>

    <!-- Final Confirmation Popup -->
    <div class="popup" id="final-popup">
        <div class="popup-content">
            <h3>Success!</h3>
            <p>Your ticket to <span id="final-destination"></span> has been purchased.</p>
            <button onclick="closeFinalPopup()">OK</button>
        </div>
    </div>

    <script src="script1.js"></script>
</body>
</html>
