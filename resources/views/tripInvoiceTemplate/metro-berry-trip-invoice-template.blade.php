<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <title>Invoice Template</title>

    <style>
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Roboto", sans-serif;
}

body {
  background-color: #f0f2f5;
}

.left-side {
  background-color: #13171a;
  position: absolute;
  top: 0;
  left: 0;
  bottom: -20rem;
  width: 19rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.left-side .logo img {
  width: 100%;
  padding: 1rem 0;
}

.bottom-text {
  color: #8899a6;
  text-align: center;
  padding: 1rem;
  margin-bottom: 7rem;
}

.right-side {
  position: absolute;
  top: 0;
  left: 20rem;
  height: 100vh;
  background-color: #f0f2f5;
  padding: 1rem;
  text-align: end;
}

.right-side .title {
  margin: 1rem 15rem;
}

.right-side .title span {
  font-size: 3rem;
  font-weight: lighter;
}

.title .details {
  display: flex;
  justify-content: flex-end;
}

.user-details {
  text-align: start;
}

.invoice-table {
  position: relative;
  top: 2rem;
  left: -100;
  background-color: #f0f2f5;
  padding: 2rem;
  width: 100%;
  opacity: 0.8;
}

.invoice-table th,
.invoice-table td {
  padding: 1rem;
  border-bottom: 1px solid #8899a6;
  margin: 1rem;
}

.total {
  position: relative;
  right: -21rem;
  width: 25%;
  background-color: #dc3545;
  padding: 1rem;
  text-align: center;
  color: #f0f2f5;
  font-weight: bold;
}

.payment-details {
  position: absolute;
  text-align: start;
  margin-top: 1rem;
  margin-bottom: 1rem;
}

.payment-details .pay-title {
  font-size: 1.5rem;
  font-weight: bold;
  margin: 0.5rem;
}

.div-1 {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  margin-bottom: 1rem;
}

.tours {
  font-weight: 500;
}

ul {
  list-style-type: none;
  padding-bottom: 1.5rem;
}

.signature {
  position: relative;
  top: 19rem;
  left: 23rem;
  width: 25%;
  padding: 1rem;
  text-align: center;
  font-weight: bold;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.underline {
  border-bottom: 2px solid #13171a;
}

.ending {
  position: relative;
  top: 16rem;
  width: 100%;
  bottom: 1rem;
  left: -5rem;
  background-color: #dc3545;
  text-align: center;
  padding: 0.5rem;
  margin: 5rem 1rem;
  font-weight: bold;
  color: #f0f2f5;
  font-size: 1.5rem;
}

    </style>
  </head>
  <body>
    <div class="left-side">
      <img src="{{ asset('logo.png') }}" alt="Logo" />
      <div class="bottom-text">
        If you have any questions concerning this invoice, use the following
        contact information: Contact Thomas, Phone Number,+254748 156 366.
        Email: metroberry254@gmail.com
      </div>
    </div>

    <div class="right-side">
      <div class="title">
        <span>INVOICE</span>

        <div class="details">
          <div>Invoice #</div>
          <div class="variable">001</div>
        </div>

        <div class="details">
          <div>Date:</div>
          <div class="variable">2024-01-01</div>
        </div>
      </div>

      <div class="user-details">
        <div class="name">Dickson Munene</div>
        <div class="location">Westlands</div>
        <div class="country">Kenya</div>
      </div>

      <table class="invoice-table">
        <thead>
          <tr>
            <th>Description</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Product 1</td>
            <td>KES 100</td>
          </tr>
        </tbody>
      </table>
      <br />

      <div class="total">Total: KES 100</div>

      <div class="payment-details">
        <div class="pay-title">Payment Info:</div>
        <div class="div-1">
          <div>Please make all checks payable to:</div>
          <div class="tours">Metroberry Tours and Travel</div>
        </div>
        <ul>
          <li>
            Bank transfers payable to:
            <span class="tours">Metroberry Tours and Travel</span>
          </li>
          <li>Bank Name: <span class="tours">Stanbic Bank of Kenya</span></li>
          <li>Branch: <span class="tours">Chiromo Branch</span></li>
          <li>Account Number: <span class="tours">0100007750767</span></li>
          <li>Swift Code: <span class="tours">SBICKENX</span></li>
          <li>Branch code: <span class="tours">007</span></li>
        </ul>
      </div>

      <div class="signature">
        <div class="underline"></div>
        <div>Authorised Sign</div>
      </div>

      <div class="ending">Thank you for your business</div>
    </div>
  </body>
</html>
