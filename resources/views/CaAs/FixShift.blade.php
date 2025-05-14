<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shift</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-Shift bg-cover bg-center bg-no-repeat max-w-full scroll-x-hide overflow-hidden ">

    <img src="assets/Wall2.webp" alt="Wall" class="fixed left-0 h-full w-auto">
    <img src="assets/Wall-Mobile.webp" alt="Wall" class="fixed inset-0 w-[200px] sm:hidden">
    <img src="assets/Crystal 3.webp" alt="Crystal" class="fixed bottom-0 left-0 h-96 w-auto scale-x-[-1] scale-y-[-1]">
    <img src="assets/Crystal 5.webp" alt="Crystal" class="fixed bottom-0 z-10 left-36 h-52 w-auto">
    <img src="assets/Crystal 2.webp" alt="Crystal" class="fixed top-0 z-10 left-0 h-full w-auto">
    <img src="assets/Shine.webp" alt="Shine" class="fixed bottom-24 z-10 left-5 h-auto w-[70px] sm:w-auto">
    <img src="assets/Shine.webp" alt="Shine" class="fixed bottom-10 z-10 left-32  h-auto w-[70px] sm:w-auto">
    <img src="assets/Wall 3.webp" alt="Wall" class="fixed right-0 h-full w-auto opacity-0 lg:opacity-100 md:opacity-100">
    <img src="assets/Crystal 5.webp" alt="Crystal" class="fixed bottom-0 -right-14 h-60 w-auto opacity-0 lg:opacity-100 md:opacity-100">
    <img src="assets/Shine.webp" alt="Shine" class="fixed bottom-10 right-5 w-[200px] opacity-0 lg:opacity-100 md:opacity-100">
    
    @php
        use Illuminate\Support\Facades\Auth;
        $user = Auth::user();
        $stageName = match($user->caasStage->stage->name) {
            'Teaching Test' => 'Teaching Test',
            'Coding & Writing Test' => 'Coding & Writing Test',
            default => 'Interview'
        };
    @endphp
    <div class="absolute bg-BlackLayer w-full h-full z-20">
        <div class="container mx-auto py-5 font-crimson-text">
            <div class="inset-0 text-white text-center">
                <h2 class="font-crimson-text text-md lg:text-lg md:text-lg pb-1 font-bold">Discover The Light Within</h2>
                <h1 class="text-xl md:text-2xl lg:text-2xl mx-5">Your Shift For {{ $stageName }}</h1>
            </div>
            <div class="flex relative justify-center -top-10">
                <img src="assets/Announcement Stone.webp" alt="" class="h-[700px]">
                <div class="absolute text-justify mt-32 w-[230px] lg:w-[250px]">
                @if ($shift)
                    <p class="lg:text-lg text-base mb-5 font-im-fell-english">Once you choose a shift, it cannot be changed. Your assigned shift will be displayed below.</p>

                    <p class="ml-3 text-lg font-crimson-text font-bold">Date: {{ Carbon\Carbon::parse($shift->date)->format('l, j F Y') }}</p>
                    <p class="ml-3 text-lg font-crimson-text font-bold">Time: {{ substr($shift->time_start, 0, 5) . '-' . substr($shift->time_end, 0, 5) . ' WIB' }}</p>
                    <p class="ml-3 text-lg font-crimson-text font-bold">Shift: {{ $shift->shift_no }}</p>

                    <p class="lg:text-lg text-base mt-5 font-im-fell-english">Please make sure to remember your assigned shift and stay updated via our OA Line for any upcoming information.</p>
                    <p class="lg:text-lg text-base mt-5 font-im-fell-english"> Thank you!</p>
                    @else
                        <p class="lg:text-lg text-base font-bold mb-5">
                            You haven't picked any shift yet.
                        </p>
                        <p>
                            <a href="{{ route('caas.choose-shift') }}" class="underline">
                                Click here to choose shift
                            </a>
                        </p>
                    @endif
                </div>
                <div class="absolute bottom-[70px] ml-56">
                    <img src="assets/Sign DLOR.webp" alt="Sign" class="w-[120px]">
                </div>
            </div>
        </div>
        </div>
    <x-sidebar></x-sidebar>
    <x-home-button></x-home-button>
    

</body>
</html>