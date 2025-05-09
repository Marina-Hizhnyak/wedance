<template>
  <!-- Main footer container -->
  <footer class="bg-background text-white pt-12 pb-12 relative overflow-hidden">
    <div class="w-[90%] mx-auto flex flex-col md:flex-row justify-between relative z-10">

      <!-- Vertical divider lines (only visible on desktop) -->
      <div class="hidden md:block absolute top-[-50px] bottom-[-100px] left-1/3 w-px bg-primary"></div>
      <div class="hidden md:block absolute top-[-50px] bottom-[-100px] left-2/3 w-px bg-primary"></div>

      <!-- Section 1: Logo and contact info -->
      <div class="w-full md:w-1/3 px-4 space-y-6">
        <!-- Logo and brand name -->
        <div class="flex items-center space-x-3">
          <img src="/images/logos/logo2.svg" alt="Logo" class="h-10 w-auto" />
          <span class="text-4xl text-primary font-semibold">Wedance</span>
        </div>

        <!-- Decorative horizontal line -->
        <div class="relative h-[1px]">
          <div class="absolute left-[-16px] right-[-16px] top-0 h-full bg-primary"></div>
        </div>

        <!-- Contact information list -->
        <ul class="space-y-6 text-base text-text text-body py-5">
          <li class="flex items-center space-x-2">
            <img src="/images/icons/point.svg" alt="map" class="w-5 h-5" />
            <span>Bruxelles 62 12-648 Wortund, Palarni.</span>
          </li>
          <li class="flex items-center space-x-2">
             <img src="/images/icons/telephone.svg" alt="phone" class="w-5 h-5" />
            <span>(+1) 123 456 7893</span>
          </li>
          <li class="flex items-center space-x-2">
             <img src="/images/icons/enveloppe.svg" alt="mail" class="w-5 h-5" />
            <span>name@email.com</span>
          </li>
        </ul>
      </div>

      <!-- Section 2: Navigation links and social icons -->
      <div class="w-full md:w-1/3 px-4 space-y-6 text-center md:text-left">
        <!-- Navigation links -->
        <ul class="space-y-6 px-10 text-base text-text text-body">
          <li><a href="/a-propos" class="hover:text-[#F9B233] transition">À propos</a></li>
          <li><a href="/cours" class="hover:text-[#F9B233] transition">Cours</a></li>
          <li><a href="/evenements" class="hover:text-[#F9B233] transition">Événements</a></li>
          <li><a href="/contact" class="hover:text-[#F9B233] transition">Contact</a></li>
        </ul>

        <!-- Decorative horizontal line -->
        <div class="relative h-[1px]">
          <div class="absolute left-[-16px] right-[-16px] top-0 h-full bg-primary"></div>
        </div>

        <!-- Social media icons -->
        <div class="flex justify-center items-center space-x-10 text-xl">
          <img src="/images/icons/lettre.svg" class="w-5 h-5" alt="Plane" />
          <img src="/images/icons/phone.svg" class="w-5 h-5" alt="WhatsApp" />
          <img src="/images/icons/vk.svg" class="w-5 h-5" alt="VK" />
        </div>
      </div>

    <!-- Section 3: Call to action -->
    <div class="relative w-full md:w-1/3 px-10 flex flex-col items-left  justify-between">
    <div>
        <!-- Call to action header -->
        <h3 class="text-4xl text-accent font-medium font-title my-4">Dansons?</h3>

        <!-- CTA button -->
        <a href="/inscription" class="bg-primary text-black px-6 py-2 my-6 rounded-full font-bold inline-block hover:bg-secondary transition">
        DANSER <span class="inline-block ml-2">💃</span>
        </a>
    </div>

    <img src="/images/backgrounds/couple.png" alt="Dance icon" class="absolute -top-10 left-80 w-auto h-[300px]" />

    <!-- Footer info -->
    <div class="text-sm text-gray-400 mt-8">
        © 2025 Transparent.inc. ·
        <a href="/privacy" class="hover:text-white">Privacy</a> ·
        <a href="/terms" class="hover:text-white">Terms</a>
    </div>
    </div>

   </div>
  </footer>
</template>

