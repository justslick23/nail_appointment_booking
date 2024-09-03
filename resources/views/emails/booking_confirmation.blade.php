<!-- resources/views/emails/booking_confirmation.blade.php -->

<p>Dear {{ $appointment->user->name }},</p>

<p>Your appointment has been successfully booked. Here are the details:</p>

<p><strong>Date:</strong> {{ $date }}</p>
<p><strong>Time:</strong> {{ $time }}</p>
<p><strong>Services:</strong> {{ $services }}</p>

<p>Thank you for booking with us!</p>

<p>Best regards,<br>Your Company</p>
