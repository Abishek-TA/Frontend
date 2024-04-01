<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArrowGrub</title>
    <link rel="icon" href="./Asset/Images/ArrowGrub.png" type="Image/x-icon">
    <link rel="stylesheet" href="./Asset/css/styles.css">
    <link rel="stylesheet" href="./Asset/css/ABS_table.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>        
    <script src="./Asset/js/index.js" async></script>
</head>
<body>
<!--------------------------Header-------------------------------->
<div id="head1"></div>
<!--Text-->
<center><h1>Select your Table</h1></center>

<form id="reserveForm" action="./Asset/php/resvere.php" method="POST">


  <!--Calennder slot-->
  <div class="abst1" data-restaurent = "abs">
    <div class="date1">
        <span>Select Date</span>
        <input type="date" class="restrict1" id="restrict1" name="datefrom"/>
    </div>
    <!--Time slot-->
    <div class="timings">
        <div class="times">
            <input type="radio" name="time" id="t1" value="09:00 AM" />
            <label for="t1" class="time">09:00 AM</label>
            <input type="radio" name="time" id="t2" value="10:00 AM" />
            <label for="t2" class="time">10:00 AM</label>
            <input type="radio" name="time" id="t3" value="11:00 AM" />
            <label for="t3" class="time">11:00 AM</label>
            <input type="radio" name="time" id="t4" value="12:00 PM" />
            <label for="t4" class="time">12:00 PM</label>
            <input type="radio" name="time" id="t5" value="13:00 PM" />
            <label for="t5" class="time">01:00 PM</label>
            <input type="radio" name="time" id="t6" value="14:00 PM" />
            <label for="t6" class="time">02:00 PM</label>
            <input type="radio" name="time" id="t7" value="15:00 AM" />
            <label for="t7" class="time">03:00 PM</label>
            <input type="radio" name="time" id="t8" value="16:00 PM" />
            <label for="t8" class="time">04:00 PM</label>
            <input type="radio" name="time" id="t9" value="17:00 PM" />
            <label for="t9" class="time">05:00 PM</label>
            <input type="radio" name="time" id="t10" value="18:00 PM" />
            <label for="t10" class="time">06:00 PM</label>
            <input type="radio" name="time" id="t11" value="19:00 PM" />
            <label for="t11" class="time">07:00 PM</label>
            <input type="radio" name="time" id="t12" value="20:00 PM" />
            <label for="t12" class="time">08:00 PM</label>
            <input type="radio" name="time" id="t13" value="21:00 PM" />
            <label for="t13" class="time">09:00 PM</label>
            <input type="radio" name="time" id="t14" value="22:00 PM" />
            <label for="t14" class="time">10:00 PM</label>
        </div>
    </div>
     <!-- dynamic time slot -->
     <script>
