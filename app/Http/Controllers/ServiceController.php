<?php

// app/Http/Controllers/ServiceController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Display a list of services
    public function index()
    {
        // Example static data (you can replace this with data from a database)
        $services = [
            [
                'id' => 1,
                'icon' => 'fas fa-shipping-fast',
                'title' => 'Fast Shipping',
                'description' => 'Enjoy fast and reliable shipping services to get your products delivered on time.',
            ],
            [
                'id' => 2,
                'icon' => 'fas fa-headset',
                'title' => '24/7 Support',
                'description' => 'Our dedicated support team is available 24/7 to assist you with any queries or issues.',
            ],
            [
                'id' => 3,
                'icon' => 'fas fa-hand-holding-usd',
                'title' => 'Easy Returns',
                'description' => 'Not satisfied? No problem! We offer hassle-free returns within 30 days.',
            ],
        ];

        return view('services.index', compact('services'));
    }

    // Display details of a specific service
    public function show($id)
    {
        // Example static data (you can replace this with data from a database)
        $services = [
            1 => [
                'icon' => 'fas fa-shipping-fast',
                'title' => 'Fast Shipping',
                'description' => 'Enjoy fast and reliable shipping services to get your products delivered on time.',
                'details' => 'We partner with top logistics providers to ensure your orders reach you as quickly as possible.',
            ],
            2 => [
                'icon' => 'fas fa-headset',
                'title' => '24/7 Support',
                'description' => 'Our dedicated support team is available 24/7 to assist you with any queries or issues.',
                'details' => 'Contact us via phone, email, or live chat anytime for assistance.',
            ],
            3 => [
                'icon' => 'fas fa-hand-holding-usd',
                'title' => 'Easy Returns',
                'description' => 'Not satisfied? No problem! We offer hassle-free returns within 30 days.',
                'details' => 'Simply contact us to initiate a return, and we’ll guide you through the process.',
            ],
        ];

        // Find the service by ID
        $service = $services[$id] ?? abort(404, 'Service not found');

        return view('services.show', compact('service'));
    }
}
