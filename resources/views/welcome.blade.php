<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Portal | Smart Workforce Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.4/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
      <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-50 text-gray-800">
      @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
    {{-- HERO SECTION --}}
    <section class="relative bg-gradient-to-br from-blue-600 to-indigo-700 text-white py-24">
           
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-5xl font-extrabold mb-6">Smart HR Portal</h1>
            <p class="text-lg mb-8 max-w-2xl mx-auto">
                Streamline your workforce with an all-in-one solution — HR, Attendance, Payroll, Projects, and more.
            </p>
            <a href="#features" class="bg-white text-blue-700 font-semibold px-8 py-3 rounded-full shadow hover:bg-blue-50 transition">Explore Features</a>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-16 text-gray-50" fill="currentColor" viewBox="0 0 1440 320"><path fill-opacity="1" d="M0,192L1440,96L1440,320L0,320Z"></path></svg>
        </div>
    </section>

    {{-- ABOUT SECTION --}}
    <section id="about" class="py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Why Choose Our HR Portal?</h2>
            <p class="max-w-3xl mx-auto text-gray-600 text-lg">
                A unified platform for HR, admin, and employees — bringing transparency, automation, and insight to your organization.
            </p>
        </div>
    </section>

    {{-- FEATURES GRID --}}
    <section id="features" class="bg-white py-20">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12">Core Modules</h2>
            <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-10">
                @php
                    $modules = [
                        ['icon'=>'users','title'=>'HR Management','desc'=>'Manage employees, hiring leads, and profiles.'],
                        ['icon'=>'inbox','title'=>'Inquiries','desc'=>'Track and follow up on all incoming leads.'],
                        ['icon'=>'file-text','title'=>'Quotation','desc'=>'Generate and manage business quotations.'],
                        ['icon'=>'building','title'=>'Company','desc'=>'Maintain company details and branches.'],
                        ['icon'=>'briefcase','title'=>'Projects','desc'=>'Track and manage all active projects.'],
                        ['icon'=>'credit-card','title'=>'Invoice & Performa','desc'=>'Generate invoices and performas instantly.'],
                        ['icon'=>'book','title'=>'Receipts & Vouchers','desc'=>'Record transactions and vouchers efficiently.'],
                        ['icon'=>'life-buoy','title'=>'Ticket Management','desc'=>'Handle employee and client tickets easily.'],
                        ['icon'=>'calendar','title'=>'Attendance & Leave','desc'=>'Automated attendance tracking & approval.'],
                        ['icon'=>'image','title'=>'Events','desc'=>'Create, upload, and share event moments.'],
                        ['icon'=>'shield','title'=>'Roles & Permissions','desc'=>'Control access and security with roles.'],
                        ['icon'=>'settings','title'=>'System Settings','desc'=>'Configure system-wide preferences.'],
                    ];
                @endphp

                @foreach($modules as $mod)
                    <div class="p-8 bg-gray-100 rounded-2xl shadow hover:shadow-lg transition transform hover:-translate-y-1">
                        <i data-feather="{{ $mod['icon'] }}" class="w-12 h-12 text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">{{ $mod['title'] }}</h3>
                        <p class="text-gray-600">{{ $mod['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- STATS SECTION --}}
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
        <div class="container mx-auto px-6 grid md:grid-cols-4 sm:grid-cols-2 gap-10 text-center">
            <div><h3 class="text-4xl font-bold">150+</h3><p>Companies Managed</p></div>
            <div><h3 class="text-4xl font-bold">1200+</h3><p>Employees Active</p></div>
            <div><h3 class="text-4xl font-bold">98%</h3><p>Customer Satisfaction</p></div>
            <div><h3 class="text-4xl font-bold">50+</h3><p>Reports & Dashboards</p></div>
        </div>
    </section>

    {{-- SCREENSHOTS / DEMO SECTION --}}
    <section id="screenshots" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Visualize Your HR Portal</h2>
            <p class="max-w-3xl mx-auto text-gray-600 mb-10">See how your data, workflows, and automation come together beautifully.</p>
            <div class="grid md:grid-cols-3 gap-8">
                <img src="https://www.tmi.org/Images/hr-trends-shaping-2024-and-beyond.jpg" alt="Dashboard" class="rounded-2xl shadow-lg">
                <img src="https://media.licdn.com/dms/image/v2/D4E12AQHZTjeTv0UDvA/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1721179536595?e=2147483647&v=beta&t=fQehIBfECVWmSfVQ_4ndxpZjrA0yC6Qha8Y53aqAB_I" alt="Team" class="rounded-2xl shadow-lg">
                <img src="https://www.tmi.org/Images/hr-trends-shaping-2024-and-beyond.jpg" alt="Reports" class="rounded-2xl shadow-lg">
            </div>
        </div>
    </section>

    {{-- TESTIMONIALS --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-8">What Our Clients Say</h2>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="p-6 bg-gray-100 rounded-xl shadow">
                    <p class="italic text-gray-700 mb-4">“An all-in-one HR solution! Saved 40% of our admin time.”</p>
                    <h4 class="font-bold">— Rahul Sharma, HR Head</h4>
                </div>
                <div class="p-6 bg-gray-100 rounded-xl shadow">
                    <p class="italic text-gray-700 mb-4">“Smooth interface and great automation for attendance.”</p>
                    <h4 class="font-bold">— Priya Patel, Admin</h4>
                </div>
                <div class="p-6 bg-gray-100 rounded-xl shadow">
                    <p class="italic text-gray-700 mb-4">“Best dashboard insights for our growing team.”</p>
                    <h4 class="font-bold">— Arjun Mehta, CEO</h4>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="bg-blue-700 text-white py-20 text-center">
        <h2 class="text-4xl font-bold mb-4">Ready to Transform Your HR Operations?</h2>
        <p class="text-lg mb-8">Get started today and experience smarter workforce management.</p>
        <a href="/login" class="bg-white text-blue-700 px-8 py-3 font-semibold rounded-full shadow hover:bg-blue-50 transition">Get Started</a>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-gray-300 py-10 text-center">
        <div class="container mx-auto">
            <p>© {{ date('Y') }} HR Portal. All Rights Reserved.</p>
        </div>
    </footer>

    <script>feather.replace()</script>
</body>
</html>
