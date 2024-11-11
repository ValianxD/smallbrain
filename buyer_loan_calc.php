<?php
include 'db_connection.php';
include_once 'Class/user.class.php'; // Import user class
include_once 'Class/buyer.class.php';
include_once 'logoutcontroller.php';
include_once 'buyer_loancalculatorcontroller.php';

session_start();
$logoutController = new LogoutController;
$user = new User();
$buyer = new Buyer();
$id = $_SESSION['id']; // Store session ID into $id

if (!$user->get_session($id)) { // If user is not logged in
    header("location:login.php"); // Redirect to login.php if not logged in
    exit();
}

if ($user->get_usertype($id) !== "buyer") {
    header("location:error.php");
    exit();
}

if (isset($_GET['q'])){ //get q variable to logout
 $logoutController->handleLogout(); //log user out with session destroy
}

// Fetch the user's full name
$buyer_fullname = trim($user->get_fullname($id));

// Instantiate the controller
$controller = new LoanCalculatorController();

// Retrieve car price from the URL or session if set
$car_price = isset($_GET['price']) ? floatval($_GET['price']) : 0;
$monthly_payment = '';
$interest_rate = '';
$error_message = '';

// Handle form submission for loan calculation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $down_payment = isset($_POST['down_payment']) ? floatval($_POST['down_payment']) : 0;
    $loan_term = isset($_POST['loan_term']) ? intval($_POST['loan_term']) : 0;

    // Get interest rate and calculate monthly payment using the controller
    if ($down_payment > $car_price) {
        $error_message = "Down payment cannot exceed the car price.";
    } else {
        $interest_rate = $controller->getInterestRate($loan_term);
        $monthly_payment = $controller->calculateMonthlyPayment($car_price, $down_payment, $loan_term);
        $monthly_payment = number_format($monthly_payment, 2);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--link to styles.css-->
    <link rel="stylesheet" href="./styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <title>Home</title>
    <style>
        .separator {
            margin-top: 20px;
            margin-bottom: 20px;
            border-top: 2px solid #ddd;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <!--start of navbar-->
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="buyer.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link">Welcome, <?php echo htmlspecialchars($buyer_fullname); ?>!</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="buyer.php?q=logout">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--end of navbar-->

    <!--start of container-->
    <div class="container mt-5">
        <!-- Centralized Available Cars title -->
        <div class="text-center">
            <h2 class="mb-4">Loan Calculator</h2>
        </div>
        <!-- Separator -->
        <hr class="separator">

        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="buyer_loan_calc.php?price=<?php echo htmlspecialchars($car_price); ?>">
            <!-- Car Price (Auto-filled) -->
            <div class="form-group">
                <label>Car Price:</label>
                <input type="number" name="car_price" value="<?php echo htmlspecialchars($car_price); ?>" class="form-control" readonly>
            </div>

            <!-- Down Payment -->
            <div class="form-group">
                <label>Down Payment:</label>
                <input type="number" name="down_payment" class="form-control" required>
            </div>
            
            <!-- Loan Term (Dropdown for 1-7 years) -->
            <div class="form-group">
                <label>Loan Term (Years):</label>
                <select name="loan_term" class="form-control" required>
                    <option value="">Select Loan Term</option>
                    <?php for ($i = 1; $i <= 7; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php if (isset($_POST['loan_term']) && $_POST['loan_term'] == $i) echo 'selected'; ?>>
                            <?php echo $i; ?> Year(s)
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <!-- Interest Rate (Auto-updated based on loan term) -->
            <div class="form-group">
                <label>Interest Rate (%):</label>
                <input type="text" name="interest_rate" class="form-control" value="<?php echo htmlspecialchars($interest_rate); ?>" readonly>
            </div>

            <!-- Monthly Payment (Calculated after form submission) -->
            <div class="form-group">
                <label>Monthly Payment:</label>
                <input type="text" name="monthly_payment" class="form-control" value="<?php echo htmlspecialchars($monthly_payment); ?>" readonly>
            </div>

             <!-- Buttons: Calculate and Reset -->
            <button type="submit" class="btn btn-primary">Calculate</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </form>

    </div>

</body>

</html>