document.addEventListener("DOMContentLoaded", function () {
  const timeContainer = document.querySelector('.times');
  const dateInput = document.getElementById('restrict1');

  // Array to store reserved seats (update this array with actual reserved seats)
  const reservedSeats = [];

  function updateTimeSlots() {
    const currentTime = new Date().getHours(); // Get current hour
    const selectedDate = new Date(dateInput.value);
    const currentDate = new Date();
    currentDate.setHours(0, 0, 0, 0); // Clear time for comparison
    selectedDate.setHours(0, 0, 0, 0); // Clear time for comparison

    if (selectedDate > currentDate) { // Check if selected date is after current date
      // Enable all time slots
      timeContainer.querySelectorAll('input[type="radio"]').forEach(option => {
        option.disabled = false;
      });
    } else if (selectedDate.getTime() === currentDate.getTime()) { // Check if selected date is current date
      // Enable future time slots and disable past time slots
      timeContainer.querySelectorAll('input[type="radio"]').forEach(option => {
        const hour = parseInt(option.value.split(":")[0]);
        option.disabled = hour < currentTime;
      });
    } else { // Selected date is before current date
      // Disable all time slots
      timeContainer.querySelectorAll('input[type="radio"]').forEach(option => {
        option.disabled = true;
      });
    }

    // Disable reserved seats
    reservedSeats.forEach(seat => {
      const reservedCheckbox = timeContainer.querySelector('input[value="' + seat + '"]');
      if (reservedCheckbox) {
        reservedCheckbox.disabled = true;
      }
    });
  }

  // Initial update of time slots
  updateTimeSlots();

  // Add event listener to date input
  dateInput.addEventListener('change', updateTimeSlots);
});

      </script>
      <!-- After the closing </form> tag -->
        <div id="reservedSeats"></div>

  <!-----------------------Table section---------------------------->
  <div class="table-container">
        <!-----------------------Table1 content------------------->    
        <div class="entry_or_exit">
            <h1 class="ent">Entrance</h1>
        </div>
        <div class="r1">
            <!--Row1c1-->
                <div class="r1c1">
                    <div class="r1c1s">
                        <input type="checkbox" name="tickets[]" id="r1c1s1" value="t1s1"/>
                        <label for="r1c1s1" class="seatr1">s1</label>
                        <input type="checkbox" name="tickets[]" id="r1c1s2" value="t1s2"/>
                        <label for="r1c1s2" class="seatr1">s2</label>
                    </div>
                    <h1 class="r1table1">Table 1</h1>
                    <div class="r1c1s">
                        <input type="checkbox" name="tickets[]" id="r1c1s3" value="t1s3"/>
                        <label for="r1c1s3" class="seatr1">s3</label>
                        <input type="checkbox" name="tickets[]" id="r1c1s4" value="t1s4"/>
                        <label for="r1c1s4" class="seatr1">s4</label>
                    </div>
                </div>
                <!--Row1c2-->
                <div class="r1wall">
                    <div class="wallimg">
                        <span class="wall1">WALL</span>
                    </div>
                </div>
            </div>   
        <!-----------------------Table2 content------------------->
                <div class="r2">
                    <!--Table2 row1 content-->
                        <div class="r2c1">
                            <div class="r2c1s">
                                <input type="checkbox" name="tickets[]" id="r2c1s1" value="t2s1"/>
                                <label for="r2c1s1" class="seatr2">s1</label>
                                <input type="checkbox" name="tickets[]" id="r2c1s2" value="t2s2"/>
                                <label for="r2c1s2" class="seatr2">s2</label>
                            </div>
                            <h1 class="r2table1">Table 2</h1>
                            <div class="r2c1s">
                                <input type="checkbox" name="tickets[]" id="r2c1s3" value="t2s3"/>
                                <label for="r2c1s3" class="seatr2">s3</label>
                                <input type="checkbox" name="tickets[]" id="r2c1s4" value="t2s4"/>
                                <label for="r2c1s4" class="seatr2">s4</label>
                            </div>
                        </div>
                    <!--Table2 row2 content-->
                        <div class="r2c2">
                            <div class="r2c2s">
                                <input type="checkbox" name="tickets[]" id="r2c2s1" value="t4s1"/>
                                <label for="r2c2s1" class="seatr22">s1</label>
                            </div>
                            <h1 class="r2table2">Table 4</h1>
                            <div class="r2c2s">
                                <input type="checkbox" name="tickets[]" id="r2c2s2" value="t4s2"/>
                                <label for="r2c2s2" class="seatr22">s2</label>
                            </div>
                        </div>
                </div>
        <!-----------------------Table3 content------------------->
            <div class="r3">
                <div class="r3c1">
                    <div class="r3c1s">
                        <input type="checkbox" name="tickets[]" id="r3c1s1" value="t3s1"/>
                        <label for="r3c1s1" class="seatr3">s1</label>
                        <input type="checkbox" name="tickets[]" id="r3c1s2" value="t3s2"/>
                        <label for="r3c1s2" class="seatr3">s2</label>
                    </div>
                    <h1 class="r3table1">Table 3</h1>
                    <div class="r3c1s">
                        <input type="checkbox" name="tickets[]" id="r3c1s3" value="t3s3"/>
                        <label for="r3c1s3" class="seatr3">s3</label>
                        <input type="checkbox" name="tickets[]" id="r3c1s4" value="t3s4"/>
                        <label for="r3c1s4" class="seatr3">s4</label>
                    </div>
                </div>
                <div class="r3c2">
                    <div class="recep">
                        <h1>RECEPTION</h1>
                    </div>
                </div>
            </div>
            <div class="r4">
              <div class="wash">
                <div class="washroom">WASHROOM</div>
              </div>
              <div class="kitchen1">
                <div class="kit1">KITCHEN</div>
              </div>
            </div>
            <div class="price">
            <div class="total">
                <input type="hidden" id="amountField" name="amountform" value="0" />
                <span>Total Amount: ₹ <span class="amount">0.00</span></span>
                <span>Total Seats: <span class="count">0</span></span>
            </div>
              </div>
              <button onclick="myFunction(); document.getElementById('submit','amount').click()"></button>
                <button id="submit" class="bookre1" type="submit" name="submit">
                    Book Table
                </button>

            </div>
          </div>
    </form>
