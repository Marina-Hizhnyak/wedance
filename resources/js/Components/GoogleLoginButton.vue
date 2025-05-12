<template>
    <a
        href="/auth/google/redirect"
        class="inline-flex items-center px-4 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600 transition duration-300"
    >
        <!-- Google icon (пример svg) -->
        <svg class="w-5 h-5 mr-2" viewBox="0 0 48 48">
            <path fill="#EA4335" d="M24 9.5c3.9 0 7.4 1.4 10.1 4l7.5-7.5C36.9 1.7 30.8 0 24 0 14.8 0 6.7 5.6 2.7 13.7l8.7 6.8C13.4 14.8 18.2 9.5 24 9.5z"/>
            <path fill="#34A853" d="M46.5 24.5c0-1.5-.1-2.9-.4-4.3H24v8.2h12.7c-1.3 4-4.9 7-9.2 7-5.5 0-10-4.5-10-10s4.5-10 10-10c2.4 0 4.6.9 6.3 2.3l6.2-6.2C35.9 8.3 30.3 6 24 6 14.8 6 7 13.8 7 24s7.8 18 17 18c9.2 0 16.5-7.3 16.5-16.5z"/>
        </svg>
        Login with Google
    </a>
</template>

<script setup>
// No logic needed, just a button with link to redirect route
</script>
