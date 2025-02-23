<footer>
    <div class="footer-content">
        <!-- About Us Section -->
        <div class="footer-section about">
            <h3>{{ __('messages.about_us') }}</h3>
            <p>{{ __('messages.about_us_text') }}</p>
        </div>

        <!-- Quick Links Section -->
        <div class="footer-section links">
            <h3>{{ __('messages.quick_links') }}</h3>
            <ul>
                <li><a href="{{ route('services.index') }}">{{ __('messages.services') }}</a></li>
                <li><a href="#">{{ __('messages.contact') }}</a></li>
                <li><a href="http://www.linkedin.com/in/areej-abdelhamid-" target="_blank">{{ __('messages.linkedin') }}</a></li>
                <li><a href="https://github.com/Areej344" target="_blank">{{ __('messages.github') }}</a></li>
            </ul>
        </div>

        <!-- Contact Us Section -->
        <div class="footer-section contact">
            <h3>{{ __('messages.contact_us') }}</h3>
            <p>{{ __('messages.email') }}: areejabdelhamid344@gmail.com</p>
            <p>{{ __('messages.phone') }}: +123 456 7890</p>
            <p>{{ __('messages.address') }}: 123 Main St, City, Country</p>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <p>{{ __('messages.copyright') }}</p>
    </div>
</footer>

<style>
    footer {
        background-color: #333;
        color: #fff;
        padding: 20px 0;
        text-align: center;
    }

    .footer-content {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .footer-section {
        flex: 1;
        padding: 20px;
        min-width: 200px;
    }

    .footer-section h3 {
        margin-bottom: 15px;
    }

    .footer-section p, .footer-section ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .footer-section ul li {
        margin-bottom: 10px;
    }

    .footer-section ul li a {
        color: #fff;
        text-decoration: none;
    }

    .footer-section ul li a:hover {
        color: #f4f4f4;
        text-decoration: underline;
    }

    .footer-bottom {
        margin-top: 20px;
        border-top: 1px solid #444;
        padding-top: 10px;
    }
</style>