</div>
<br><br>
<script>
function myFunction() {
    var checkboxes = document.querySelectorAll('input[name="tickets"]:checked');
    var selectedSeats = Array.from(checkboxes).map(checkbox => checkbox.value).join(', ');
    document.getElementById("demo").innerHTML = selectedSeats;
    
}
  </script>

    <!-- dynamic price calculation -->
    <?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arrowgrub";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = "admin"; // Replace 'admin' with the desired username

$sql = "SELECT base_price, peak_price FROM admin WHERE username = '$username' LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
    $basePrice = $row["base_price"];
    $peakPrice = $row["peak_price"];
} else {
    echo "0 results";
}

$conn->close();
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const basePrice = <?php echo $basePrice; ?>;
    const peakPrice = <?php echo $peakPrice; ?>;
    const seats = document.querySelectorAll('input[type="checkbox"]');
    const amountDisplay = document.querySelector(".amount");
    const countDisplay = document.querySelector(".count");
    let totalAmount = 0;
    let selectedSeats = 0;

    seats.forEach((seat) => {
        seat.addEventListener("change", () => {
            const dynamicPrice = calculateDynamicPrice(basePrice);
            if (seat.checked) {
                totalAmount += dynamicPrice;
                selectedSeats++;
            } else {
                totalAmount -= dynamicPrice;
                selectedSeats--;
            }
            amountDisplay.textContent = totalAmount.toFixed(2);
            countDisplay.textContent = selectedSeats;
            // Update value of hidden input field
            document.getElementById("amountField").value = totalAmount.toFixed(2);
        });
    });

    function calculateDynamicPrice(basePrice) {
        const selectedTimeInput = document.querySelector('input[name="time"]:checked');
        if (!selectedTimeInput) {
            return basePrice;
        }
        const selectedTime = selectedTimeInput.value;
        const selectedHours = parseInt(selectedTime.split(":")[0]);

        if (selectedHours >= 18 && selectedHours <= 23) {
            return basePrice + peakPrice;
        } else {
            return basePrice;
        }
    }
});
</script>
      <script>
document.addEventListener("DOMContentLoaded", function () {
  const dateInput = document.getElementById('restrict1');
  const timeInputs = document.querySelectorAll('input[name="time"]');

  function fetchReservedSeats() {
    const selectedDate = dateInput.value;
    const selectedTimeInput = document.querySelector('input[name="time"]:checked');
const selectedTime = selectedTimeInput ? selectedTimeInput.value : '';

    // AJAX request to fetch reserved seats
    $.ajax({
      url: 'fetch_reserved_seats.php', // Update this with the path to your PHP script
      method: 'POST',
      data: { date: selectedDate, time: selectedTime },
      success: function (response) {
        // Update reserved seats UI
        document.getElementById('reservedSeats').innerHTML = response;
      },
      error: function (xhr, status, error) {
        console.error('Error fetching reserved seats:', error);
      }
    });
  }

  // Event listener for date input change
  dateInput.addEventListener('change', fetchReservedSeats);

  // Event listener for time input change
  timeInputs.forEach(input => {
    input.addEventListener('change', fetchReservedSeats);
  });
});
</script>
<!---------------------------Footer------------------------------->
<div class="footer"></div>
</body>