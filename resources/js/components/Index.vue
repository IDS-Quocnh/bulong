<template>
    <div>
        <header class="flex justify-between items-center pt-1 lg:px-32 border">
            <div>
                <img src="images/logo.png" class="w-32" />
            </div>
            <div class="hidden lg:block">
                <input type="text" placeholder="&#128269; Search..." class="p-2 lg:text-sm text-center border" />
            </div>
            <div class="flex items-center text-gray-600">
                <a href="">
                    <span class="text-xl text-white mr-3 bg-gray-600 h-8 w-8 flex justify-center items-center rounded-full"><i class="fa fa-home "></i></span>
                </a>
                <a href="notification.html">
                    <div class="text-3xl relative inline"><i class="fa fa-bell-o"></i>
                        <span class="absolute t-0 r-0 -ml-4 mt-2 bg-gray-600 h-4 w-4 rounded-full text-xs text-center text-white">2</span>
                    </div>
                </a>
                <img src="images/profile.png" class="lg:h-10 lg:w-10 rounded-full mx-3 ">
            </div>
        </header>
        <div class="flex justify-between lg:px-24 pt-3">
            <aside class="w-3/12 hidden lg:block">
                <div class="flex flex-col justify-center items-center">
                    <img src="images/profile.png" />
                    <h1 class="mt-1 text-gray-700 mb-1">username</h1>
                </div>
                <personal-menu></personal-menu>
                <category-list></category-list>
            </aside>
            <main class="feed px-4 lg:w-6/12 h-screen overflow-y-auto">
                <img src="images/image.png" class="mb-4" />
                <confession-form></confession-form>
                <div class=" mt-8">
                    <confession-menu></confession-menu>
                </div>
                <confession-list></confession-list>
            </main>
            <aside class="p-6 w-3/12 hidden lg:block">
                <div class="text-center">
                    <h3 class="text-gray-600 mb-5">Sponsor</h3>
                </div>
                <div class="">
                    <img src="images/ads.png" class= />
                </div>
                <div class="flex flex-col">
                    <h3 class="uppercase text-gray-800 mb-4 px-6 mt-4">Trending Hashtage</h3>
                    <div class="py-2 pr-6 text-gray-700 border-2">
                        <ul>
                            <li>
                                <a href="" class="mb-4 px-6"># sanaall</a>
                            </li>
                            <li>
                                <a href="" class="mb-4 px-6"># iraffytulfomoako</a>
                            </li>
                            <li>
                                <a href="" class="mb-4 px-6"># inamo</a>
                            </li>
                            <li>
                                <a href="" class="mb-4 px-6"># yametemoments</a>
                            </li>
                            <li>
                                <a href="" class="mb-4 px-6"># sanaall</a>
                            </li>
                            <li>
                                <a href="" class="mb-4 px-6"># iraffytulfomoako</a>
                            </li>
                            <li>
                                <a href="" class="mb-4 px-6"># inamo</a>
                            </li>
                            <li>
                                <a href="" class="mb-4 px-6"># yametemoments</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-10 px-4 text-gray-600">
                        <a href="">About Us</a>-
                        <a href="">Privacy</a>-
                        <a href="">Cookie</a>-
                        <a href="">Policy</a>-
                        <a href="">Terms</a>-
                        <a href="">Contact</a>-
                        <a href="">Advertise with Us</a>-
                    </div>
                    <div class="mt-5 pl-4 text-gray-600">
                        <h5>2020 Bulong</h5>
                    </div>
                    <div class="mt-3 pl-8">
                        <img src="images/image1.png" class="mb-2" />
                        <img src="images/image2.png" />
                    </div>
                </div>
            </aside>
        </div>
    </div>
</template>
<script>
export default {
    //
}

</script>
