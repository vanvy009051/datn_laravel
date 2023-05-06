@extends('frontend.master')
@section('title','Contact Us' )
@section('main')

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<section class="contact">
    <div class="content">
        <h2>Contact Us</h2>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur soluta accusantium ratione!
            Dolores voluptates soluta, aut dolore nostrum ratione illum eligendi tempora excepturi voluptatum laboriosam earum veniam eum error pariatur.
        </p>
    </div>
    <div class="container">
        <div class="contact-info">
            <div class="box">
                <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i>
                </div>
                <div class="text">
                    <h3>Address</h3>
                    <p>245 Le Thanh Nghi, Hoa Cuong, <br>Hai Chau, Da Nang, <br>550000</p>
                </div>
            </div>
            <div class="box">
                <div class="icon"><i class="fa-solid fa-phone"></i></div>
                <div class="text">
                    <h3>Phone</h3>
                    <p>(0796) 845 - 488</p>
                </div>
            </div>
            <div class="box">
                <div class="icon"><i class="fa-solid fa-envelope"></i></div>
                <div class="text">
                    <h3>Email</h3>
                    <p>thanhquoc@bititech.vn</p>
                </div>
            </div>
        </div>
        <div class="contact-form">
            <form action="">
                <h2>Send Message</h2>
                <div class="input-box">
                    <input type="text" name="" required>
                    <span>Fullname</span>
                </div>
                <div class="input-box">
                    <input type="text" name="" required>
                    <span>Email</span>
                </div>
                <div class="input-box">
                    <textarea name="" required></textarea>
                    <span>Type your message...</span>
                </div>
                <div class="input-box">
                    <input type="submit" name="" required>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection