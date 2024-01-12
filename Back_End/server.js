const express = require('express');
const sgMail = require('@sendgrid/mail');

const app = express();
const port = process.env.PORT || 3000;

app.use(express.json());

sgMail.setApiKey('API_KEY');

app.post('/send-email', (req, res) => {
  const {subject, text} = req.body;

  const msg = {
    to: 'chrisfoong010@gmail.com',
    from: 'keshocanabis@gmail.com', // Change to your verified sender
    subject,
    text,
  };

  sgMail
    .send(msg)
    .then((response) => {
      console.log(response[0].statusCode);
      console.log(response[0].headers);
      res.status(200).send('Email sent successfully');
    })
    .catch((error) => {
      console.error(error);
      res.status(500).send('Error sending email');
    });
});

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
