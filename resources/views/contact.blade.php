@extends('layouts.app')
@section('title', 'Contact us')
@section('content')
    <h2>Contact us</h2>
    <div>
        <a href="tel:+4412345678">Phone</a>
        <a href="mailto:info@bridalelegance.com">Email</a>
        <a href="https://wa.me/15551234567">WhatsApp</a>
    </div>

    <div>
        <form action="" method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="phone" placeholder="Phone">
            <textarea name="message" rows="10" placeholder="Type a message..."></textarea>
            <input type="submit" value="Send">
        </form>
    </div>
    <div>
        <h3>Visit the shop!</h3>
        <span>Monday to Saturday : 9am - 6pm</span>
        <span>42 Ivy Lane, Walton East, SA63 5QX</span> 
    </div>
@endsection