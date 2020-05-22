<!DOCTYPE html>
<html>

<head>
    <title>login</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/main.css')}}">
</head>

<body>
    <div class="flex" id="app">
        <div class="px-4 lg:px-24 lg:w-5/12 h-full">
            <div class="flex flex-col justify-center items-center ">
                <img src="{{asset('public/images/cat.png')}}" class="" />
                <img src="{{asset('public/images/logo.png')}}" class="w-56" />
            </div>
            <div>
                <login-form></login-form>
            </div>
            <footer class="my-10">
                <p class="text-center text-gray-600">
                    &copy; 2020 All Rights Reserved Bulong <br />
                    <a href="" class="text-teal-600">Privacy</a> and <a href="" class="text-teal-600">Terms</a>
                </p>
            </footer>
        </div>
        <div class="p-8 w-8/12  hidden lg:block bg-cover" style="background-image:url('images/background1.png')">
            <div class="pr-6 w-8/12 h-screen overflow-y-scroll">
                <h3 class="text-gray-700">Trending Confessions:</h3>
                @foreach($trendingConfessions as $confession)
                    <confession :confession="{{ $confession }}"></confession>
                @endforeach
                <!-- card start -->
                <!-- <div class="mt-2 mb-8 bg-white border rounded-lg shadow">
                    <div class="flex justify-between p-4">
                        <div class="flex">
                            <div>
                                <img src="{{asset('images/profile.png')}}" class="lg:h-10 lg:w-10 mr-2" />
                            </div>
                            <div>
                                <div class="flex">
                                    <a href="" class="text-teal-600 font-bold mr-1">Pukiungtu</a>
                                </div>
                                <button class="px-6 text-sm text-white bg-yellow-600 rounded">Follow</button>
                            </div>
                        </div>
                        <div>
                            <div>
                                <i class="fa fa-ellipsis-h mr-5 text-gray-600 "></i>
                            </div>
                        </div>
                    </div>
                    <div class="h-64 flex justify-center items-center bg-blue-900">
                        <p class="px-4 text-white text-lg">
                            FELL ASLEEP ON THE TOILET WOKE UP AND EVERYONE WAS GONE , I WAS LOCKED IN THE BAR
                        </p>
                    </div>
                    <div class="mt-2 text-sm ml-4 lg:flex lg:justify-end">
                        <span class="mr-2 text-gray-600">Posted 3 minutes ago on</span>
                        <a href="" class="mr-4 text-teal-600 font-bold">Love and Relationship</a>
                    </div>
                    <div class="ml-4 pb-2 flex">
                        <div class="flex flex-col items-center">
                            <span>158</span>
                            <img src="{{ asset('icons/feel.png') }}" class="w-8 h-8" />
                        </div>
                        <div class="mx-2 flex flex-col items-center">
                            <span>51</span>
                            <img src="{{ asset('icons/comment.png') }}" class="w-8 h-8" />
                        </div>
                        <div class="flex flex-col justify-end">
                            <img src="{{ asset('icons/share.png') }}" class="w-8 h-8" />
                        </div>
                    </div>
                </div> -->
                <!-- card end -->
                <!-- card start -->
                <!-- <div class="mt-2 mb-8 bg-white border rounded-lg shadow">
                    <div class="flex justify-between p-4">
                        <div class="flex">
                            <div>
                                <img src="{{asset('images/profile.png')}}" class="lg:h-10 lg:w-10 mr-2" />
                            </div>
                            <div>
                                <div class="flex">
                                    <a href="" class="text-teal-600 font-bold mr-1">Pukiungtu</a>
                                </div>
                                <button class="px-6 text-sm text-white bg-yellow-600 rounded">Follow</button>
                            </div>
                        </div>
                        <div>
                            <div>
                                <i class="fa fa-ellipsis-h mr-5 text-gray-600 "></i>
                            </div>
                        </div>
                    </div>
                    <div class="h-64 flex justify-center items-center bg-blue-900">
                        <p class="px-4 text-white text-lg">
                            FELL ASLEEP ON THE TOILET WOKE UP AND EVERYONE WAS GONE , I WAS LOCKED IN THE BAR
                        </p>
                    </div>
                    <div class="mt-2 text-sm ml-4 lg:flex lg:justify-end">
                        <span class="mr-2 text-gray-600">Posted 3 minutes ago on</span>
                        <a href="" class="mr-4 text-teal-600 font-bold">Love and Relationship</a>
                    </div>
                    <div class="ml-4 pb-2 flex">
                        <div class="flex flex-col items-center">
                            <span>158</span>
                            <img src="{{ asset('icons/feel.png') }}" class="w-8 h-8" />
                        </div>
                        <div class="mx-2 flex flex-col items-center">
                            <span>51</span>
                            <img src="{{ asset('icons/comment.png') }}" class="w-8 h-8" />
                        </div>
                        <div class="flex flex-col justify-end">
                            <img src="{{ asset('icons/share.png') }}" class="w-8 h-8" />
                        </div>
                    </div>
                </div> -->
                <!-- card end -->
            </div>
            <footer class="mt-6">
                <p class="text-white">
                    <a href="/login" class="border-b-2">Login</a> or <a href="/signup" class="border-b-2">Sign Up</a> to view more Confession
                </p>
            </footer>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('public/js/app.js') }}"></script>
</body>

</html>
