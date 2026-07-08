<style>
	.footer-section{
    background:#1f1f1f;
    color:#ddd;
    padding:70px 0 20px;
}

.footer-title{
    color:#fff;
    font-size:28px;
    margin-bottom:20px;
}

.footer-heading{
    color:#fff;
    margin-bottom:20px;
    font-size:18px;
}

.footer-text{
    color:#bbb;
    line-height:1.8;
}

.footer-links{
    list-style:none;
    padding:0;
}

.footer-links li{
    margin-bottom:12px;
}

.footer-links a{
    color:#bbb;
    text-decoration:none;
    transition:.3s;
}

.footer-links a:hover{
    color:#c5a880;
    padding-left:5px;
}

.footer-contact{
    list-style:none;
    padding:0;
}

.footer-contact li{
    margin-bottom:15px;
    color:#bbb;
}

.footer-contact i{
    color:#c5a880;
    margin-right:10px;
    width:20px;
}

.footer-social{
    margin-top:20px;
}

.footer-social a{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:42px;
    height:42px;
    border-radius:50%;
    background:#2d2d2d;
    color:#fff;
    margin-right:10px;
    text-decoration:none;
    transition:.3s;
}

.footer-social a:hover{
    background:#c5a880;
    transform:translateY(-4px);
}

.footer-section hr{
    border-color:#444;
    margin:40px 0 20px;
}

.footer-bottom{
    text-align:center;
    color:#999;
}
@media(max-width:768px){

.footer-section{
    text-align:center;
}

.footer-social{
    justify-content:center;
}

.footer-links,
.footer-contact{
    margin-bottom:30px;
}

}
</style>
<footer class="footer-section">

    <div class="container">

        <div class="row gy-5">

            <!-- Library -->
            <div class="col-lg-4 col-md-6">

                <h3 class="footer-title">
                    📚 Library System
                </h3>

                <p class="footer-text">
                    Discover thousands of books across different categories.
                    Read anytime, anywhere, and enjoy a seamless digital
                    library experience.
                </p>

            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">

                <h4 class="footer-heading">Quick Links</h4>

                <ul class="footer-links">

                    <li><a href="/">Home</a></li>

                    <li><a href="#featured-books">Featured Books</a></li>

                    <li><a href="#popular-books">Popular Books</a></li>

                    <li><a href="#subscribe">Newsletter</a></li>

                </ul>

            </div>

            <!-- Categories -->
            <div class="col-lg-3 col-md-6">

                <h4 class="footer-heading">Categories</h4>

                <ul class="footer-links">

                    @foreach($categories->take(5) as $category)
                        <li>{{ $category->category_name }}</li>
                    @endforeach

                </ul>

            </div>

            <!-- Contact -->
            <div class="col-lg-3 col-md-6">

                <h4 class="footer-heading">Contact</h4>

                <ul class="footer-contact">

                    <li>
                        <i class="fas fa-envelope"></i>
                        support@library.com
                    </li>

                    <li>
                        <i class="fas fa-phone"></i>
                        +92 300 1234567
                    </li>

                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        Multan, Pakistan
                    </li>

                </ul>

                <div class="footer-social">

                    <a href="#"><i class="fab fa-facebook-f"></i></a>

                    <a href="#"><i class="fab fa-instagram"></i></a>

                    <a href="#"><i class="fab fa-twitter"></i></a>

                    <a href="#"><i class="fab fa-linkedin-in"></i></a>

                </div>

            </div>

        </div>

        <hr>

        <div class="footer-bottom">

            <p>
                © {{ date('Y') }} Library Management System.
                All Rights Reserved.
            </p>

        </div>

    </div>

</footer>